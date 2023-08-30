<?php
include '../../../includes/funciones.php';
$auth = estaAutenticado();
if(!$auth) {
    header('Location: /');
}
$titulo = "Contenido";
incluirTemplate('header', $titulo);
?>
<section id="seccion-contenido" class="seccion-contenido centrar">
    <div class="centrar">
        <p>Arte Original</p>
        <button class="btn-actualizar"   type="button" value="arteOriginal">Actualizar</button>
    </div>
    <div class="centrar">
        <p>Comisiones</p>
        <button class="btn-actualizar"  type="button" value="comisiones">Actualizar</button>
    </div>
    <div class="centrar">
        <p>Fan Art</p>
        <button class="btn-actualizar"  type="button" value="fanArt">Actualizar</button>
    </div>
</section>