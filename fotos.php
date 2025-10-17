<?php
require ("inc/verify_login.php");

if (!$_GET['idalbum']) 
    header("Location: inicio.php?noidalbum");

head("Fotos");
echo "<script type='text/javascript' src='assets/js/foto_edicion.js'></script>";
echo "<script type='text/javascript' src='assets/js/foto_visualizador.js'></script>";
echo "<body id='seccion_fotos'>";
require ("inc/estructura_inicio.php");
require ("inc/chat.php");

if (!$_GET['iduser']) {
    $_GET['iduser'] = $global_idusuarios;
}

if (!$_GET['idfotos']) {
    $_GET['idfotos'] = "999999999";
}

// Sanitizar inputs para prevenir SQL injection
$iduser = mysqli_real_escape_string($link, $_GET['iduser']);
$idalbum = mysqli_real_escape_string($link, $_GET['idalbum']);
$idfotos = mysqli_real_escape_string($link, $_GET['idfotos']);

if ($idalbum == 'subidas') {
    $query = "SELECT *,
                (SELECT MIN(idfotos) FROM fotos WHERE uploader = '$iduser') AS ultima,
                (SELECT MAX(idfotos) FROM fotos WHERE uploader = '$iduser') AS primera,
                (SELECT MIN(idfotos) FROM fotos WHERE uploader = '$iduser' AND idfotos > '$idfotos') AS anterior,
                (SELECT MAX(idfotos) FROM fotos WHERE uploader = '$iduser' AND idfotos < '$idfotos') AS siguiente,
                @totales:=(SELECT COUNT(idfotos) FROM fotos WHERE uploader = '$iduser') AS totales,
                (SELECT @totales - COUNT(idfotos) FROM fotos WHERE uploader = '$iduser' AND idfotos < '$idfotos') AS actual
            FROM fotos
            LEFT JOIN albums ON albums_idalbums=idalbums
            LEFT JOIN usuarios ON uploader=idusuarios
            WHERE idfotos='$idfotos'";
    $q_fotos = mysqli_query($link, $query);
    $r_fotos = mysqli_fetch_assoc($q_fotos);
    
} elseif ($idalbum == 'etiquetadas') {
    $query = "SELECT *,
                (SELECT MIN(idfotos) FROM fotos, etiquetas WHERE usuarios_idusuarios='$iduser' AND idfotos=fotos_idfotos) AS ultima,
                (SELECT MAX(idfotos) FROM fotos, etiquetas WHERE usuarios_idusuarios='$iduser' AND idfotos=fotos_idfotos) AS primera,
                (SELECT MIN(idfotos) FROM fotos, etiquetas WHERE usuarios_idusuarios='$iduser' AND idfotos=fotos_idfotos AND idfotos > '$idfotos') AS anterior,
                (SELECT MAX(idfotos) FROM fotos, etiquetas WHERE usuarios_idusuarios='$iduser' AND idfotos=fotos_idfotos AND idfotos < '$idfotos') AS siguiente,
                @totales:=(SELECT COUNT(idfotos) FROM fotos, etiquetas WHERE usuarios_idusuarios='$iduser' AND idfotos=fotos_idfotos) AS totales,
                (SELECT @totales - COUNT(idfotos) FROM fotos, etiquetas WHERE usuarios_idusuarios='$iduser' AND idfotos=fotos_idfotos AND idfotos < '$idfotos') AS actual
            FROM fotos
            LEFT JOIN albums ON albums_idalbums=idalbums
            LEFT JOIN usuarios ON uploader=idusuarios
            WHERE idfotos='$idfotos'";
            
    $q_fotos = mysqli_query($link, $query);
    $r_fotos = mysqli_fetch_assoc($q_fotos);
    
} else {
    $query = "SELECT *,
                (SELECT MIN(idfotos) FROM fotos WHERE albums_idalbums='$idalbum') AS ultima,
                (SELECT MAX(idfotos) FROM fotos WHERE albums_idalbums='$idalbum') AS primera,
                (SELECT MIN(idfotos) FROM fotos WHERE albums_idalbums='$idalbum' AND idfotos > '$idfotos') AS anterior,
                (SELECT MAX(idfotos) FROM fotos WHERE albums_idalbums='$idalbum' AND idfotos < '$idfotos') AS siguiente,
                @totales:=(SELECT COUNT(idfotos) FROM fotos WHERE albums_idalbums='$idalbum') AS totales,
                (SELECT @totales - COUNT(idfotos) FROM fotos WHERE albums_idalbums='$idalbums' AND idfotos < '$idfotos') AS actual
            FROM fotos
            LEFT JOIN albums ON albums_idalbums=idalbums
            LEFT JOIN usuarios ON uploader=idusuarios
            WHERE idfotos='$idfotos' AND albums_idalbums='$idalbum'";
    $q_fotos = mysqli_query($link, $query);
    $r_fotos = mysqli_fetch_assoc($q_fotos);
}

require ("inc/fotos/main.inc.php");
require ("inc/fotos/barra.inc.php");
require ("inc/fotos/comentarios.inc.php");
?>
