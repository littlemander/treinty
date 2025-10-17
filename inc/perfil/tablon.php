<?php
function tiempo_relativo($fecha) {
    if (!$fecha) return 'hace mucho tiempo';

    $ahora = time();
    $unix = strtotime($fecha);
    $dif = $ahora - $unix;

    if ($dif < 60) {
        return 'hace menos de un minuto';
    } elseif ($dif < 120) {
        return 'hace 1 minuto';
    } elseif ($dif < 3600) {
        $min = floor($dif / 60);
        return "hace {$min} minutos";
    } elseif ($dif < 7200) {
        return 'hace 1 hora';
    } elseif ($dif < 86400) {
        $horas = floor($dif / 3600);
        return "hace {$horas} horas";
    } elseif ($dif < 172800) {
        return 'hace 1 día';
    } elseif ($dif < 604800) {
        $dias = floor($dif / 86400);
        return "hace {$dias} días";
    } elseif ($dif < 2592000) {
        $semanas = floor($dif / 604800);
        return $semanas > 1 ? "hace {$semanas} semanas" : "hace 1 semana";
    } else {
        return 'hace más de un mes';
    }
}
?>

<div class="treinty-sidebar p-3 md:p-4">
    <div class="flex items-start gap-2 md:gap-3">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-message-square w-4 md:w-5 h-4 md:h-5 text-orange-500 mt-1 flex-shrink-0">
            <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
        </svg>
        <div class="flex-1 min-w-0">
        <?php
            if (!empty($r_user['estado'])) {
                $estado = $r_user['estado'];
            } else {
                $estado = "Actualiza tu estado";
            }

            // Si es tu perfil, muestra textarea y botón
            if($perfil == "propio"){
        ?>
            <textarea 
                class="flex w-full rounded-md border bg-background px-3 py-2 ring-offset-background placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 min-h-[60px] text-sm resize-none border-gray-300 mb-2" 
                id="estado" 
                name="estado" 
                maxlength="40" 
                placeholder="¿Qué estás haciendo?" 
            ></textarea>
            <p class="text-xs text-gray-500 mb-2 truncate">
                <strong><?php echo htmlspecialchars($estado); ?></strong>
                <span class="ml-2 text-gray-400">
                    <?php
                    echo tiempo_relativo($r_user['fecha_estado']);
                    ?>
                </span>
            </p>
            <button 
                class="treinty-button text-xs w-full md:w-auto" 
                id="publicar_estado" 
                type="button"
                disabled
            >Publicar</button>
            
            <script>
                let estado_ori = <?php echo json_encode($estado); ?>;
                $(document).ready(function() {
                    $('#estado').on('input', function() {
                        let estVal = $(this).val();
                        $('#publicar_estado').prop('disabled', (estVal.trim() == estado_ori.trim() || estVal.trim() == ''));
                    });

                    $('#publicar_estado').on('click', function() {
                        let nuevoEstado = $('#estado').val().trim();
                        if (nuevoEstado != estado_ori.trim() && nuevoEstado != '') {
                            ajax_post({
                                data : "estado_cambiar=1&estado=" + encodeURIComponent(nuevoEstado),
                                reload : true
                            });
                        }
                    });
                });
            </script>
        <?php
            } else {
                // Si es otro perfil, cita el estado y tiempo
                echo '<div class="blockquote">
                        <div>“</div>
                        <span>'.htmlspecialchars($estado).'</span>
                        <div>”</div>
                        <div class="text-xs text-gray-400 mt-1">'.tiempo_relativo($r_user['estado_fecha']).'</div>
                    </div>';
            }
        ?>
        </div>
    </div>
</div>
