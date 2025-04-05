<?php
$content = '
<div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
    <div class="text-center">
        <h1 class="text-4xl font-bold text-gray-900 sm:text-5xl md:text-6xl">
            Système de Gestion de Faculté
        </h1>
        <p class="mt-3 max-w-md mx-auto text-base text-gray-500 sm:text-lg md:mt-5 md:text-xl md:max-w-3xl">
            Une solution complète pour la gestion administrative et pédagogique de votre faculté.
        </p>
    </div>

    <div class="mt-10">
        <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
            <!-- Carte Administrateur -->
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    <h3 class="text-lg font-medium text-gray-900">Administrateur</h3>
                    <p class="mt-1 text-sm text-gray-500">
                        Gestion complète des utilisateurs, des cours et des rapports administratifs.
                    </p>
                </div>
            </div>

            <!-- Carte Professeur -->
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    <h3 class="text-lg font-medium text-gray-900">Professeur</h3>
                    <p class="mt-1 text-sm text-gray-500">
                        Gestion des cours, suivi des présences et notation des étudiants.
                    </p>
                </div>
            </div>

            <!-- Carte Étudiant -->
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    <h3 class="text-lg font-medium text-gray-900">Étudiant</h3>
                    <p class="mt-1 text-sm text-gray-500">
                        Consultation des cours, accès aux résultats et communication avec les professeurs.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-10 text-center">
        <a href="/login" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
            Commencer
        </a>
    </div>
</div>
';

require_once __DIR__ . '/layouts/main.php'; 