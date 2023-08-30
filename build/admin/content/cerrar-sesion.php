<?php
include 'includes/funciones.php';
$auth = estaAutenticado();
if(!$auth) {
    header('Location: /');
}
$_SESSION = [];
header('Location: /');