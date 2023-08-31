<?php
include 'app.php';
function incluirTemplate(string $nombre, string $titulo)
{
    include TEMPLATES_URL . "/".$nombre.".php";
}
function estaAutenticado() : bool {
    session_start();
    if($_SESSION['login']) {
        return true;
    } 
    return false;
}