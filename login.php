<?php
session_start();
require('inc/config.php');

if(isset($_SESSION['idsesion']) AND !$_GET['activacion'])
    header("Location: inicio.php");

$error = '';

if(!empty($_POST['email']) && !empty($_POST['password'])) {
    // Prepara la consulta por email
    $stmt = mysqli_prepare($link, "SELECT * FROM usuarios WHERE email = ? LIMIT 1");
    mysqli_stmt_bind_param($stmt, "s", $_POST['email']);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if($result && $r_login = mysqli_fetch_assoc($result)) {
        // Bypass de activación temporal
        // if($r_login['activacion'] != '1') {
        //     $error = "activacion";
        // } else {
        // Login seguro con password_verify
        if(password_verify($_POST['password'], $r_login['password'])) {
            $codigo_temp = rand(0, 99999999999);
            mysqli_query($link,"UPDATE usuarios SET idsesion='".$codigo_temp."' WHERE idusuarios='".$r_login['idusuarios']."'");
            mysqli_query($link,"INSERT INTO accesos (usuarios_idusuarios, ip, fecha) VALUES ('{$r_login["idusuarios"]}','{$_SERVER["REMOTE_ADDR"]}',now())");
            $_SESSION['idsesion']=$codigo_temp;
            header("Location: inicio.php");
            die();
        } else {
            $error = "datos";
        }
        // }
    } else {
        $error = "datos";
    }
    mysqli_stmt_close($stmt);
}

head("Login");
?>

<body class="bg-gray-100">
<div class="page-container">
    <div class="flex justify-center">
        <main class="w-full max-w-[500px] pt-10">
            <div class="box rounded-xl shadow-lg border bg-white">
                <div class="box-content px-6 py-5">
                    
                    <!-- Logo o título (opcional) -->
                    <div class="text-center mb-6">
                        <h1 class="text-2xl font-bold text-gray-800">Iniciar sesión</h1>
                        <p class="text-sm text-gray-600 mt-1">Accede a tu cuenta de Treinty</p>
                    </div>

                    <?php
                    // Mensajes de error
                    if($error){
                        echo "<div class='mb-4 p-3 bg-red-50 border border-red-200 rounded-lg'>";
                        echo "<p class='text-sm text-red-800'>";
                        if($error == "datos"){
                            echo "El email o la contraseña introducidos son incorrectos.<br>";
                            echo "<a href='otros.php?restore_pass=1' class='text-blue-600 hover:underline'>¿Quieres recuperar la contraseña?</a>";
                        }elseif($error == "activacion"){
                            echo "La cuenta no está activada aún, revisa tu cuenta de email.";
                        }
                        echo "</p></div>";
                    }

                    // Mensajes de activación
                    if($_GET['activacion']){
                        if($_GET['activacion'] == "ok"){
                            echo "<div class='mb-4 p-3 bg-green-50 border border-green-200 rounded-lg'>";
                            echo "<p class='text-sm text-green-800'>La cuenta se ha activado correctamente, ahora puedes entrar con tus datos.</p>";
                            echo "</div>";
                        }elseif($_GET['activacion'] == "fail"){
                            echo "<div class='mb-4 p-3 bg-red-50 border border-red-200 rounded-lg'>";
                            echo "<p class='text-sm text-red-800'>La activación de la cuenta ha fallado.</p>";
                            echo "</div>";
                        }elseif($_GET['activacion'] == "fail_email"){
                            echo "<div class='mb-4 p-3 bg-red-50 border border-red-200 rounded-lg'>";
                            echo "<p class='text-sm text-red-800'>Se ha producido un error al enviar el correo.</p>";
                            echo "</div>";
                        }
                    }
                    ?>

                    <form id='form_login' method='POST' action='login.php' class="space-y-4">
                        
                        <!-- Email -->
                        <div>
                            <label class="block text-sm font-bold mb-1">Email *</label>
                            <input
                                type="email"
                                id="email"
                                name="email"
                                class="w-full border border-gray-400 text-sm px-2 py-1 rounded focus:outline-blue-400"
                                placeholder="ejemplo@mail.com"
                                maxlength="40"
                                required
                                autofocus
                                value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>">
                        </div>

                        <!-- Contraseña -->
                        <div>
                            <label class="block text-sm font-bold mb-1">Contraseña *</label>
                            <input
                                type="password"
                                id="password"
                                name="password"
                                class="w-full border border-gray-400 text-sm px-2 py-1 rounded focus:outline-blue-400"
                                placeholder="Contraseña"
                                maxlength="30"
                                required>
                        </div>

                        <!-- Enlace recuperar contraseña -->
                        <div class="text-right">
                            <a href="otros.php?restore_pass=1" class="text-xs text-blue-600 hover:underline">¿Olvidaste tu contraseña?</a>
                        </div>

                        <!-- Botones -->
                        <div class="flex flex-col gap-2 pt-4">
                            <button type='submit' class="treinty-button w-full btn btn-primary">
                                Entrar
                            </button>
                        </div>

                        <!-- Enlace a registro -->
                        <div class="text-center text-xs text-gray-600 pt-2">
                            <p>¿No tienes cuenta? <a href="registro.php" class="text-blue-600 hover:underline">Regístrate gratis</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
</div>
</body>
