<?php

class DashboardController {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function index() {
        if (!isset($_SESSION['user'])) {
            header('Location: /login');
            exit;
        }

        $user = $_SESSION['user'];
        $data = [];

        switch ($user['role']) {
            case 'admin':
                $data = $this->getAdminDashboard();
                break;
            case 'professeur':
                $data = $this->getProfesseurDashboard($user['id']);
                break;
            case 'etudiant':
                $data = $this->getEtudiantDashboard($user['id']);
                break;
        }

        return $data;
    }

    private function getAdminDashboard() {
        // Statistiques générales
        $stats = [
            'total_etudiants' => $this->pdo->query("SELECT COUNT(*) FROM users WHERE role = 'etudiant'")->fetchColumn(),
            'total_professeurs' => $this->pdo->query("SELECT COUNT(*) FROM users WHERE role = 'professeur'")->fetchColumn(),
            'total_cours' => $this->pdo->query("SELECT COUNT(*) FROM courses")->fetchColumn()
        ];

        // Derniers utilisateurs inscrits
        $stmt = $this->pdo->query("SELECT * FROM users ORDER BY created_at DESC LIMIT 5");
        $recent_users = $stmt->fetchAll();

        return [
            'stats' => $stats,
            'recent_users' => $recent_users
        ];
    }

    private function getProfesseurDashboard($professeur_id) {
        // Cours du professeur
        $stmt = $this->pdo->prepare("
            SELECT c.*, COUNT(e.id) as nombre_etudiants 
            FROM courses c 
            LEFT JOIN enrollments e ON c.id = e.course_id 
            WHERE c.professeur_id = ? 
            GROUP BY c.id
        ");
        $stmt->execute([$professeur_id]);
        $cours = $stmt->fetchAll();

        // Prochaines séances
        $stmt = $this->pdo->prepare("
            SELECT a.*, c.nom as course_nom 
            FROM attendance a 
            JOIN courses c ON a.course_id = c.id 
            WHERE c.professeur_id = ? 
            AND a.date >= CURDATE() 
            ORDER BY a.date ASC 
            LIMIT 5
        ");
        $stmt->execute([$professeur_id]);
        $prochaines_seances = $stmt->fetchAll();

        return [
            'cours' => $cours,
            'prochaines_seances' => $prochaines_seances
        ];
    }

    private function getEtudiantDashboard($etudiant_id) {
        // Cours de l'étudiant
        $stmt = $this->pdo->prepare("
            SELECT c.*, g.note 
            FROM courses c 
            JOIN enrollments e ON c.id = e.course_id 
            LEFT JOIN grades g ON c.id = g.course_id AND g.etudiant_id = ?
            WHERE e.etudiant_id = ?
        ");
        $stmt->execute([$etudiant_id, $etudiant_id]);
        $cours = $stmt->fetchAll();

        // Prochaines séances
        $stmt = $this->pdo->prepare("
            SELECT a.*, c.nom as course_nom 
            FROM attendance a 
            JOIN courses c ON a.course_id = c.id 
            JOIN enrollments e ON c.id = e.course_id 
            WHERE e.etudiant_id = ? 
            AND a.date >= CURDATE() 
            ORDER BY a.date ASC 
            LIMIT 5
        ");
        $stmt->execute([$etudiant_id]);
        $prochaines_seances = $stmt->fetchAll();

        return [
            'cours' => $cours,
            'prochaines_seances' => $prochaines_seances
        ];
    }
} 