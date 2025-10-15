<?php
// Validar campos obligatorios
$required = ['Nombre', 'Apellidos', 'contrasenia', 'Email', 'nacimiento_hidden'];
foreach ($required as $campo) {
    if (empty($_POST[$campo])) {
        echo "<div class='centrar'><div class='error_ajustable'>
        <h3 style='text-align: center; color: red; margin:5px 5px 30px 5px;'>El Registro no se ha llevado a cabo</h3>
        <div>Debes rellenar todos los campos correctamente.</div>
        </div></div>";
        return;
    }
}

// Comprobar email duplicado
$email_check = mysqli_prepare($link, "SELECT 1 FROM usuarios WHERE email = ? LIMIT 1");
mysqli_stmt_bind_param($email_check, "s", $_POST['Email']);
mysqli_stmt_execute($email_check);
mysqli_stmt_store_result($email_check);
$num = mysqli_stmt_num_rows($email_check);
mysqli_stmt_close($email_check);

if ($num > 0) {
    echo "<div class='centrar'><div class='error_ajustable'>
    <h3 style='text-align: center; color: red; margin:5px 5px 30px 5px;'>El Registro no se ha llevado a cabo</h3>
    El correo electrónico (email) que has usado ya ha sido registrado.<br>
    </div></div>";
    return;
}

// Preparar datos para el registro
$nombre     = trim($_POST['Nombre']);
$apellidos  = trim($_POST['Apellidos']);
$fnac       = trim($_POST['nacimiento_hidden']);
$pass_hash  = password_hash($_POST['contrasenia'], PASSWORD_DEFAULT);
$email      = trim($_POST['Email']);
$sexo       = $_POST['Sexo'];
$provincia  = $_POST['Provincia'];
$activacion = 1;

// Insertar usuario
$stmt = mysqli_prepare($link,
    "INSERT INTO usuarios 
    (nombre, apellidos, fnac, password, email, fecha_reg, sexo, provincia, activacion) 
    VALUES (?, ?, ?, ?, ?, NOW(), ?, ?, ?)"
);

mysqli_stmt_bind_param($stmt,
    "ssssssii",
    $nombre,
    $apellidos,
    $fnac,
    $pass_hash,
    $email,
    $sexo,
    $provincia,
    $activacion
);

if (!mysqli_stmt_execute($stmt)) {
    echo "<div class='centrar'><div class='error_ajustable'>
    <h3 style='text-align: center; color: red; margin:5px 5px 30px 5px;'>El Registro no se ha llevado a cabo</h3>
    Error al insertar usuario. Por favor, inténtalo de nuevo o contacta al soporte.<br>
    </div></div>";
    mysqli_stmt_close($stmt);
    return;
}

mysqli_stmt_close($stmt);

echo "<div class='centrar'><div class='marco'>
    <h3 style='text-align: center;color: green;margin:5px;'>Registro completado con éxito</h3>
    <p>Ya puedes iniciar sesión con tu email y contraseña.</p>
    </div></div>";
?>
