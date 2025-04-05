<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Système de Gestion de Faculté</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <nav class="bg-blue-600 text-white p-4">
        <div class="container mx-auto flex justify-between items-center">
            <a href="/" class="text-xl font-bold">Gestion Faculté</a>
            <div class="space-x-4">
                <?php if (isset($_SESSION['user'])): ?>
                    <a href="/dashboard" class="hover:text-blue-200">Tableau de bord</a>
                    <a href="/logout" class="hover:text-blue-200">Déconnexion</a>
                <?php else: ?>
                    <a href="/login" class="hover:text-blue-200">Connexion</a>
                    <a href="/register" class="hover:text-blue-200">Inscription</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <main class="container mx-auto p-4">
        <?php if (isset($_SESSION['message'])): ?>
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline"><?php echo $_SESSION['message']; ?></span>
            </div>
            <?php unset($_SESSION['message']); ?>
        <?php endif; ?>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline"><?php echo $_SESSION['error']; ?></span>
            </div>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>

        <?php echo $content; ?>
    </main>

    <footer class="bg-gray-800 text-white p-4 mt-8">
        <div class="container mx-auto text-center">
            <p>&copy; <?php echo date('Y'); ?> Système de Gestion de Faculté</p>
        </div>
    </footer>
</body>
</html> 