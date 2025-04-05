<?php
session_start();
require_once __DIR__ . '/../config/database.php';

// Router simple
$request = $_SERVER['REQUEST_URI'];
$basePath = '/faculty-management/public';

// Supprimer le chemin de base de l'URL
$request = str_replace($basePath, '', $request);

// Router basique
switch ($request) {
    case '':
    case '/':
        require __DIR__ . '/../src/views/home.php';
        break;
    case '/login':
        require __DIR__ . '/../src/views/auth/login.php';
        break;
    case '/register':
        require __DIR__ . '/../src/views/auth/register.php';
        break;
    case '/dashboard':
        require __DIR__ . '/../src/views/dashboard.php';
        break;
    default:
        http_response_code(404);
        require __DIR__ . '/../src/views/404.php';
        break;
} 