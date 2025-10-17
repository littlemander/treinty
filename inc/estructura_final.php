                            <!-- MOBILE BOTTOM NAVBAR -->
                            <nav class="md:hidden fixed bottom-0 left-0 right-0 treinty-blue shadow-lg z-30">
                                    <div class="flex items-center">
                                    <a class="mobile-nav-item " href="/Inicio">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-house w-5 h-5 mb-1">
                                        <path d="M15 21v-8a1 1 0 0 0-1-1h-4a1 1 0 0 0-1 1v8"></path>
                                        <path d="M3 10a2 2 0 0 1 .709-1.528l7-5.999a2 2 0 0 1 2.582 0l7 5.999A2 2 0 0 1 21 10v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                        </svg>
                                        <span class="text-[10px]">Inicio</span>
                                    </a>
                                    <a class="mobile-nav-item " href="/Mensajes">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-message-square w-5 h-5 mb-1">
                                        <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                                        </svg>
                                        <span class="text-[10px]">Mensajes</span>
                                    </a>
                                    <a class="mobile-nav-item " href="/Gente">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-users w-5 h-5 mb-1">
                                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="9" cy="7" r="4"></circle>
                                        <path d="M22 21v-2a4 4 0 0 0-3-3.87"></path>
                                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                        </svg>
                                        <span class="text-[10px]">Gente</span>
                                    </a>
                                    <a class="mobile-nav-item " href="perfil.php">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-user w-5 h-5 mb-1">
                                        <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="12" cy="7" r="4"></circle>
                                        </svg>
                                        <span class="text-[10px]">Perfil</span>
                                    </a>
                                    </div>
                            </nav>
                            <!-- FINAL MOBILE BOTTOM NAVBAR --> 

                            <!-- FOOTER -->
                            <footer class="hidden md:block bg-white border-t border-gray-200 mt-8 py-4">
                                    <div class="max-w-[1200px] mx-auto px-4">
                                    <div class="flex items-center justify-center gap-4 text-xs text-gray-500">
                                        <span >© Treinty 2025</span>
                                        <a href="#" class="hover:text-gray-700">Castellano</a>
                                        <a href="#" class="hover:text-gray-700">Anúnciate</a>
                                        <a href="#" class="hover:text-gray-700">Empleo</a>
                                        <a href="#" class="hover:text-gray-700">Blog</a>
                                        <a href="#" class="hover:text-gray-700">Desarrolladores</a>
                                        <a href="#" class="hover:text-gray-700">Móvil</a>
                                        <a href="#" class="hover:text-gray-700">Condiciones de uso</a>
                                        <a href="#" class="hover:text-gray-700">Política de privacidad</a>
                                        <a href="#" class="hover:text-gray-700">Ayuda</a>
                                    </div>
                                    </div>
                            </footer>
                            <!-- FINAL FOOTER -->

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<script>
// Seleccionar los elementos
const burgerButton = document.getElementById('burger');
const mobileMenu = document.querySelector('.mobile-menu');
const overlay = document.querySelector('.mobile-menu-overlay');

// Función para abrir el menú
function openMenu() {
    mobileMenu.classList.add('active');
    overlay.classList.add('active');
}

// Función para cerrar el menú
function closeMenu() {
    mobileMenu.classList.remove('active');
    overlay.classList.remove('active');
}

// Abrir menú al hacer click en el burger
burgerButton.addEventListener('click', function() {
    if (mobileMenu.classList.contains('active')) {
        closeMenu();
    } else {
        openMenu();
    }
});

// Cerrar menú al hacer click en el overlay
overlay.addEventListener('click', function() {
    closeMenu();
});

// Cerrar menú al hacer click en la X
const closeButton = mobileMenu.querySelector('.treinty-blue button');
closeButton.addEventListener('click', function() {
    closeMenu();
});

// Opcional: Cerrar el menú al hacer click en cualquier enlace
const menuLinks = mobileMenu.querySelectorAll('nav a');
menuLinks.forEach(link => {
    link.addEventListener('click', function() {
        closeMenu();
    });
});


</script>
</html>