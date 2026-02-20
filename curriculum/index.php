<?php
/**
 * Página principal
 * Cypherstudios - Víctor Visús García
 */

$page_title = 'Inicio';
$page_description = 'Diseño y desarrollo web con enfoque técnico y criterio visual';
$page_keywords = 'desarrollo web, diseño web, PHP, JavaScript, frontend, backend';

require_once __DIR__ . '/includes/header.php';
?>

<!-- Main Content -->
<main id="main-content" class="pt-16">
    <!-- Hero Section -->
    <section id="inicio" class="min-h-screen flex items-center justify-center bg-gradient-to-br from-gray-950 via-gray-900 to-gray-950">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <!-- Texto Hero -->
                <div class="space-y-6">
                    <div class="space-y-4">
                        <h2 class="text-4xl md:text-6xl font-bold text-gray-100">
                            Víctor Visús <span class="text-green-400">García</span>
                        </h2>
                        <h3 class="text-2xl md:text-3xl text-gray-300">
                            Desarrollador Web
                        </h3>
                        <p class="text-lg text-gray-400 max-w-lg">
                            Diseño y desarrollo web con enfoque técnico y criterio visual
                        </p>
                    </div>
                    
                    <!-- Formulario Simple Hero -->
                    <div class="bg-gray-800/50 backdrop-blur-sm border border-gray-700 rounded-lg p-6 max-w-md">
                        <h4 class="text-lg font-semibold text-green-400 mb-4">Contacto rápido</h4>
                        <form action="<?= SITE_URL ?>/forms/contact.php" method="POST" class="space-y-4">
                            <input type="hidden" name="subject" value="Contacto rápido desde Hero">
                            <div>
                                <input type="text" name="name" required
                                       class="w-full px-4 py-2 bg-gray-900 border border-gray-600 rounded-md text-gray-100 focus:outline-none focus:ring-2 focus:ring-green-400 focus:border-transparent"
                                       placeholder="Tu nombre">
                            </div>
                            <div>
                                <input type="email" name="email" required
                                       class="w-full px-4 py-2 bg-gray-900 border border-gray-600 rounded-md text-gray-100 focus:outline-none focus:ring-2 focus:ring-green-400 focus:border-transparent"
                                       placeholder="tu@email.com">
                            </div>
                            <div>
                                <textarea name="message" rows="3" required
                                          class="w-full px-4 py-2 bg-gray-900 border border-gray-600 rounded-md text-gray-100 focus:outline-none focus:ring-2 focus:ring-green-400 focus:border-transparent resize-none"
                                          placeholder="Tu mensaje..."></textarea>
                            </div>
                            <button type="submit" 
                                    class="w-full bg-green-400 text-gray-950 font-semibold py-2 px-4 rounded-md hover:bg-green-300 transition-colors">
                                Enviar mensaje
                            </button>
                        </form>
                    </div>
                </div>
                
                <!-- Visual Hero -->
                <div class="flex justify-center">
                    <div class="relative">
                        <div class="w-64 h-64 bg-gradient-to-br from-green-400/20 to-green-600/20 rounded-full blur-3xl"></div>
                        <div class="absolute inset-0 flex items-center justify-center">
                            <img src="<?= SITE_URL ?>/assets/img/logo.svg" alt="Cypherstudios" class="w-32 h-32 animate-pulse">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Qué hago -->
    <section id="que-hago" class="py-20 bg-gray-900/50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-100 mb-4">
                    Qué <span class="text-green-400">hago</span>
                </h2>
                <p class="text-gray-400 max-w-2xl mx-auto">
                    Servicios profesionales de desarrollo web adaptados a tus necesidades
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <article class="bg-gray-800/50 border border-gray-700 rounded-lg p-6 hover:border-green-400/50 transition-colors">
                    <div class="w-12 h-12 bg-green-400/20 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-100 mb-2">Desarrollo Web</h3>
                    <p class="text-gray-400">Aplicaciones web a medida con las últimas tecnologías y mejores prácticas.</p>
                </article>
                
                <article class="bg-gray-800/50 border border-gray-700 rounded-lg p-6 hover:border-green-400/50 transition-colors">
                    <div class="w-12 h-12 bg-green-400/20 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-100 mb-2">Diseño UI/UX</h3>
                    <p class="text-gray-400">Interfaces intuitivas y atractivas que mejoran la experiencia de usuario.</p>
                </article>
                
                <article class="bg-gray-800/50 border border-gray-700 rounded-lg p-6 hover:border-green-400/50 transition-colors">
                    <div class="w-12 h-12 bg-green-400/20 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-100 mb-2">SEO Técnico</h3>
                    <p class="text-gray-400">Optimización para motores de búsqueda y mejora del rendimiento web.</p>
                </article>
                
                <article class="bg-gray-800/50 border border-gray-700 rounded-lg p-6 hover:border-green-400/50 transition-colors">
                    <div class="w-12 h-12 bg-green-400/20 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-100 mb-2">Mantenimiento</h3>
                    <p class="text-gray-400">Soporte técnico y mantenimiento continuo para proyectos web.</p>
                </article>
            </div>
        </div>
    </section>

    <!-- Proyectos -->
    <section id="proyectos" class="py-20">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-100 mb-4">
                    <span class="text-green-400">Proyectos</span> destacados
                </h2>
                <p class="text-gray-400 max-w-2xl mx-auto">
                    Una selección de trabajos recientes que demuestran mis habilidades
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <article class="bg-gray-800/50 border border-gray-700 rounded-lg overflow-hidden hover:border-green-400/50 transition-colors">
                    <div class="h-48 bg-gradient-to-br from-green-400/20 to-blue-400/20 flex items-center justify-center">
                        <svg class="w-16 h-16 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"></path>
                        </svg>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-gray-100 mb-2">Proyecto E-commerce</h3>
                        <p class="text-gray-400 mb-4">Tienda online completa con panel de administración y pasarela de pago.</p>
                        <div class="flex flex-wrap gap-2">
                            <span class="px-2 py-1 bg-gray-700 text-gray-300 text-xs rounded">PHP</span>
                            <span class="px-2 py-1 bg-gray-700 text-gray-300 text-xs rounded">MySQL</span>
                            <span class="px-2 py-1 bg-gray-700 text-gray-300 text-xs rounded">JavaScript</span>
                        </div>
                    </div>
                </article>
                
                <article class="bg-gray-800/50 border border-gray-700 rounded-lg overflow-hidden hover:border-green-400/50 transition-colors">
                    <div class="h-48 bg-gradient-to-br from-purple-400/20 to-pink-400/20 flex items-center justify-center">
                        <svg class="w-16 h-16 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-gray-100 mb-2">Dashboard Analytics</h3>
                        <p class="text-gray-400 mb-4">Panel de análisis de datos en tiempo real con gráficos interactivos.</p>
                        <div class="flex flex-wrap gap-2">
                            <span class="px-2 py-1 bg-gray-700 text-gray-300 text-xs rounded">React</span>
                            <span class="px-2 py-1 bg-gray-700 text-gray-300 text-xs rounded">D3.js</span>
                            <span class="px-2 py-1 bg-gray-700 text-gray-300 text-xs rounded">API REST</span>
                        </div>
                    </div>
                </article>
                
                <article class="bg-gray-800/50 border border-gray-700 rounded-lg overflow-hidden hover:border-green-400/50 transition-colors">
                    <div class="h-48 bg-gradient-to-br from-orange-400/20 to-red-400/20 flex items-center justify-center">
                        <svg class="w-16 h-16 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-gray-100 mb-2">Blog Corporativo</h3>
                        <p class="text-gray-400 mb-4">Sistema de gestión de contenido con SEO optimizado y responsive design.</p>
                        <div class="flex flex-wrap gap-2">
                            <span class="px-2 py-1 bg-gray-700 text-gray-300 text-xs rounded">WordPress</span>
                            <span class="px-2 py-1 bg-gray-700 text-gray-300 text-xs rounded">SEO</span>
                            <span class="px-2 py-1 bg-gray-700 text-gray-300 text-xs rounded">CSS3</span>
                        </div>
                    </div>
                </article>
            </div>
        </div>
    </section>

    <!-- Tecnologías -->
    <section id="tecnologias" class="py-20 bg-gray-900/50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-100 mb-4">
                    <span class="text-green-400">Tecnologías</span> que domino
                </h2>
                <p class="text-gray-400 max-w-2xl mx-auto">
                    Stack técnico actualizado y en constante aprendizaje
                </p>
            </div>
            
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-6">
                <div class="text-center">
                    <div class="w-16 h-16 bg-gray-800 rounded-lg flex items-center justify-center mx-auto mb-3">
                        <span class="text-green-400 font-bold text-xl">PHP</span>
                    </div>
                    <p class="text-gray-300 text-sm">PHP 8.3</p>
                </div>
                
                <div class="text-center">
                    <div class="w-16 h-16 bg-gray-800 rounded-lg flex items-center justify-center mx-auto mb-3">
                        <span class="text-green-400 font-bold text-xl">JS</span>
                    </div>
                    <p class="text-gray-300 text-sm">JavaScript</p>
                </div>
                
                <div class="text-center">
                    <div class="w-16 h-16 bg-gray-800 rounded-lg flex items-center justify-center mx-auto mb-3">
                        <span class="text-green-400 font-bold text-xl">HT</span>
                    </div>
                    <p class="text-gray-300 text-sm">HTML5</p>
                </div>
                
                <div class="text-center">
                    <div class="w-16 h-16 bg-gray-800 rounded-lg flex items-center justify-center mx-auto mb-3">
                        <span class="text-green-400 font-bold text-xl">CS</span>
                    </div>
                    <p class="text-gray-300 text-sm">CSS3</p>
                </div>
                
                <div class="text-center">
                    <div class="w-16 h-16 bg-gray-800 rounded-lg flex items-center justify-center mx-auto mb-3">
                        <span class="text-green-400 font-bold text-xl">MY</span>
                    </div>
                    <p class="text-gray-300 text-sm">MySQL</p>
                </div>
                
                <div class="text-center">
                    <div class="w-16 h-16 bg-gray-800 rounded-lg flex items-center justify-center mx-auto mb-3">
                        <span class="text-green-400 font-bold text-xl">WP</span>
                    </div>
                    <p class="text-gray-300 text-sm">WordPress</p>
                </div>
                
                <div class="text-center">
                    <div class="w-16 h-16 bg-gray-800 rounded-lg flex items-center justify-center mx-auto mb-3">
                        <span class="text-green-400 font-bold text-xl">TW</span>
                    </div>
                    <p class="text-gray-300 text-sm">Tailwind</p>
                </div>
                
                <div class="text-center">
                    <div class="w-16 h-16 bg-gray-800 rounded-lg flex items-center justify-center mx-auto mb-3">
                        <span class="text-green-400 font-bold text-xl">RE</span>
                    </div>
                    <p class="text-gray-300 text-sm">React</p>
                </div>
                
                <div class="text-center">
                    <div class="w-16 h-16 bg-gray-800 rounded-lg flex items-center justify-center mx-auto mb-3">
                        <span class="text-green-400 font-bold text-xl">NO</span>
                    </div>
                    <p class="text-gray-300 text-sm">Node.js</p>
                </div>
                
                <div class="text-center">
                    <div class="w-16 h-16 bg-gray-800 rounded-lg flex items-center justify-center mx-auto mb-3">
                        <span class="text-green-400 font-bold text-xl">GI</span>
                    </div>
                    <p class="text-gray-300 text-sm">Git</p>
                </div>
                
                <div class="text-center">
                    <div class="w-16 h-16 bg-gray-800 rounded-lg flex items-center justify-center mx-auto mb-3">
                        <span class="text-green-400 font-bold text-xl">AP</span>
                    </div>
                    <p class="text-gray-300 text-sm">Apache</p>
                </div>
                
                <div class="text-center">
                    <div class="w-16 h-16 bg-gray-800 rounded-lg flex items-center justify-center mx-auto mb-3">
                        <span class="text-green-400 font-bold text-xl">DO</span>
                    </div>
                    <p class="text-gray-300 text-sm">Docker</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Sobre mí -->
    <section id="sobre-mi" class="py-20">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
                <!-- Contenido principal -->
                <div class="lg:col-span-2 space-y-6">
                    <div>
                        <h2 class="text-3xl md:text-4xl font-bold text-gray-100 mb-4">
                            Sobre <span class="text-green-400">mí</span>
                        </h2>
                        <p class="text-gray-400 mb-6">
                            Soy Víctor Visús García, desarrollador web especializado en crear soluciones digitales 
                            eficientes y atractivas. Mi enfoque combina la técnica con la estética para ofrecer 
                            experiencias web excepcionales.
                        </p>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="bg-gray-800/50 border border-gray-700 rounded-lg p-6">
                            <h3 class="text-xl font-semibold text-green-400 mb-3">Formación</h3>
                            <ul class="text-gray-400 space-y-2">
                                <li>• Desarrollo Web Full Stack</li>
                                <li>• Certificaciones técnicas</li>
                                <li>• Formación continua</li>
                            </ul>
                        </div>
                        
                        <div class="bg-gray-800/50 border border-gray-700 rounded-lg p-6">
                            <h3 class="text-xl font-semibold text-green-400 mb-3">Experiencia</h3>
                            <ul class="text-gray-400 space-y-2">
                                <li>• +5 años desarrollando</li>
                                <li>• Proyectos internacionales</li>
                                <li>• Clientes satisfechos</li>
                            </ul>
                        </div>
                    </div>
                    
                    <div class="bg-gray-800/50 border border-gray-700 rounded-lg p-6">
                        <h3 class="text-xl font-semibold text-green-400 mb-3">Filosofía de trabajo</h3>
                        <p class="text-gray-400">
                            Creo en el código limpio, el diseño centrado en el usuario y la importancia de 
                            mantenerme actualizado con las últimas tendencias tecnológicas. Cada proyecto es 
                            una oportunidad para aprender y mejorar.
                        </p>
                    </div>
                </div>
                
                <!-- Aside con información técnica -->
                <aside class="space-y-6">
                    <div class="bg-gray-800/50 border border-gray-700 rounded-lg p-6">
                        <h3 class="text-xl font-semibold text-green-400 mb-4">Datos técnicos</h3>
                        <div class="space-y-3">
                            <div class="flex justify-between">
                                <span class="text-gray-400">Backend:</span>
                                <span class="text-gray-200">PHP, Node.js</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-400">Frontend:</span>
                                <span class="text-gray-200">JavaScript, React</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-400">Diseño:</span>
                                <span class="text-gray-200">UI/UX, Tailwind</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-400">Base datos:</span>
                                <span class="text-gray-200">MySQL, MongoDB</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-400">Control versión:</span>
                                <span class="text-gray-200">Git, GitHub</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-gray-800/50 border border-gray-700 rounded-lg p-6">
                        <h3 class="text-xl font-semibold text-green-400 mb-4">Intereses</h3>
                        <ul class="text-gray-400 space-y-2">
                            <li>• Inteligencia Artificial</li>
                            <li>• Rendimiento web</li>
                            <li>• Accesibilidad</li>
                            <li>• Seguridad informática</li>
                            <li>• Nuevas tecnologías</li>
                        </ul>
                    </div>
                </aside>
            </div>
        </div>
    </section>
</main>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
