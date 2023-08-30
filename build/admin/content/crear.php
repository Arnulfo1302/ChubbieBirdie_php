<?php
include 'includes/funciones.php';
include 'includes/templates/galeriaArray.php';
$auth = estaAutenticado();
if(!$auth) {
    header('Location: /');
}
$mensaje = $_GET['mensaje'] ?? null;
$archivoJson = $mensaje.".json";
$jsonString = file_get_contents($archivoJson);
$elementos = json_decode($jsonString, true);
$titulo = "Lista";
$errores = [];
incluirTemplate('header', $titulo);
$subTitulo = $mensaje;
if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $nombre = $_POST['nombre'];
    $año = filter_var($_POST['año'],FILTER_SANITIZE_NUMBER_INT);
    $año = filter_var($año,FILTER_VALIDATE_INT);
    $descripcion = $_POST['descripcion'];
    /*$orden = filter_var($_POST['orden'],FILTER_SANITIZE_NUMBER_INT);
    $orden = filter_var($orden,FILTER_VALIDATE_INT);*/
    $orden = sizeof($elementos);
    $id = sizeof($elementos);
    if($id == null){
        $id = 0;
    }
    $imagen = $_FILES['imagen'] ?? null;

    if(!$nombre){
        $errores[] = "El nombre es obligatorio";
    }
    if(!$año || !is_numeric($año)){
        $errores[] = "El año es obligatorio";
    }
    if(!$descripcion){
        $errores[] = "La descripcion es obligatorio";
    }
    if(!$orden){
        $orden = sizeof($elementos)+1;
    }
    if ($imagen['type'] != "image/webp") {
        $errores[] = 'Imagen no válida';
    }
    if(empty($errores)){
        $carpetaImagenes = 'build/img/';
        $rutaImagen = '';
        if($imagen){
            
            $imagePath = $carpetaImagenes . $mensaje.'/'.  md5(uniqid(rand(), true)).'/' . $imagen['name'];
            

            mkdir(dirname($imagePath));


            move_uploaded_file($imagen['tmp_name'], $imagePath);

            $rutaImagen = str_replace($carpetaImagenes, '', $imagePath);
            $url = $imagePath;
        }
        $elementos[] = new Elemento($id,$nombre, $año, $descripcion, $url, $mensaje, $orden);
        $jsonArray = json_encode($elementos, JSON_PRETTY_PRINT);
        $archivoTxt = "./includes/arrays/".$mensaje.".json";
        $archivo = fopen($archivoTxt, 'w');
        if ($archivo) {
            fwrite($archivo, $jsonArray);
            fclose($archivo);
        } else {
            echo "Error al abrir el archivo.";
        }
        
    }else {
       // var_dump($errores);
    }
}
?>
<h2><?php echo $subTitulo?></h2>
<?php foreach ($errores as $error) : ?>
        <div class="alerta error centrar">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>
<form class="formulario centrar" method="POST" enctype="multipart/form-data">
        <label for="nombre">Nombre</label>
        <input name="nombre" type="text" id="nombre" placeholder="Nombre" >

        <label for="año">Año</label>
        <input name="año" type="text" id="año" placeholder="Año" >

        <label for="descripcion">Descripción</label>
        <textarea name="descripcion" id="descripcion"></textarea>

        <!--<label for="orden">Orden</label>
        <input name="orden" type="text" id="orden" placeholder="Orden">-->

        <label for="imagen">Imagen</label>
        <input name="imagen" type="file" id="imagen">
        <br>
        <input type="submit" value="Crear" class="btn_actualizar">
</form>
<div class="centrar">
<br>
<a class="btn-volver" href="/listas.php?mensaje=<?php echo $mensaje ?>">Volver</a>
</div>
