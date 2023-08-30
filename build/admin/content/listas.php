<?php
include '../../../includes/funciones.php';
include '../../../includes/templates/galeriaArray.php';
$mensaje = $_GET['mensaje'] ?? null;
$archivoJson = "../../../includes/arrays/".$mensaje.".json";
$jsonString = file_get_contents($archivoJson);
$elementos = json_decode($jsonString, true);
$id = $_GET['eliminar'] ?? null;
if($id != null){
    foreach ($elementos as $indice => $objeto) {
        if ($objeto['id'] == $id) {
            unset($elementos[$indice]);
            break; // Terminamos el bucle una vez que encontramos el objeto a eliminar
        }
    }
    // Reindexamos el array para eliminar los elementos vacíos dejados por unset
    $elementos = array_values($elementos);
    $jsonArray = json_encode($elementos, JSON_PRETTY_PRINT);
    $archivoTxt = $mensaje.".json";
    $archivo = fopen($archivoTxt, 'w');
    if ($archivo) {
        fwrite($archivo, $jsonArray);
        fclose($archivo);
    } else {
        echo "Error al abrir el archivo.";
    }
};
$auth = estaAutenticado();
if(!$auth) {
    header('Location: /');
}
$titulo = "Lista";
incluirTemplate('header', $titulo);
$subTitulo = $mensaje;
?>
<section class="creacion centrar">
<h2><?php echo $subTitulo?></h2>
<div class="crear">
<a href="crear.php?mensaje=<?php echo $mensaje; ?>" class="btn_actualizar">Crear Nuevo</a>
</div>
</section>
<section class="lista centrar">
<?php if(empty($elementos)){
    echo "La lista esta vacia";
}else {
    foreach ($elementos as $elemento) {
        if($elemento['grupo'] == $mensaje){
        ?>
        <div class="segmento centrar">
        <?php
        ?><p><?php echo "ID: " . $elemento['id'] ;?></p><?php
        ?><p><?php echo "Nombre: " . $elemento['nombre'] ;?></p><?php
        ?><p><?php echo "Año: " . $elemento['anho'] ;?></p><?php
        ?><p><?php echo "Descripción: " . $elemento['descripcion'] ;?></p><?php
        ?><p><?php echo "Orden: " . $elemento['orden'] ;?></p><?php
        ?><p><?php echo "<img src='../../../".$elemento['url']."'>"; ;?></p><?php
        ?><a href="actualizar.php?id=<?php echo $elemento['id']; ?>&mensaje=<?php echo $mensaje?>" class="btn_actualizar">Actualizar</a>
        <a href="listas.php?eliminar=<?php echo $elemento['id']; ?>&mensaje=<?php echo $mensaje?>" class="eliminar">Eliminar</a>
        </div>
        <?php
        }
    }
}
?>
</section>
<div class="centrar">
<a class="btn-volver" href="contenido.php">Volver</a>
</div>

