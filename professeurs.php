<?php
require_once 'config/database.php';

// Traitement du formulaire d'ajout
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $matricule = $_POST['matricule'];
    $specialite = $_POST['specialite'];

    $sql = "INSERT INTO professeurs (nom, prenom, email, matricule, specialite) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$nom, $prenom, $email, $matricule, $specialite]);
}

// Récupération des professeurs
$sql = "SELECT * FROM professeurs ORDER BY nom";
$stmt = $conn->query($sql);
$professeurs = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Professeurs</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <nav class="bg-blue-600 text-white p-4">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-2xl font-bold">Gestion de Faculté</h1>
            <div class="space-x-4">
                <a href="index.php" class="hover:text-blue-200">Accueil</a>
                <a href="etudiants.php" class="hover:text-blue-200">Étudiants</a>
                <a href="professeurs.php" class="hover:text-blue-200">Professeurs</a>
                <a href="cours.php" class="hover:text-blue-200">Cours</a>
            </div>
        </div>
    </nav>

    <main class="container mx-auto mt-8 p-4">
        <h2 class="text-2xl font-bold mb-6">Gestion des Professeurs</h2>

        <!-- Formulaire d'ajout -->
        <div class="bg-white p-6 rounded-lg shadow-md mb-8">
            <h3 class="text-xl font-semibold mb-4">Ajouter un professeur</h3>
            <form method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-gray-700 mb-2">Nom</label>
                    <input type="text" name="nom" required class="w-full p-2 border rounded">
                </div>
                <div>
                    <label class="block text-gray-700 mb-2">Prénom</label>
                    <input type="text" name="prenom" required class="w-full p-2 border rounded">
                </div>
                <div>
                    <label class="block text-gray-700 mb-2">Email</label>
                    <input type="email" name="email" required class="w-full p-2 border rounded">
                </div>
                <div>
                    <label class="block text-gray-700 mb-2">Matricule</label>
                    <input type="text" name="matricule" required class="w-full p-2 border rounded">
                </div>
                <div class="md:col-span-2">
                    <label class="block text-gray-700 mb-2">Spécialité</label>
                    <input type="text" name="specialite" required class="w-full p-2 border rounded">
                </div>
                <div class="md:col-span-2">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                        Ajouter le professeur
                    </button>
                </div>
            </form>
        </div>

        <!-- Liste des professeurs -->
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h3 class="text-xl font-semibold mb-4">Liste des professeurs</h3>
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="px-4 py-2">Matricule</th>
                            <th class="px-4 py-2">Nom</th>
                            <th class="px-4 py-2">Prénom</th>
                            <th class="px-4 py-2">Email</th>
                            <th class="px-4 py-2">Spécialité</th>
                            <th class="px-4 py-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($professeurs as $professeur): ?>
                        <tr class="border-t">
                            <td class="px-4 py-2"><?php echo htmlspecialchars($professeur['matricule']); ?></td>
                            <td class="px-4 py-2"><?php echo htmlspecialchars($professeur['nom']); ?></td>
                            <td class="px-4 py-2"><?php echo htmlspecialchars($professeur['prenom']); ?></td>
                            <td class="px-4 py-2"><?php echo htmlspecialchars($professeur['email']); ?></td>
                            <td class="px-4 py-2"><?php echo htmlspecialchars($professeur['specialite']); ?></td>
                            <td class="px-4 py-2">
                                <a href="modifier_professeur.php?id=<?php echo $professeur['id']; ?>" class="text-blue-500 hover:text-blue-700">Modifier</a>
                                <a href="supprimer_professeur.php?id=<?php echo $professeur['id']; ?>" class="text-red-500 hover:text-red-700 ml-2">Supprimer</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <footer class="bg-gray-800 text-white p-4 mt-8">
        <div class="container mx-auto text-center">
            <p>&copy; <?php echo date('Y'); ?> Système de Gestion de Faculté. Tous droits réservés.</p>
        </div>
    </footer>
</body>
</html> 