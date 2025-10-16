<body>
  <div id="root">
    <div class="font-sans">
      <div class="min-h-screen w-full relative app-preview">
        <div class="flex flex-col w-full h-full" id="app-demo">
          <div class="bg-white w-full min-h-full overflow-auto">
            <div id="component-preview-container">

            <!-- Navbar Superior SOLO escritorio -->
          <div class="navbar-desktop">
            <div class="max-w-[980px] mx-auto h-[58px] flex items-center justify-between text-white px-4">
              <!-- Izquierda -->
              <div class="flex items-center h-full">
                <a class="pr-4" href="inicio.php">
                  <h1 class="text-2xl font-bold" style="text-shadow: rgba(0,0,0,0.5) 0px 1px 1px;"><?php echo SITE; ?></h1>
                </a>
                <nav class="flex h-full">
                  <a class="nav-link" href="inicio.php">Inicio</a>
                  <a class="nav-link" href="perfil.php">Perfil</a>
                  <a class="nav-link" href="mp.php">Mensajes</a>
                  <a class="nav-link" href="gente.php">Gente</a>
                  <a class="nav-link" href="albums.php">Fotos</a>
                </nav>
              </div>
              <!-- Derecha -->
              <div class="flex items-center gap-4 h-full">
                <a class="treinty-button" href="subir_fotos.php">Subir fotos</a>
                <nav class="flex h-full">
                  <a class="nav-link" href="ajustes.php">Mi cuenta</a>
                  <a class="nav-link" href="logout.php">Salir</a>
                </nav>
              </div>
            </div>
          </div>


          <!-- Navbar inferior móvil -->
          <div class="navbar-mobile-bottom">
            <a href="inicio.php" class="icon-link"><span class="material-icons">home</span><span>Inicio</span></a>
            <a href="perfil.php" class="icon-link"><span class="material-icons">person</span><span>Perfil</span></a>
            <a href="mp.php" class="icon-link"><span class="material-icons">mail</span><span>Mensajes</span></a>
            <a href="gente.php" class="icon-link"><span class="material-icons">group</span><span>Gente</span></a>
            <a href="albums.php" class="icon-link"><span class="material-icons">photo</span><span>Fotos</span></a>
          </div>





              <!-- MAIN CONTENT -->
              <div class="page-container">
                <div class="flex layout-stack gap-[15px]">

                