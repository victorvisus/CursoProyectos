<?php
/**
 * Footer del sitio
 * Cypherstudios - Víctor Visús García
 */
?>
    <!-- Footer -->
    <footer id="contacto" class="bg-gray-900 border-t border-gray-800">
        <div class="container mx-auto px-4 py-12">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Formulario de contacto -->
                <div>
                    <h2 class="text-2xl font-semibold text-green-400 mb-6">Contacto</h2>
                    
                    <?php if (isset($_GET['contact']) && $_GET['contact'] === 'success'): ?>
                        <div class="bg-green-900/50 border border-green-400 text-green-300 px-4 py-3 rounded-md mb-6">
                            ¡Mensaje enviado correctamente! Te responderé lo antes posible.
                        </div>
                    <?php endif; ?>
                    
                    <?php if (isset($_GET['contact']) && $_GET['contact'] === 'error'): ?>
                        <div class="bg-red-900/50 border border-red-400 text-red-300 px-4 py-3 rounded-md mb-6">
                            Error al enviar el mensaje. Por favor, inténtalo de nuevo.
                        </div>
                    <?php endif; ?>
                    
                    <form action="<?= SITE_URL ?>/forms/contact.php" method="POST" class="space-y-4" id="contact-form">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-300 mb-1">Nombre *</label>
                            <input type="text" id="name" name="name" required
                                   class="w-full px-4 py-2 bg-gray-800 border border-gray-700 rounded-md text-gray-100 focus:outline-none focus:ring-2 focus:ring-green-400 focus:border-transparent"
                                   placeholder="Tu nombre">
                        </div>
                        
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-300 mb-1">Email *</label>
                            <input type="email" id="email" name="email" required
                                   class="w-full px-4 py-2 bg-gray-800 border border-gray-700 rounded-md text-gray-100 focus:outline-none focus:ring-2 focus:ring-green-400 focus:border-transparent"
                                   placeholder="tu@email.com">
                        </div>
                        
                        <div>
                            <label for="subject" class="block text-sm font-medium text-gray-300 mb-1">Asunto *</label>
                            <input type="text" id="subject" name="subject" required
                                   class="w-full px-4 py-2 bg-gray-800 border border-gray-700 rounded-md text-gray-100 focus:outline-none focus:ring-2 focus:ring-green-400 focus:border-transparent"
                                   placeholder="Asunto del mensaje">
                        </div>
                        
                        <div>
                            <label for="message" class="block text-sm font-medium text-gray-300 mb-1">Mensaje *</label>
                            <textarea id="message" name="message" rows="4" required
                                      class="w-full px-4 py-2 bg-gray-800 border border-gray-700 rounded-md text-gray-100 focus:outline-none focus:ring-2 focus:ring-green-400 focus:border-transparent resize-none"
                                      placeholder="Tu mensaje..."></textarea>
                        </div>
                        
                        <button type="submit" 
                                class="w-full bg-green-400 text-gray-950 font-semibold py-3 px-6 rounded-md hover:bg-green-300 transition-colors focus:outline-none focus:ring-2 focus:ring-green-400 focus:ring-offset-2 focus:ring-offset-gray-900">
                            Enviar mensaje
                        </button>
                    </form>
                </div>
                
                <!-- Información de contacto -->
                <div>
                    <h2 class="text-2xl font-semibold text-green-400 mb-6">Información</h2>
                    
                    <div class="space-y-4">
                        <div>
                            <h3 class="text-lg font-medium text-gray-200 mb-2">Cypherstudios</h3>
                            <p class="text-gray-400">Diseño y desarrollo web con enfoque técnico y criterio visual</p>
                        </div>
                        
                        <div>
                            <h4 class="text-sm font-medium text-gray-300 mb-2">Servicios</h4>
                            <ul class="text-gray-400 space-y-1">
                                <li>• Desarrollo web a medida</li>
                                <li>• Diseño UI/UX</li>
                                <li>• Optimización SEO</li>
                                <li>• Mantenimiento web</li>
                            </ul>
                        </div>
                        
                        <div>
                            <h4 class="text-sm font-medium text-gray-300 mb-2">Contacto directo</h4>
                            <p class="text-gray-400">
                                Email: <a href="mailto:victor.vxg@gmail.com" class="text-green-400 hover:text-green-300 transition-colors">victor.vxg@gmail.com</a>
                            </p>
                        </div>
                        
                        <div>
                            <h4 class="text-sm font-medium text-gray-300 mb-2">Ubicación</h4>
                            <p class="text-gray-400">España</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Copyright -->
            <div class="border-t border-gray-800 mt-12 pt-8">
                <div class="flex flex-col md:flex-row justify-between items-center">
                    <p class="text-gray-400 text-sm">
                        © <?= date('Y') ?> Cypherstudios - Víctor Visús García. Todos los derechos reservados.
                    </p>
                    <p class="text-gray-500 text-xs mt-2 md:mt-0">
                        Desarrollado con ❤️ y mucho café
                    </p>
                </div>
            </div>
        </div>
    </footer>
    
    <!-- Volver arriba -->
    <button id="back-to-top" 
            class="fixed bottom-6 right-6 bg-green-400 text-gray-950 p-3 rounded-full shadow-lg hover:bg-green-300 transition-all opacity-0 invisible z-30"
            aria-label="Volver arriba">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
        </svg>
    </button>
</body>
</html>
