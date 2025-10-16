<?php
require("inc/verify_login.php");
head("Albums");
echo "<body id='seccion_albums'>";
require("inc/estructura_inicio.php");
?>
<div class="barra_full">
    <div class="marco">
        <?php
        // Albums de fotos de ¿?
        if (!$_GET['iduser']) {
            $_GET['iduser'] = $global_idusuarios;
            $user = 'yo';
            echo "<h2 style='margin-bottom:0px;'>Mis Albums de imagenes</h2>";
        } else {
            $usuario = mysqli_query($link,"SELECT * FROM usuarios WHERE idusuarios='" . $_GET['iduser'] . "'");
            if (mysqli_num_rows($usuario) > 0) {
                $row = mysqli_fetch_assoc($usuario);
                echo "<h2 style='margin-bottom:0px;'>Albums de imagenes de " . htmlspecialchars($row['nombre']) . "</h2>";
            }
        }
        ?>

        <!-- Subidas -->
        <div class='album'>
            <div class='album_titulo'>
                <a href='album.php?iduser=<?php echo $_GET['iduser']; ?>&idalbum=subidas'>Fotos subidas</a>
            </div>
            <div class="album_cubiertas">
                <?php
                $fotos = mysqli_query($link,"SELECT * FROM fotos WHERE uploader='" . $_GET['iduser'] . "' ORDER BY idfotos DESC LIMIT 3");
                if (mysqli_num_rows($fotos)) {
                    while ($row = mysqli_fetch_assoc($fotos)) {
                        echo "<a href='album.php?iduser=" . $_GET['iduser'] . "&idalbum=subidas'><img class='album_cubierta' alt='cubierta album' src='" . htmlspecialchars($row['archivo']) . "' /></a>";
                    }
                } else {
                    echo "<span>No has subido ninguna foto</span>";
                }
                ?>
            </div>
        </div>

        <!-- Etiquetadas -->
        <div class='album'>
            <div class='album_titulo'>
                <a href='album.php?iduser=<?php echo $_GET['iduser']; ?>&idalbum=etiquetadas'>Fotos etiquetadas</a>
            </div>
            <div class="album_cubiertas">
                <?php
                $fotos = mysqli_query($link,"SELECT * FROM fotos, etiquetas WHERE usuarios_idusuarios = '" . $_GET['iduser'] . "' AND idfotos = fotos_idfotos ORDER BY idfotos DESC LIMIT 3");
                if (mysqli_num_rows($fotos)) {
                    while ($row = mysqli_fetch_assoc($fotos)) {
                        echo "<a href='album.php?iduser=" . $_GET['iduser'] . "&idalbum=etiquetadas'><img class='album_cubierta' alt='cubierta album' src='" . htmlspecialchars($row['archivo']) . "' /></a>";
                    }
                } else {
                    echo "<span>No estas etiquetado en ninguna foto</span>";
                }
                ?>
            </div>
        </div>

        <!-- Personalizados -->
        <h2 style='clear: both;margin-bottom:0px;'>Albums personales</h2>
        <?php
        $personalizados = mysqli_query($link,"SELECT * FROM `albums` WHERE usuarios_idusuarios='" . $_GET['iduser'] . "'");
        if (mysqli_num_rows($personalizados) > 0) {
            while ($row = mysqli_fetch_assoc($personalizados)) {
                echo "<div class='album'><div class='album_titulo'>
                        <a href='album.php?iduser=" . $_GET['iduser'] . "&idalbum=" . $row['idalbums'] . "'>" . htmlspecialchars($row['album']) . "</a>
                        <div class='album_renombrar' onclick=\"album_renombrar('" . $row['idalbums'] . "','" . htmlspecialchars($row['album']) . "')\"></div>
                        <div class='album_borrar' onclick=\"album_borrar('" . $row['idalbums'] . "','" . htmlspecialchars($row['album']) . "')\"></div>
                    </div>
                    <div class='album_cubiertas'>";
                $fotos = mysqli_query($link,"SELECT * FROM fotos WHERE albums_idalbums = '" . $row['idalbums'] . "' ORDER BY idfotos LIMIT 3");
                if (mysqli_num_rows($fotos)) {
                    while ($row2 = mysqli_fetch_assoc($fotos)) {
                        echo "<a href='album.php?iduser=" . $_GET['iduser'] . "&idalbum=" . $row['idalbums'] . "'><img class='album_cubierta' alt='cubierta album' src='" . htmlspecialchars($row2['archivo']) . "' /></a>";
                    }
                } else {
                    echo "<span>No hay ninguna foto en este album</span>";
                }
                echo "</div></div>";
            }
        }
        ?>

        <!-- Formulario creacion de albumes -->
        <div style='display: inline-block;margin: 25px;'>
            Crea un album personalizado
            <hr>
            <div class="input">
                <span>
                    <input name="album" id="album_id" type="text" placeholder="Nombre del album">
                </span>
            </div>
            <button type='button' class="azul" onclick="album_crear()"><span><b>Crear album</b></span></button>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // Muestra y oculta los menús
            $('.album').hover(function(e) {
                $(this).find('.album_renombrar,.album_borrar').css("visibility", "visible");
            }, function(e) {
                $(this).find('.album_renombrar,.album_borrar').css("visibility", "hidden");
            });
        });

        function album_crear() {
            var name = $("input[name='album']").val();
            if (name != null && name != "") {
                ajax_post({
                    data: 'album=' + name,
                    reload: true
                });
            }
        }
        
        function album_renombrar(id, name) {
            var name = prompt("Escribe el nombre del album", name);
            if (name != null && name != "") {
                ajax_post({data:'album_renombrar=' + name + '&album_id=' + id,reload: true});
            }
        }
        function album_borrar(id, name) {
            var r = confirm("¿Estás seguro de borrar el album \"" + name + "\" ?");
            if (r == true && id != "") {
                ajax_post({data:'album_borrar=' + id,reload: true});
            }
        }
    </script>
</div>
<?php require ("inc/chat.php"); ?>
</body>
</html>
