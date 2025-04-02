<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion de Faculté</title>
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
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Carte des étudiants -->
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-xl font-semibold mb-4">Étudiants</h2>
                <p class="text-gray-600">Gérez les informations des étudiants</p>
                <a href="etudiants.php" class="mt-4 inline-block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                    Accéder
                </a>
            </div>

            <!-- Carte des professeurs -->
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-xl font-semibold mb-4">Professeurs</h2>
                <p class="text-gray-600">Gérez les informations des professeurs</p>
                <a href="professeurs.php" class="mt-4 inline-block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                    Accéder
                </a>
            </div>

            <!-- Carte des cours -->
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-xl font-semibold mb-4">Cours</h2>
                <p class="text-gray-600">Gérez les cours et les emplois du temps</p>
                <a href="cours.php" class="mt-4 inline-block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                    Accéder
                </a>
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
