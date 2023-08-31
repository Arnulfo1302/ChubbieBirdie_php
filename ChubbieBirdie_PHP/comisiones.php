<?php
include 'includes/funciones.php';
$auth = estaAutenticado();

$titulo = "Comisiones";
incluirTemplate('header', $titulo);
incluirTemplate('galeria', $titulo);
?>

</body>
</html>