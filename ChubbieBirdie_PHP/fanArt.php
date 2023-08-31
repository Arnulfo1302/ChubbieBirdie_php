<?php
include 'includes/funciones.php';
$auth = estaAutenticado();
$titulo = "Fan Art";
incluirTemplate('header', $titulo);
incluirTemplate('galeria', $titulo);
?>

</body>
</html>