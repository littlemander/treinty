<?php

define("SITE", "Social");
define("HOST_DOMAIN", "127.0.0.1");
define("MySQL_IP", "127.0.0.1");
define("MySQL_USER", "root");
define("MySQL_PASS", "");
define("MySQL_BD", "treinty");
define("EMAIL_ADDRESS", "");

// error_reporting(E_ALL); ini_set('display_errors',1);

$link = mysqli_connect(MySQL_IP, MySQL_USER, MySQL_PASS, MySQL_BD);
if (!$link) {
    die("Error al conectar con MySQL: " . mysqli_connect_error());
}
if (!mysqli_set_charset($link, "utf8mb4")) {
    die("No se pudo establecer charset utf8mb4: " . mysqli_error($link));
}

setlocale(LC_ALL, "es_ES.UTF-8", "es_ES", "Spanish_Spain.1252", "esp");

if (!mysqli_query($link, "SET lc_time_names = 'es_ES'")) {
    die("MySQL lc_time_names error: " . mysqli_error($link));
}

require(__DIR__ . "/functions.php");

?>