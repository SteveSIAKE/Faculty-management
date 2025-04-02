<?php
require_once 'config/database.php';

// Traitement du formulaire d'ajout
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $code = $_POST['code'];
    $nom = $_POST['nom'];
    $description = $_POST['description'];
    $professeur_id = $_POST['professeur_id'];
    $niveau = $_POST['niveau'];
    $credits = $_POST['credits'];

    $sql = "INSERT INTO cours (code, nom, description, professeur_id, niveau, credits) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$code, $nom, $description, $professeur_id, $niveau, $credits]);
}

// Récupération des professeurs pour le select
$sql = "SELECT id, nom, prenom FROM professeurs ORDER BY nom";
$stmt = $conn->query($sql);
$professeurs = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Récupération des cours avec les noms des professeurs
$sql = "SELECT c.*, p.nom as prof_nom, p.prenom as prof_prenom 
        FROM cours c 
        LEFT JOIN professeurs p ON c.professeur_id = p.id 
        ORDER BY c.nom";
$stmt = $conn->query($sql);
$cours = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Cours</title>
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
        <h2 class="text-2xl font-bold mb-6">Gestion des Cours</h2>

        <!-- Formulaire d'ajout -->
        <div class="bg-white p-6 rounded-lg shadow-md mb-8">
            <h3 class="text-xl font-semibold mb-4">Ajouter un cours</h3>
            <form method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-gray-700 mb-2">Code du cours</label>
                    <input type="text" name="code" required class="w-full p-2 border rounded">
                </div>
                <div>
                    <label class="block text-gray-700 mb-2">Nom du cours</label>
                    <input type="text" name="nom" required class="w-full p-2 border rounded">
                </div>
                <div class="md:col-span-2">
                    <label class="block text-gray-700 mb-2">Description</label>
                    <textarea name="description" class="w-full p-2 border rounded" rows="3"></textarea>
                </div>
                <div>
                    <label class="block text-gray-700 mb-2">Professeur</label>
                    <select name="professeur_id" required class="w-full p-2 border rounded">
                        <option value="">Sélectionner un professeur</option>
                        <?php foreach ($professeurs as $professeur): ?>
                            <option value="<?php echo $professeur['id']; ?>">
                                <?php echo htmlspecialchars($professeur['nom'] . ' ' . $professeur['prenom']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div>
                    <label class="block text-gray-700 mb-2">Niveau</label>
                    <select name="niveau" required class="w-full p-2 border rounded">
                        <option value="L1">L1</option>
                        <option value="L2">L2</option>
                        <option value="L3">L3</option>
                        <option value="M1">M1</option>
                        <option value="M2">M2</option>
                    </select>
                </div>
                <div>
                    <label class="block text-gray-700 mb-2">Crédits</label>
                    <input type="number" name="credits" required min="1" max="6" class="w-full p-2 border rounded">
                </div>
                <div class="md:col-span-2">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                        Ajouter le cours
                    </button>
                </div>
            </form>
        </div>

        <!-- Liste des cours -->
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h3 class="text-xl font-semibold mb-4">Liste des cours</h3>
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="px-4 py-2">Code</th>
                            <th class="px-4 py-2">Nom</th>
                            <th class="px-4 py-2">Description</th>
                            <th class="px-4 py-2">Professeur</th>
                            <th class="px-4 py-2">Niveau</th>
                            <th class="px-4 py-2">Crédits</th>
                            <th class="px-4 py-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($cours as $cours): ?>
                        <tr class="border-t">
                            <td class="px-4 py-2"><?php echo htmlspecialchars($cours['code']); ?></td>
                            <td class="px-4 py-2"><?php echo htmlspecialchars($cours['nom']); ?></td>
                            <td class="px-4 py-2"><?php echo htmlspecialchars($cours['description']); ?></td>
                            <td class="px-4 py-2"><?php echo htmlspecialchars($cours['prof_nom'] . ' ' . $cours['prof_prenom']); ?></td>
                            <td class="px-4 py-2"><?php echo htmlspecialchars($cours['niveau']); ?></td>
                            <td class="px-4 py-2"><?php echo htmlspecialchars($cours['credits']); ?></td>
                            <td class="px-4 py-2">
                                <a href="modifier_cours.php?id=<?php echo $cours['id']; ?>" class="text-blue-500 hover:text-blue-700">Modifier</a>
                                <a href="supprimer_cours.php?id=<?php echo $cours['id']; ?>" class="text-red-500 hover:text-red-700 ml-2">Supprimer</a>
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