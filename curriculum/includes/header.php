<?php
/**
 * Header del sitio
 * Cypherstudios - Víctor Visús García
 */

require_once __DIR__ . '/seo.php';
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <?= generate_meta_tags($page_title ?? '', $page_description ?? '', $page_keywords ?? '') ?>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Source+Sans+3:wght@300;400;500;600;700&family=JetBrains+Mono:wght@300;400;500;600&display=swap"
        rel="stylesheet">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- CSS Personalizado -->
    <link rel="stylesheet" href="<?= SITE_URL ?>/assets/css/styles.css">

    <!-- JavaScript -->
    <script src="<?= SITE_URL ?>/assets/js/main.js" defer></script>
</head>

<body class="bg-gray-950 text-gray-100 font-inter">
    <!-- Skip to content -->
    <a href="#main-content"
        class="sr-only focus:not-sr-only focus:absolute focus:top-4 focus:left-4 bg-green-400 text-gray-950 px-4 py-2 rounded-md z-50">
        Saltar al contenido principal
    </a>

    <!-- Header -->
    <header id="main-header" class="fixed top-0 left-0 right-0 bg-gray-900/95 backdrop-blur-sm border-b border-gray-800 z-40 transition-transform duration-300 ease-in-out">
        <div class="container mx-auto px-4">
            <div class="flex items-center justify-between h-16">
                <!-- Logo -->
                <div class="flex items-center space-x-3">
                    <img src="<?= SITE_URL ?>/assets/img/Cypher_imagotipo-positivo.png" alt="Cypherstudios" class="w-8 h-8">
                    <div>
                        <h1 class="text-lg font-semibold text-green-400">Cypherstudios</h1>
                        <p class="text-xs text-gray-400 font-mono">Víctor Visús García</p>
                    </div>
                </div>

                <!-- Navegación -->
                <nav id="main-nav" role="navigation" aria-label="Navegación principal">
                    <ul class="hidden md:flex items-center space-x-6">
                        <li><a href="#inicio"
                                class="nav-link text-gray-300 hover:text-green-400 transition-colors">Inicio</a></li>
                        <li><a href="#que-hago"
                                class="nav-link text-gray-300 hover:text-green-400 transition-colors">Qué hago</a></li>
                        <li><a href="#proyectos"
                                class="nav-link text-gray-300 hover:text-green-400 transition-colors">Proyectos</a></li>
                        <li><a href="#tecnologias"
                                class="nav-link text-gray-300 hover:text-green-400 transition-colors">Tecnologías</a>
                        </li>
                        <li><a href="#sobre-mi"
                                class="nav-link text-gray-300 hover:text-green-400 transition-colors">Sobre mí</a></li>
                        <li><a href="#contacto"
                                class="nav-link text-gray-300 hover:text-green-400 transition-colors">Contacto</a></li>
                    </ul>

                    <!-- Botón menú móvil -->
                    <button id="mobile-menu-btn" class="md:hidden text-gray-300 hover:text-green-400 transition-colors"
                        aria-label="Abrir menú">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                </nav>
            </div>

            <!-- Menú móvil -->
            <div id="mobile-menu" class="hidden md:hidden pb-4">
                <ul class="space-y-2">
                    <li><a href="#inicio"
                            class="block py-2 text-gray-300 hover:text-green-400 transition-colors">Inicio</a></li>
                    <li><a href="#que-hago" class="block py-2 text-gray-300 hover:text-green-400 transition-colors">Qué
                            hago</a></li>
                    <li><a href="#proyectos"
                            class="block py-2 text-gray-300 hover:text-green-400 transition-colors">Proyectos</a></li>
                    <li><a href="#tecnologias"
                            class="block py-2 text-gray-300 hover:text-green-400 transition-colors">Tecnologías</a></li>
                    <li><a href="#sobre-mi"
                            class="block py-2 text-gray-300 hover:text-green-400 transition-colors">Sobre mí</a></li>
                    <li><a href="#contacto"
                            class="block py-2 text-gray-300 hover:text-green-400 transition-colors">Contacto</a></li>
                </ul>
            </div>
        </div>
    </header>