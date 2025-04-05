<?php
$user = $_SESSION['user'];
$data = (new DashboardController($pdo))->index();

$content = '
<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    <div class="px-4 py-6 sm:px-0">
        <h1 class="text-3xl font-bold text-gray-900">Tableau de bord</h1>
        <p class="mt-1 text-sm text-gray-500">Bienvenue, ' . htmlspecialchars($user['prenom'] . ' ' . $user['nom']) . '</p>
    </div>
';

switch ($user['role']) {
    case 'admin':
        $content .= '
        <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    <dt class="text-sm font-medium text-gray-500 truncate">Total Étudiants</dt>
                    <dd class="mt-1 text-3xl font-semibold text-gray-900">' . $data['stats']['total_etudiants'] . '</dd>
                </div>
            </div>
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    <dt class="text-sm font-medium text-gray-500 truncate">Total Professeurs</dt>
                    <dd class="mt-1 text-3xl font-semibold text-gray-900">' . $data['stats']['total_professeurs'] . '</dd>
                </div>
            </div>
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    <dt class="text-sm font-medium text-gray-500 truncate">Total Cours</dt>
                    <dd class="mt-1 text-3xl font-semibold text-gray-900">' . $data['stats']['total_cours'] . '</dd>
                </div>
            </div>
        </div>

        <div class="mt-8">
            <h2 class="text-lg font-medium text-gray-900">Derniers utilisateurs inscrits</h2>
            <div class="mt-4 bg-white shadow overflow-hidden sm:rounded-md">
                <ul class="divide-y divide-gray-200">
                    ' . implode('', array_map(function($user) {
                        return '
                        <li class="px-6 py-4">
                            <div class="flex items-center justify-between">
                                <div class="flex-1">
                                    <p class="text-sm font-medium text-gray-900">' . htmlspecialchars($user['prenom'] . ' ' . $user['nom']) . '</p>
                                    <p class="text-sm text-gray-500">' . htmlspecialchars($user['email']) . '</p>
                                </div>
                                <div class="ml-2 flex-shrink-0 flex">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                        ' . ucfirst($user['role']) . '
                                    </span>
                                </div>
                            </div>
                        </li>';
                    }, $data['recent_users'])) . '
                </ul>
            </div>
        </div>';
        break;

    case 'professeur':
        $content .= '
        <div class="mt-8">
            <h2 class="text-lg font-medium text-gray-900">Mes cours</h2>
            <div class="mt-4 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">
                ' . implode('', array_map(function($course) {
                    return '
                    <div class="bg-white overflow-hidden shadow rounded-lg">
                        <div class="px-4 py-5 sm:p-6">
                            <h3 class="text-lg font-medium text-gray-900">' . htmlspecialchars($course['nom']) . '</h3>
                            <p class="mt-1 text-sm text-gray-500">' . htmlspecialchars($course['description']) . '</p>
                            <p class="mt-2 text-sm text-gray-500">' . $course['nombre_etudiants'] . ' étudiants inscrits</p>
                        </div>
                    </div>';
                }, $data['cours'])) . '
            </div>
        </div>

        <div class="mt-8">
            <h2 class="text-lg font-medium text-gray-900">Prochaines séances</h2>
            <div class="mt-4 bg-white shadow overflow-hidden sm:rounded-md">
                <ul class="divide-y divide-gray-200">
                    ' . implode('', array_map(function($seance) {
                        return '
                        <li class="px-6 py-4">
                            <div class="flex items-center justify-between">
                                <div class="flex-1">
                                    <p class="text-sm font-medium text-gray-900">' . htmlspecialchars($seance['course_nom']) . '</p>
                                    <p class="text-sm text-gray-500">' . date('d/m/Y', strtotime($seance['date'])) . '</p>
                                </div>
                                <div class="ml-2 flex-shrink-0 flex">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full ' . ($seance['present'] ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800') . '">
                                        ' . ($seance['present'] ? 'Présent' : 'Absent') . '
                                    </span>
                                </div>
                            </div>
                        </li>';
                    }, $data['prochaines_seances'])) . '
                </ul>
            </div>
        </div>';
        break;

    case 'etudiant':
        $content .= '
        <div class="mt-8">
            <h2 class="text-lg font-medium text-gray-900">Mes cours</h2>
            <div class="mt-4 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">
                ' . implode('', array_map(function($course) {
                    return '
                    <div class="bg-white overflow-hidden shadow rounded-lg">
                        <div class="px-4 py-5 sm:p-6">
                            <h3 class="text-lg font-medium text-gray-900">' . htmlspecialchars($course['nom']) . '</h3>
                            <p class="mt-1 text-sm text-gray-500">' . htmlspecialchars($course['description']) . '</p>
                            ' . ($course['note'] ? '<p class="mt-2 text-sm font-medium text-gray-900">Note : ' . $course['note'] . '/20</p>' : '') . '
                        </div>
                    </div>';
                }, $data['cours'])) . '
            </div>
        </div>

        <div class="mt-8">
            <h2 class="text-lg font-medium text-gray-900">Prochaines séances</h2>
            <div class="mt-4 bg-white shadow overflow-hidden sm:rounded-md">
                <ul class="divide-y divide-gray-200">
                    ' . implode('', array_map(function($seance) {
                        return '
                        <li class="px-6 py-4">
                            <div class="flex items-center justify-between">
                                <div class="flex-1">
                                    <p class="text-sm font-medium text-gray-900">' . htmlspecialchars($seance['course_nom']) . '</p>
                                    <p class="text-sm text-gray-500">' . date('d/m/Y', strtotime($seance['date'])) . '</p>
                                </div>
                                <div class="ml-2 flex-shrink-0 flex">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full ' . ($seance['present'] ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800') . '">
                                        ' . ($seance['present'] ? 'Présent' : 'Absent') . '
                                    </span>
                                </div>
                            </div>
                        </li>';
                    }, $data['prochaines_seances'])) . '
                </ul>
            </div>
        </div>';
        break;
}

$content .= '
</div>';

require_once __DIR__ . '/layouts/main.php'; 