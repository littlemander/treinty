<?php
require_once ("inc/verify_login.php");
head("Inicio");
require_once ("inc/estructura_inicio.php");
require_once ("inc/icons.php");
?>

<aside class="flex-shrink-0">
	<div class="space-y-0">

		<div class="box p-0">
			<div class="p-2 flex items-center gap-2">
				<div class="w-12 h-12 bg-gray-200 border border-gray-300 flex items-center justify-center">
					<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-user w-8 h-8 text-gray-500">
						<path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2">
						</path>
						<circle cx="12" cy="7" r="4">
						</circle>
					</svg>
				</div>
				<div>
					<a class="font-bold text-blue-700 hover:underline" href="perfil.php">username</a>
					<p class="text-xs text-gray-600 flex items-center gap-1">0 visitas a tu perfil</p>
				</div>
				<hr>
			</div>
		<!-- NOTIFICACIONES -->
		<?php
			$sql = "SELECT * FROM notificaciones WHERE usuarios_idusuarios='{$global_idusuarios}' AND datos<>0";
			$q_notifi = mysqli_query($link, $sql);
			echo "<div class='box-content space-y-2'>";
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
				echo "</div></div>";
			}else{
				echo "<p class='p-2 text-xs text-gray-500'>Sin notificaciones</p>";
			}
		?>

		<!-- NOTIFICACIONES END -->
	</div>
</aside>

<main>
	<div class="space-y-0">

			<div class="box mb-4">
												<form>
													<div class="p-2">
														<input type="text" placeholder="Actualiza tu estado" class="w-full border border-gray-400 text-xs p-1 focus:outline-none focus:border-blue-500" value="">
													</div>
													<div class="bg-[#F7F7F7] p-2 border-t border-gray-200 flex justify-between items-center">
														<div class="text-xs text-gray-600">
															<span>No tienes un estado actual.</span>
														</div>
														<button class="secondary-button">Actualizar</button>
													</div>
												</form>
											</div>
											<div class="box">
												<div class="box-header">Novedades de tus amigos</div>
												<div class="box-content p-0">
													<div class="divide-y divide-gray-200">
													<?php require_once ("inc/novedades.inc.php"); ?>
													</div>
												</div>
											</div>
	
	</div>
</main>
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