<?php
include '../../../includes/funciones.php';
include '../../../includes/templates/galeriaArray.php';
$mensaje = $_GET['mensaje'] ?? null;
$archivoJson = "../../../includes/arrays/".$mensaje.".json";
$jsonString = file_get_contents($archivoJson);
$elementos = json_decode($jsonString, true);
$auth = estaAutenticado();
if(!$auth) {
    header('Location: /');
}
$titulo = "Lista";
incluirTemplate('header', $titulo);

$id = $_GET['id'] ?? null;
$subTitulo = $id;
for($i = 1; $i <= sizeof($elementos); $i++){
    if($id == $elementos[$i-1]['id']){
    $subTitulo = "si hay";
    $nombre = $elementos[$i-1]['nombre'];
    $anho = $elementos[$i-1]['anho'];
    $descripcion = $elementos[$i-1]['descripcion'];
    $url = $elementos[$i-1]['url'];
    $grupo = $elementos[$i-1]['grupo'];
    $orden = $elementos[$i-1]['orden'];
    }
    };
if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $nombre = $_POST['nombre'];
    $año = filter_var($_POST['año'],FILTER_SANITIZE_NUMBER_INT);
    $año = filter_var($año,FILTER_VALIDATE_INT);
    $descripcion = $_POST['descripcion'];
    $orden = filter_var($_POST['orden'],FILTER_SANITIZE_NUMBER_INT);
    $orden = filter_var($orden,FILTER_VALIDATE_INT);
    $id = $id;
    $imagen = $_FILES['imagen'] ?? null;

    if(!$nombre){
        $errores[] = "El nombre es obligatorio";
    }
    if(!$año){
        $errores[] = "El año es obligatorio";
    }
    if(!$descripcion){
        $errores[] = "La descripcion es obligatorio";
    }
    if(!$orden){
        $orden = sizeof($elementos)+1;
    }
    /*if (!$imagen['name'] || !str_contains($imagen['image'],  'image')) {
        $errores[] = 'Imagen no válida';
    }*/
    if(empty($errores)){
        $carpetaImagenes = 'build/img/';
        $rutaImagen = '';
        if($imagen){
            unlink($url);
            rmdir(dirname($url));
            $imagePath = $carpetaImagenes . $mensaje.'/'.  md5(uniqid(rand(), true)).'/' . $imagen['name'];
            mkdir(dirname($imagePath));
            move_uploaded_file($imagen['tmp_name'], $imagePath);
            $rutaImagen = str_replace($carpetaImagenes, '', $imagePath);
            $url = $imagePath;
        }
        for($i = 1; $i <= sizeof($elementos); $i++){
            if($id == $elementos[$i-1]['id']){
            $elementos[$i-1]['nombre'] = $nombre ;
            $elementos[$i-1]['anho'] = $anho;
            $elementos[$i-1]['descripcion'] = $descripcion;
            $elementos[$i-1]['url'] = $url;
            $elementos[$i-1]['grupo'] = $grupo ;
            $elementos[$i-1]['orden'] = $orden;
            }
            };
        $jsonArray = json_encode($elementos, JSON_PRETTY_PRINT);
        $archivoTxt = $mensaje.".json";
        $archivo = fopen($archivoTxt, 'w');
        if ($archivo) {
            fwrite($archivo, $jsonArray);
            fclose($archivo);
        } else {
            echo "Error al abrir el archivo.";
        }
        
    }else {
        var_dump($errores);
    }
}

?>
<h2><?php echo $subTitulo?></h2>
<form class="formulario centrar" method="POST" enctype="multipart/form-data">
        <label for="nombre">Nombre</label>
        <input name="nombre" type="text" id="nombre" placeholder="Nombre" value="<?php echo $nombre ?>">

        <label for="año">Año</label>
        <input name="año" type="text" id="año" placeholder="Año" value="<?php echo $anho ?>">

        <label for="descripcion">Descripción</label>
        <textarea name="descripcion" id="descripcion"><?php echo $descripcion; ?></textarea>

        <label for="orden">Orden</label>
        <input name="orden" type="text" id="orden" placeholder="Orden" value="<?php echo $orden ?>">

        <label for="imagen">Imagen</label>
        <input name="imagen" type="file" id="imagen">
        <br>
        <input type="submit" value="Actualizar" class="btn_actualizar">
</form>
<div class="centrar">
<br>
<a class="btn-volver" href="listas.php?mensaje=<?php echo $mensaje ?>">Volver</a>
</div>