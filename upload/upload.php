<?php


header("Content-Type: application/json; charset=utf-8"); // Respuesta JSON (por tu output final)
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header("Expires: 0");


session_start();
$ruta="../";
require('../inc/config.php');
$login = mysqli_query($link, "SELECT * FROM usuarios WHERE idsesion='" . $_SESSION['idsesion'] . "'");
$usuario = mysqli_fetch_assoc($login);
$global_idusuarios = $usuario['idusuarios'];
$global_nombrefull = $usuario['nombre'] . " " . $usuario['apellidos'];

$targetDir = "../user_fotos/";

$cleanupTargetDir = true;
$maxFileAge = 5 * 3600;
set_time_limit(5 * 60);

$chunk = isset($_REQUEST["chunk"]) ? intval($_REQUEST["chunk"]) : 0;
$chunks = isset($_REQUEST["chunks"]) ? intval($_REQUEST["chunks"]) : 0;
$fileName = isset($_REQUEST["name"]) ? $_REQUEST["name"] : '';
$fileName = preg_replace('/[^\w\._]+/', '_', $fileName);

if ($chunks < 2 && file_exists($targetDir . DIRECTORY_SEPARATOR . $fileName)) {
	$ext = strrpos($fileName, '.');
	$fileName_a = substr($fileName, 0, $ext);
	$fileName_b = substr($fileName, $ext);
	$count = 1;
	while (file_exists($targetDir . DIRECTORY_SEPARATOR . $fileName_a . '_' . $count . $fileName_b))
		$count++;
	$fileName = $fileName_a . '_' . $count . $fileName_b;
}

$filePath = $targetDir . DIRECTORY_SEPARATOR . $fileName;

if (!file_exists($targetDir)){
	if(!mkdir($targetDir, 0777, true)){
		die('Fallo al crear carpetas...');
	}
}

if ($cleanupTargetDir && is_dir($targetDir) && ($dir = opendir($targetDir))) {
	while (($file = readdir($dir)) !== false) {
		$tmpfilePath = $targetDir . DIRECTORY_SEPARATOR . $file;
		if (preg_match('/\.part$/', $file) && (filemtime($tmpfilePath) < time() - $maxFileAge) && ($tmpfilePath != "{$filePath}.part")) {
			@unlink($tmpfilePath);
		}
	}
	closedir($dir);
} else {
	die('{"jsonrpc" : "2.0", "error" : {"code": 100, "message": "Failed to open temp directory."}, "id" : "id"}');
}

if (isset($_SERVER["HTTP_CONTENT_TYPE"])) $contentType = $_SERVER["HTTP_CONTENT_TYPE"];
if (isset($_SERVER["CONTENT_TYPE"])) $contentType = $_SERVER["CONTENT_TYPE"];

if (strpos($contentType, "multipart") !== false) {
	if (isset($_FILES['file']['tmp_name']) && is_uploaded_file($_FILES['file']['tmp_name'])) {
		$out = fopen("{$filePath}.part", $chunk == 0 ? "wb" : "ab");
		if ($out) {
			$in = fopen($_FILES['file']['tmp_name'], "rb");
			if ($in) {
				while ($buff = fread($in, 4096))
					fwrite($out, $buff);
			} else die('{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream."}, "id" : "id"}');
			fclose($in);
			fclose($out);
			@unlink($_FILES['file']['tmp_name']);
		} else die('{"jsonrpc" : "2.0", "error" : {"code": 102, "message": "Failed to open output stream."}, "id" : "id"}');
	} else die('{"jsonrpc" : "2.0", "error" : {"code": 103, "message": "Failed to move uploaded file."}, "id" : "id"}');
} else {
	$out = fopen("{$filePath}.part", $chunk == 0 ? "wb" : "ab");
	if ($out) {
		$in = fopen("php://input", "rb");
		if ($in) {
			while ($buff = fread($in, 4096))
				fwrite($out, $buff);
		} else die('{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream."}, "id" : "id"}');
		fclose($in);
		fclose($out);
	} else die('{"jsonrpc" : "2.0", "error" : {"code": 102, "message": "Failed to open output stream."}, "id" : "id"}');
}

// Cuando la subida se termina
if (!$chunks || $chunk == $chunks - 1) {
	$finalPath = $filePath;
	$srcFile = "{$filePath}.part";

	// Renombrar el archivo subido
	rename($srcFile, $finalPath);

	// PROCESAMIENTO DE IMAGEN: recortar cuadrado centro y comprimir JPEG
	$size = getimagesize($finalPath);
	if ($size) {
		list($w, $h) = $size;
		$tipo = $size[2];
		$cuadrado = min($w, $h);
		$origenX = intval(($w - $cuadrado) / 2);
		$origenY = intval(($h - $cuadrado) / 2);

		// Crear imagen fuente según tipo
		switch($tipo) {
			case IMAGETYPE_JPEG: $img = imagecreatefromjpeg($finalPath); break;
			case IMAGETYPE_PNG:  $img = imagecreatefrompng($finalPath); break;
			case IMAGETYPE_GIF:  $img = imagecreatefromgif($finalPath); break;
			default: $img = false; break;
		}

		if ($img) {
			// Recorte cuadrado centrado
			$outImg = imagecreatetruecolor($cuadrado, $cuadrado);
			if ($tipo == IMAGETYPE_PNG || $tipo == IMAGETYPE_GIF) {
				imagealphablending($outImg, false);
				imagesavealpha($outImg, true);
				$transp = imagecolorallocatealpha($outImg, 255, 255, 255, 127);
				imagefilledrectangle($outImg, 0, 0, $cuadrado, $cuadrado, $transp);
			}
			imagecopy($outImg, $img, 0, 0, $origenX, $origenY, $cuadrado, $cuadrado);

			// Guardar comprimido JPEG con calidad (80)
			$tmpFinal = $finalPath . "_cuadrado.jpg";
			imagejpeg($outImg, $tmpFinal, 80);

			// Eliminar el original y renombrar
			imagedestroy($img);
			imagedestroy($outImg);
			@unlink($finalPath);
			rename($tmpFinal, $finalPath);
		}
	}
}

// Respuesta JSON
die('{"jsonrpc" : "2.0", "result" : null, "id" : "id"}');
?>
