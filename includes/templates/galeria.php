<?php
include '../funciones.php';
include 'galeriaArray.php';
$titulo;
$mensaje = $_GET['ID'] ?? null;
if($titulo == "Arte Original"){
    $pag = "arteOriginal";
    $archivoJson = "./includes/arrays/arteOriginal.json";
}else if($titulo == "Comisiones"){
    $pag = "comisiones";
    $archivoJson = "./includes/arrays/comisiones.json";
}else if ($titulo == "Fan Art"){
    $pag = "fanArt";
    $archivoJson = "./includes/arrays/fanArt.json";
}
$jsonString = file_get_contents($archivoJson);
$elementos = json_decode($jsonString, true);
$tituloN = $stringSinEspacio = str_replace(" ", "", $titulo);
function compararPorId($a, $b) {
    return $a->id - $b->id;
}
usort($elementos, 'compararPorId');
$ArrayFiltrado = array();
$ArrayFiltrado = $elementos;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $filtro = $_POST['submit_button'];
    if($filtro != 'Todos'){
        $ArrayFiltrado = [];
        foreach ($elementos as $elemento) {
            if ($elemento['anho'] == $filtro) {
                $ArrayFiltrado[] = $elemento;
            }
        }
    }
}
?>
<form method="POST"  class="formulario-filtros">
    <div class="filtros">
        <input type="hidden" name="mi_variable" id="mi_variable">
        <button type="submit" name="submit_button" value="Todos" class="<?php if ($filtro == 'Todos'){ echo 'negrita'; } ?> "><p>Todos</p></button>
        <p>/</p>
        <button type="submit" name="submit_button" value="2023" class="<?php if ($filtro == '2023'){ echo 'negrita'; } ?> "><p>2023</p></button>
        <p>/</p>
        <button type="submit" name="submit_button" value="2022" class="<?php if ($filtro == '2022'){ echo 'negrita'; } ?> "><p>2022</p></button>
        <p>/</p>
        <button type="submit" name="submit_button" value="2021" class="<?php if ($filtro == '2021'){ echo 'negrita'; } ?> "><p>2021</p></button>
        <p>/</p>
        <button type="submit" name="submit_button" value="2020" class="<?php if ($filtro == '2020'){ echo 'negrita'; } ?> "><p>2020</p></button>
    </div>
    </form>
<div class="conetenedor-galerias">
    <?php
    $totalFotos = sizeof($ArrayFiltrado);
    $columnas = 3;
    $conteoColumnas = 0;
    $fotosPorColumna = round($totalFotos / $columnas); // Cantidad de fotos por columna
    $aux =0;
    $sobrante = 1;
        ?> 
            <div class="imagenGrande" onclick="overlayImagenFull('none')">
            <div class="imagenGrende-contenedor">
                <img src="" class="imagen-overlay">
            </div>
            </div>
        <?php
    if($totalFotos != 0 || $totalFotos != null)
        {for ($i = 0; $i < $totalFotos; $i++) {
            $columna = $i % $columnas;
            if ($aux == 0 ) {
                if($i+$sobrante != $totalFotos){
                    echo '<div class="galeria-columna">';
                }
            }
        ?>
            <!--<a href="?ID=<?php echo $i+1?>">-->
            <div class="contenedor-imagenI" onclick="overlayImagenFull('<?php echo $ArrayFiltrado[$i]['url']; ?>')">
                <div class="hover-info">
                   <p>Año:<span><?php echo $ArrayFiltrado[$i]['anho']; ?></span></p> 
                </div>
                <img src="<?php echo $ArrayFiltrado[$i]['url']; ?>">
                <?php $aux++; ?>
            </div>
            <!--</a>-->
        <?php
            if ((($aux) % $fotosPorColumna == 0 & $conteoColumnas+$sobrante != $columnas) || $i == $totalFotos - 1) {
                echo '</div>';
                $aux =0;
                $conteoColumnas++;
            }
        }}else {
            echo "<h4 style='text-align: center'>No hay Fotografías para mostrar.</h4>";
        }
    ?>
</div>