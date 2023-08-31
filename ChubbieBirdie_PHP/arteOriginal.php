<?php
include 'includes/funciones.php';
$auth = estaAutenticado();
$titulo = "Arte Original";
incluirTemplate('header', $titulo);
incluirTemplate('galeria', $titulo);
?>
</body>
</html>