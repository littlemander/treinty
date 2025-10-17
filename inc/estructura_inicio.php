<div id="root">
    <div class="min-h-screen w-full relative app-preview">
        <div class="flex flex-col w-full h-full" id="app-demo">
            <div class="bg-white w-full min-h-full overflow-auto">
                <div id="component-preview-container">
                    <div class="min-h-screen bg-[#e8eef4] pb-16 md:pb-0">

                          <?php
                            // Detecta el archivo actual
                            $current_file = basename($_SERVER['PHP_SELF']);
                            // Para detectar páginas por querystring si lo necesitas más adelante:
                            $mp_recibidos = ($current_file == 'mp.php' && isset($_GET['modo']) && $_GET['modo'] == 'recibidos');
                            ?>

                            <!-- NAVBAR HEADER (DESKTOP) -->
                            <header class="treinty-blue shadow-md sticky top-0 z-30">
                                <div class="max-w-[1200px] mx-auto px-4">
                                    <div class="flex items-center justify-between h-[48px]">
                                        <button id="burger" class="md:hidden text-white p-2 hover:bg-white/10 rounded">
                                            <!-- Icono menú -->
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"><line x1="4" x2="20" y1="12" y2="12"></line><line x1="4" x2="20" y1="6" y2="6"></line><line x1="4" x2="20" y1="18" y2="18"></line></svg>
                                        </button>
                                        <a class="treinty-logo flex items-center gap-2" href="/Inicio">
                                            <div class="w-6 h-6 bg-white rounded-sm flex items-center justify-center">
                                                <span class="text-[#5487ba] text-xl font-bold">t</span>
                                            </div>
                                            <span class="hidden sm:inline">treinty</span>
                                        </a>
                                        <nav class="hidden md:flex items-center gap-1">
                                            <a class="treinty-nav-item <?php echo ($current_file == 'inicio.php') ? 'active' : ''; ?>" href="inicio.php">Inicio</a>
                                            <a class="treinty-nav-item <?php echo ($current_file == 'perfil.php') ? 'active' : ''; ?>" href="perfil.php">Perfil</a>
                                            <a class="treinty-nav-item <?php echo $mp_recibidos ? 'active' : ''; ?>" href="mp.php?modo=recibidos">Mensajes</a>
                                            <a class="treinty-nav-item <?php echo ($current_file == 'gente.php') ? 'active' : ''; ?>" href="gente.php">Gente</a>
                                            <a class="treinty-nav-item" href="#">Vídeos</a>
                                            <a class="treinty-nav-item" href="#">Juegos</a>
                                            <a class="treinty-nav-item" href="#">Sitios</a>
                                        </nav>
                                        <div class="flex items-center gap-2">
                                            <a class="hidden md:block" href="subir_fotos.php">
                                                <button class="treinty-button flex items-center gap-1">
                                                    <!-- Icono cámara -->
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"><path d="M14.5 4h-5L7 7H4a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2h-3l-2.5-3z"></path><circle cx="12" cy="13" r="3"></circle></svg>
                                                    Subir fotos
                                                </button>
                                            </a>
                                            <a class="md:hidden" href="subir_fotos.php">
                                                <button class="text-white p-2 hover:bg-white/10 rounded">
                                                    <!-- Icono cámara mobile -->
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"><path d="M14.5 4h-5L7 7H4a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2h-3l-2.5-3z"></path><circle cx="12" cy="13" r="3"></circle></svg>
                                                </button>
                                            </a>
                                            <a href="ajustes.php">
                                                <button class="hidden md:block text-white hover:bg-white/10 p-2 rounded">
                                                    <!-- Icono configuración -->
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"><path d="M12.22 2h-.44a2 2 0 0 0-2 2v.18a2 2 0 0 1-1 1.73l-.43.25a2 2 0 0 1-2 0l-.15-.08a2 2 0 0 0-2.73.73l-.22.38a2 2 0 0 0 .73 2.73l.15.1a2 2 0 0 1 1 1.72v.51a2 2 0 0 1-1 1.74l-.15.09a2 2 0 0 0-.73 2.73l.22.38a2 2 0 0 0 2.73.73l.15-.08a2 2 0 0 1 2 0l.43.25a2 2 0 0 1 1 1.73V20a2 2 0 0 0 2 2h.44a2 2 0 0 0 2-2v-.18a2 2 0 0 1 1-1.73l.43-.25a2 2 0 0 1 2 0l.15.08a2 2 0 0 0 2.73-.73l.22-.39a2 2 0 0 0-.73-2.73l-.15-.08a2 2 0 0 1-1-1.74v-.5a2 2 0 0 1 1-1.74l.15-.09a2 2 0 0 0 .73-2.73l-.22-.38a2 2 0 0 0-2.73-.73l-.15.08a2 2 0 0 1-2 0l-.43-.25a2 2 0 0 1-1-1.73V4a2 2 0 0 0-2-2z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                                                </button>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </header>
                            <!-- FINAL NAVBAR HEADER -->

                            <!-- SIDEBAR MOBILE MENU -->
                            <div class="mobile-menu-overlay md:hidden"></div>
                            <div class="mobile-menu md:hidden">
                                <div class="treinty-blue p-4 flex items-center justify-between">
                                    <div class="flex items-center gap-3">
                                        <img src="<?php echo isset($r_user['archivo']) ? $r_user['archivo'] : 'ruta_defecto'; ?>" alt="Profile" class="w-12 h-12 rounded object-cover">
                                        <div class="text-white">
                                            <p class="font-semibold text-sm"><?php echo isset($global_nombrefull) ? $global_nombrefull : 'Usuario'; ?></p>
                                            <p class="text-xs opacity-90">Ver perfil</p>
                                        </div>
                                    </div>
                                    <button class="text-white p-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"><path d="M18 6 6 18"></path><path d="m6 6 12 12"></path></svg>
                                    </button>
                                </div>
                                <nav class="py-2">
                                    <a class="flex items-center gap-3 px-4 py-3 text-sm transition text-gray-700 hover:bg-gray-50 <?php echo ($current_file == 'inicio.php') ? 'active' : ''; ?>" href="inicio.php">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"><path d="M15 21v-8a1 1 0 0 0-1-1h-4a1 1 0 0 0-1 1v8"></path><path d="M3 10a2 2 0 0 1 .709-1.528l7-5.999a2 2 0 0 1 2.582 0l7 5.999A2 2 0 0 1 21 10v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path></svg>Inicio
                                    </a>
                                    <a class="flex items-center gap-3 px-4 py-3 text-sm transition text-gray-700 hover:bg-gray-50 <?php echo ($current_file == 'perfil.php') ? 'active' : ''; ?>" href="perfil.php">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>Perfil
                                    </a>
                                    <a class="flex items-center gap-3 px-4 py-3 text-sm transition text-gray-700 hover:bg-gray-50 <?php echo $mp_recibidos ? 'active' : ''; ?>" href="mp.php?modo=recibidos">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>Mensajes
                                    </a>
                                    <a class="flex items-center gap-3 px-4 py-3 text-sm transition text-gray-700 hover:bg-gray-50 <?php echo ($current_file == 'gente.php') ? 'active' : ''; ?>" href="gente.php">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M22 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>Gente
                                    </a>
                                    <!-- Enlaces externos solo pueden estar activos si los gestionas por URI, pero así queda limpio -->
                                    <a class="flex items-center gap-3 px-4 py-3 text-sm transition text-gray-700 hover:bg-gray-50" href="#">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"><rect x="2" y="6" width="14" height="12" rx="2"></rect></svg>Vídeos
                                    </a>
                                    <a class="flex items-center gap-3 px-4 py-3 text-sm transition text-gray-700 hover:bg-gray-50" href="#">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"><line x1="6" x2="10" y1="11" y2="11"></line><line x1="8" x2="8" y1="9" y2="13"></line><line x1="15" x2="15.01" y1="12" y2="12"></line><line x1="18" x2="18.01" y1="10" y2="10"></line><path d="M17.32 5H6.68a4 4 0 0 0-3.978 3.59c-.006.052-.01.101-.017.152C2.604 9.416 2 14.456 2 16a3 3 0 0 0 3 3c1 0 1.5-.5 2-1l1.414-1.414A2 2 0 0 1 9.828 16h4.344a2 2 0 0 1 1.414.586L17 18c.5.5 1 1 2 1a3 3 0 0 0 3-3c0-1.545-.604-6.584-.685-7.258-.007-.05-.011-.1-.017-.151A4 4 0 0 0 17.32 5z"></path></svg>Juegos
                                    </a>
                                    <a class="flex items-center gap-3 px-4 py-3 text-sm transition bg-blue-50 text-blue-700 font-semibold border-l-4 border-blue-600" href="#">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"><path d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0"></path><circle cx="12" cy="10" r="3"></circle></svg>Sitios
                                    </a>
                                </nav>
                                <div class="border-t mt-2 pt-2">
                                    <a href="ajustes.php">
                                        <button class="flex items-center gap-3 px-4 py-3 text-sm text-gray-700 hover:bg-gray-50 w-full">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"><path d="M12.22 2h-.44a2 2 0 0 0-2 2v.18a2 2 0 0 1-1 1.73l-.43.25a2 2 0 0 1-2 0l-.15-.08a2 2 0 0 0-2.73.73l-.22.38a2 2 0 0 0 .73 2.73l.15.1a2 2 0 0 1 1 1.72v.51a2 2 0 0 1-1 1.74l-.15.09a2 2 0 0 0-.73 2.73l.22.38a2 2 0 0 0 2.73.73l.15-.08a2 2 0 0 1 2 0l.43.25a2 2 0 0 1 1 1.73V20a2 2 0 0 0 2 2h.44a2 2 0 0 0 2-2v-.18a2 2 0 0 1 1-1.73l.43-.25a2 2 0 0 1 2 0l.15.08a2 2 0 0 0 2.73-.73l.22-.39a2 2 0 0 0-.73-2.73l-.15-.08a2 2 0 0 1-1-1.74v-.5a2 2 0 0 1 1-1.74l.15-.09a2 2 0 0 0 .73-2.73l-.22-.38a2 2 0 0 0-2.73-.73l-.15.08a2 2 0 0 1-2 0l-.43-.25a2 2 0 0 1-1-1.73V4a2 2 0 0 0-2-2z"></path><circle cx="12" cy="12" r="3"></circle></svg>Configuración
                                        </button>
                                    </a>
                                    <button class="flex items-center gap-3 px-4 py-3 text-sm text-red-600 hover:bg-red-50 w-full">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" x2="9" y1="12" y2="12"></line></svg>Cerrar sesión
                                    </button>
                                </div>
                            </div>
                            <!-- FINAL SIDEBAR MOBILE MENU -->


                          <!-- MAIN CONTENT -->
                          <div class="max-w-[1200px] mx-auto px-2 sm:px-4 py-4">