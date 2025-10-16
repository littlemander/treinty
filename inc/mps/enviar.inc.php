<?php
// ========== LÓGICA DE ENVÍO (manejo AJAX/POST) ==========
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['mp_enviar'])) {
    $receptor_id = intval($_POST['receptor_id'] ?? 0);
    $mensaje = trim($_POST['mensaje_mp'] ?? '');

    $errores = [];
    if (!$receptor_id) $errores[] = "El destinatario es obligatorio.";
    if (strlen($mensaje) < 1) $errores[] = "El mensaje no puede estar vacío.";

    if ($errores) {
        http_response_code(400);
        echo implode('<br>', $errores);
        exit;
    }

    // Inserta el mensaje privado 
    mysqli_query(
        $link,
        "INSERT INTO mensajes_privados (de_id, para_id, mensaje, fecha)
         VALUES ('{$global_idusuarios}', '{$receptor_id}', '".mysqli_real_escape_string($link, $mensaje)."', NOW())"
    );

    echo "Mensaje enviado correctamente";
    exit;
}

// ========== OBTIENE LISTA DE AMIGOS PARA AUTOCOMPLETAR ==========
$amigos = [];
$result = mysqli_query(
    $link,
    "
    SELECT u.idusuarios, u.nombre, u.apellidos, f.archivo
    FROM amigos a
    JOIN usuarios u ON (a.user1=u.idusuarios OR a.user2=u.idusuarios)
    LEFT JOIN fotos f ON u.idfotos_princi=f.idfotos
    WHERE (a.user1='{$global_idusuarios}' OR a.user2='{$global_idusuarios}') AND u.idusuarios!='{$global_idusuarios}'
    "
);

if(mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $amigos[] = [
            'value' => $row['idusuarios'],
            'label' => $row['nombre']." ".$row['apellidos'],
            'icon'  => $row['archivo'] ?: 'assets/no_avatar.png'
        ];
    }
?>

<h2>Mensajería Privada: Redactar</h2>
<div id='mps_separador'></div>
<form id="mpForm" autocomplete="off">
    <div class="ui-widget">
        Destinatario:
        <img id="receptor_icon" src="" alt="" style="vertical-align:middle; width:22px; height:22px;">
        <div class="input">
            <span>
                <input placeholder="Nombre de un amigo"
                    id="receptor" name="receptor"
                    type="text" size='40'
                    required autocomplete="off">
            </span>
        </div>
        <input id="receptor_id" name="receptor_id" type="hidden" required>
        <br>
    </div>
    Mensaje:<br>
    <div class="input">
        <span>
            <textarea name="mensaje_mp" placeholder="Escribe tu mensaje aquí" required minlength="1"></textarea>
        </span>
    </div>
    <button type='submit' class="azul"><span><b>Enviar</b></span></button>
    <div id="form_error" style="color:red; display:none; margin-top:7px;"></div>
</form>

<script>
var amigos = <?php echo json_encode($amigos); ?>;
var receptor_seleccionado = false;

$(function() {
    $("#receptor").autocomplete({
        source: amigos,
        minLength: 0,
        select: function(event, ui) {
            receptor_seleccionado = true;
            $("#receptor").val(ui.item.label).addClass('input_ok').removeClass('input_error');
            $("#receptor_id").val(ui.item.value);
            $("#receptor_icon").attr("src", ui.item.icon);
            $("textarea[name='mensaje_mp']").focus();
            return false;
        }
    }).autocomplete("instance")._renderItem = function(ul, item) {
        return $("<li>")
            .append("<a><img src='" + item.icon + "' style='width:18px; height:18px; vertical-align:middle; margin-right:6px;'>" + "<span>" + item.label + "</span></a>")
            .appendTo(ul);
    };

    $("#receptor").focus(function () {
        $(this).autocomplete("search", "");
    });

    $("#receptor").blur(function () {
        if (!receptor_seleccionado || !$("#receptor_id").val()) {
            $("#receptor").val("").addClass('input_error').removeClass('input_ok');
            $("#receptor_id").val('');
            $("#receptor_icon").attr('src', '');
        }
    });
});

// Validación y envío AJAX
$('#mpForm').on('submit', function(e) {
    e.preventDefault();
    let receptorId = $('#receptor_id').val();
    let mensaje = $('textarea[name="mensaje_mp"]').val();
    
    if (!receptorId) {
        $('#form_error').text('Selecciona un destinatario válido.').show();
        $('#receptor').addClass('input_error').removeClass('input_ok');
        return false;
    }
    if (!mensaje || mensaje.length < 1) {
        $('#form_error').text('El mensaje no puede estar vacío.').show();
        return false;
    }
    
    $.ajax({
        url: 'mp.php?modo=enviar',
        method: 'POST',
        data: {
            mp_enviar: 1,
            receptor_id: receptorId,
            mensaje_mp: mensaje
        },
        success: function(response) {
            alert(response);
            $('#mpForm')[0].reset();
            $('#form_error').hide();
            $('#receptor_icon').attr('src','');
            receptor_seleccionado = false;
        },
        error: function(xhr) {
            $('#form_error').html(xhr.responseText).show();
        }
    });
});
</script>
<style>
.input_error { border: 2px solid #DB2E2E; }
.input_ok { border: 2px solid #2DC24F; }
</style>

<?php
} else {
    echo "<p>No tienes amigos agregados para enviar mensajes.</p>";
}
?>
