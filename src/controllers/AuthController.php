<?php

class AuthController {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = ?");
            $stmt->execute([$email]);
            $user = $stmt->fetch();

            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user'] = [
                    'id' => $user['id'],
                    'nom' => $user['nom'],
                    'prenom' => $user['prenom'],
                    'email' => $user['email'],
                    'role' => $user['role']
                ];

                $_SESSION['message'] = 'Connexion réussie !';
                header('Location: /dashboard');
                exit;
            } else {
                $_SESSION['error'] = 'Email ou mot de passe incorrect.';
                header('Location: /login');
                exit;
            }
        }
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nom = $_POST['nom'] ?? '';
            $prenom = $_POST['prenom'] ?? '';
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';
            $password_confirmation = $_POST['password_confirmation'] ?? '';

            // Validation
            if (empty($nom) || empty($prenom) || empty($email) || empty($password)) {
                $_SESSION['error'] = 'Tous les champs sont obligatoires.';
                header('Location: /register');
                exit;
            }

            if ($password !== $password_confirmation) {
                $_SESSION['error'] = 'Les mots de passe ne correspondent pas.';
                header('Location: /register');
                exit;
            }

            // Vérifier si l'email existe déjà
            $stmt = $this->pdo->prepare("SELECT id FROM users WHERE email = ?");
            $stmt->execute([$email]);
            if ($stmt->fetch()) {
                $_SESSION['error'] = 'Cet email est déjà utilisé.';
                header('Location: /register');
                exit;
            }

            // Créer l'utilisateur
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $this->pdo->prepare("INSERT INTO users (nom, prenom, email, password, role) VALUES (?, ?, ?, ?, 'etudiant')");
            
            try {
                $stmt->execute([$nom, $prenom, $email, $hashedPassword]);
                $_SESSION['message'] = 'Inscription réussie ! Vous pouvez maintenant vous connecter.';
                header('Location: /login');
                exit;
            } catch (PDOException $e) {
                $_SESSION['error'] = 'Une erreur est survenue lors de l\'inscription.';
                header('Location: /register');
                exit;
            }
        }
    }

    public function logout() {
        session_destroy();
        header('Location: /');
        exit;
    }
} 