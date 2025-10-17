<?php
require_once ("inc/verify_login.php");
head("Inicio");

$perfil = "propio";
$sql = "SELECT *,
			FLOOR(DATEDIFF(CURDATE(),fnac)/365) AS edad,
			DATE_FORMAT(fecha_reg, '%d/%m/%Y') AS fecha_reg,
			TIME_TO_SEC(TIMEDIFF(now(),online)) AS segundos_off
		FROM `usuarios` LEFT JOIN fotos ON idfotos = idfotos_princi WHERE idusuarios='" . $global_idusuarios . "'";
$q_user = mysqli_query($link, $sql);
$r_user = mysqli_fetch_assoc($q_user);

require_once ("inc/estructura_inicio.php");
require_once ("inc/icons.php");
?>
<!-- VISTA DESKTOP -->
<div class="hidden md:block md:grid md:grid-cols-[240px_1fr_240px] gap-4">
	<div class="space-y-4">

		<!-- PERFIL -->
        <div class="treinty-sidebar p-4">
            <div class="flex items-center gap-3 mb-4">
                <img src="<?php echo $r_user['archivo']; ?>" alt="Profile" class="w-12 h-12 rounded object-cover">
                <div class="flex-1 min-w-0">
                    <a class="font-semibold text-sm hover:underline block truncate" href="perfil.php"><?php echo $global_nombrefull; ?></a>
                    <p class="text-xs text-gray-500">Ver mi perfil</p>
                </div>
            </div>
			<!-- NOTIFICACIONES VERDES -->
			<?php
				$sql = "SELECT * FROM notificaciones WHERE usuarios_idusuarios='{$global_idusuarios}' AND datos<>0";
				$q_notifi = mysqli_query($link, $sql);
				echo "<div class='space-y-2'>";
				if(mysqli_num_rows($q_notifi)>0){
					while($r_notifi = mysqli_fetch_assoc($q_notifi)){
						if($r_notifi['tipo'] == "peticion"){
							$plural = ($r_notifi['datos'] > 1) ? "peticiones" : "peticion";
							echo "<a class='flex items-center gap-2 text-xs text-green-600 font-medium hover:underline' href='ajustes.php?seccion=peticiones'>" . $peticion_icon . "<span>Tienes " . $r_notifi['datos'] . " " . $plural . " de amistad</span></a>";
						}elseif($r_notifi['tipo'] == "mp"){
							$plural = ($r_notifi['datos'] > 1) ? "mensajes privados" : "mensaje privado";
							echo "<a class='flex items-center gap-2 text-xs text-green-600 font-medium hover:underline' href='mp.php?modo=recibidos'>" . $mensaje_icon . "<span>Tienes " . $r_notifi['datos'] . " " . $plural . "</span></a>";
						}elseif($r_notifi['tipo'] == "tablon"){
							$plural = ($r_notifi['datos'] > 1) ? "comentarios" : "comentario";
							echo "<a class='flex items-center gap-2 text-xs text-green-600 font-medium hover:underline' href='perfil.php'>" . $comentario_icon . "<span>Tienes " . $r_notifi['datos'] . " " . $plural . " en tu tablon</span></a>";
						}
					}
				}else{
					echo "<p class='p-2 text-xs text-gray-500'>Sin notificaciones</p>";
				}
				echo "</div>";
			?>
        </div>

		<!-- CALENDARIO -->
        <div class="treinty-sidebar p-4">
            <div class="flex items-center justify-between mb-3">
                <h3 class="font-semibold text-sm flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-calendar w-4 h-4">
                        <path d="M8 2v4"></path>
                        <path d="M16 2v4"></path>
                        <rect width="18" height="18" x="3" y="4" rx="2"></rect>
                        <path d="M3 10h18"></path>
                    </svg>
                    Calendario
                </h3>
                
				<!--
				<a href="#">
                	<button class="text-xs text-blue-600 hover:underline">Crear evento</button>
				</a>
				-->
                
            </div>
            <div class="text-xs space-y-2">
				<p class="text-gray-500">Proximamente...</p>
				<!-- 
                <div>
                    <p class="font-medium">Hoy</p>
                    <p class="text-gray-500">no tienes ningún evento</p>
                </div>
                <div>
                    <p class="font-medium">Próximos</p>
                    <p class="text-gray-500">no tienes eventos próximamente</p>
                </div>
                <button class="text-blue-600 hover:underline">Ver todos</button>
				-->
            </div>
        </div>

	</div>


	<div class="space-y-4">
		<?php require_once ("inc/perfil/tablon.php"); ?>
		
											<div class="box">
												<div class="box-header">Novedades de tus amigos</div>
												<div class="box-content p-0">
													<div class="divide-y divide-gray-200">
													<?php require_once ("inc/novedades.inc.php"); ?>
													</div>
												</div>
											</div>
	
	</div>
<aside class="flex-shrink-0">
	<div class="space-y-0">
		
		<!-- CHAT -->
			<script language="JavaScript">
				$(window).ready(function() {
					chat_mode_home = true;
					$("#chat_boton").remove();
				});
			</script>
			<div id="chat" class="box">
				<div class="box-header flex items-center gap-2">
					<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-message-circle w-4 h-4">
						<path d="M7.9 20A9 9 0 1 0 4 16.1L2 22Z">
						</path>
					</svg>
					Chat ()
				</div>
				<div class="box-content p-0 max-h-64 overflow-y-auto">
					<div id="chat_contactos"></div>
				<div id='chat_conv_tmp' style='display:none;'></div>
				</div>
			</div>

		<!-- CHAT END -->

	</div>
</aside>



<?php require_once ("inc/chat.php"); ?>
<?php require_once ("inc/estructura_final.php"); ?>