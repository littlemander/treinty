<?php
require ('inc/config.php');
head("Registro");
?>

<script>
$(function() {
    var date = new Date();
    var year = date.getFullYear();
    var top_year = year - 14;
    $("#birth_date").datepicker({
        changeMonth : true,
        changeYear : true,
        yearRange : "1940:"+top_year,
        defaultDate : "-25 y",
        dateFormat: "d 'de' MM 'de' yy",
        altField: "#birth_date_hidden",
        altFormat: "yy-mm-dd",
    });
}); 
</script>

<body class="bg-gray-100">
<div class="page-container">
    <div class="flex justify-center">
        <main class="w-full max-w-[500px] pt-10">
            <div class="box rounded-xl shadow-lg border bg-white">
                <div class="box-content px-6 py-5">

                    <?php
                    // Mensajes/errores
                    if ($_POST) require("registro-post.php");
                    ?>

                    <form id="register-form" method="post" action="registro.php" class="space-y-4">
                        <!-- Error/Success Messages -->
                        <div id="form-messages" class="hidden"></div>

                        <!-- Nombre y Apellidos -->
                        <div class="flex gap-2">
                            <div class="flex-1">
                                <label class="block text-sm font-bold mb-1">Nombre *</label>
                                <input 
                                    type="text"
                                    name="Nombre"
                                    class="w-full border border-gray-400 text-sm px-2 py-1 rounded focus:outline-blue-400"
                                    placeholder="Tu nombre"
                                    maxlength="100"
                                    required
                                    value="<?php echo $_POST['Nombre'] ?? ''; ?>">
                            </div>
                            <div class="flex-1">
                                <label class="block text-sm font-bold mb-1">Apellidos *</label>
                                <input 
                                    type="text"
                                    name="Apellidos"
                                    class="w-full border border-gray-400 text-sm px-2 py-1 rounded focus:outline-blue-400"
                                    placeholder="Tus apellidos"
                                    maxlength="150"
                                    required
                                    value="<?php echo $_POST['Apellidos'] ?? ''; ?>">
                            </div>
                        </div>

                        <!-- Email -->
                        <div>
                            <label class="block text-sm font-bold mb-1">Email *</label>
                            <input
                                type="email"
                                name="Email"
                                class="w-full border border-gray-400 text-sm px-2 py-1 rounded focus:outline-blue-400"
                                placeholder="tu@email.com"
                                maxlength="150"
                                required
                                value="<?php echo $_POST['Email'] ?? ''; ?>">
                        </div>

                        <!-- Contraseña -->
                        <div>
                            <label class="block text-sm font-bold mb-1">Contraseña *</label>
                            <input
                                type="password"
                                name="contrasenia"
                                class="w-full border border-gray-400 text-sm px-2 py-1 rounded focus:outline-blue-400"
                                placeholder="Mínimo 6 caracteres"
                                minlength="6"
                                required>
                        </div>

                        <!-- Género y Fecha nacimiento -->
                        <div class="flex gap-2">
                            <div class="flex-1">
                                <label class="block text-sm font-bold mb-1">Género *</label>
                                <select
                                    name="Sexo"
                                    class="w-full border border-gray-400 text-sm px-2 py-1 rounded focus:outline-blue-400"
                                    required>
                                    <option value="">Selecciona...</option>
                                    <option value="h" <?php if(@$_POST['Sexo']=="h") echo 'selected'; ?>>Masculino</option>
                                    <option value="m" <?php if(@$_POST['Sexo']=="m") echo 'selected'; ?>>Femenino</option>
                                </select>
                            </div>
                            <div class="flex-1">
                                <label class="block text-sm font-bold mb-1">Fecha de nacimiento *</label>
                                <input
                                    type="text"
                                    name="nacimiento"
                                    id="birth_date"
                                    class="w-full border border-gray-400 text-sm px-2 py-1 rounded focus:outline-blue-400"
                                    required
                                    value="<?php echo $_POST['nacimiento'] ?? ''; ?>">
                                <input id="birth_date_hidden" name="nacimiento_hidden" type="text" style="display:none;" value="<?php echo $_POST['nacimiento_hidden'] ?? ''; ?>">
                            </div>
                        </div>

                        <!-- Provincia -->
                        <div>
                            <label class="block text-sm font-bold mb-1">Provincia (opcional)</label>
                            <select 
                                name="Provincia"
                                class="w-full border border-gray-400 text-sm px-2 py-1 rounded focus:outline-blue-400">
                                <option value="">Selecciona tu provincia...</option>
                                <?php require ("inc/select_provincias.html"); ?>
                            </select>
                        </div>

                        <!-- Términos -->
                        <div class="text-xs text-gray-600">
                            <label class="flex items-start gap-2">
                                <input type="checkbox" id="checkbox_tos" name="tos" class="border border-gray-400 mt-0.5 rounded" value="tos_yes" required <?php if(@$_POST['tos']=="tos_yes") echo 'checked'; ?>>
                                <span>Acepto los <a href="#" class="text-blue-600 hover:underline">términos y condiciones</a> y la <a href="#" class="text-blue-600 hover:underline">política de privacidad</a> de Treinty.</span>
                            </label>
                        </div>

                        <!-- Botón de registro -->
                        <div class="flex gap-2 pt-4">
                            <button type="submit" class="treinty-button flex-1 btn btn-primary">
                                Crear mi cuenta en Treinty
                            </button>
                        </div>

                        <!-- Enlaces adicionales -->
                        <div class="text-center text-xs text-gray-600 pt-2">
                            <p>¿Ya tienes cuenta? <a href="login.php" class="text-blue-600 hover:underline">Iniciar sesión</a></p>
                        </div>
                        <input type="hidden" name="Registro" value="yes">
                    </form>
                </div>
            </div>
        </main>
    </div>
</div>
</body>
