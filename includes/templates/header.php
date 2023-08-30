<?php
include '../funciones.php';
$mensaje = $_GET['ID'] ?? null;
$auth = estaAutenticado();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ChubbyBirdie</title>
    <link rel="stylesheet" href="<?php echo BASE_URL.'build/css/app.css' ?>">
</head>

<body class="body body-portafolio bodyLock">
    <script src="<?php echo BASE_URL."build/js/bundle.min.js"?>"></script>
    <header class="header header-portafolio">
        <div class="izquierda centrar">
            <div class="portafolio centrar">
                <p class="blanco no_margin">Portafolio</p>
            </div>
        </div>
        <div class="centro centrar icono-portafolio">
            <a href="./index.php">
                <div class="icono centrar">
                    <div class="fondo-icono">
                        <picture class="centrar">
                            <source srcset="<?php echo BASE_URL.'build/img/chubby/chubbi-icon.webp' ?>" type="image/webp">
                            <source srcset="<?php echo BASE_URL.'build/img/chubby/chubbi-icon.png' ?>" type="image/png">
                            <img loading="lazy" srcset="<?php echo BASE_URL.'build/img/chubby/chubbi-icon.png' ?>" alt="Icono chubby">
                        </picture>
                    </div>
                </div>
            </a>
        </div>
        <div class="derecha centrar">
        <?php
                if($auth){
                    ?>
            <div class="btn-admin">
            <a href="<?php echo BASE_URL.'build/admin/content/contenido.php' ?>">
            <div class="contenido-btn centrar">
                <p class="blanco no_margin">Contenido</p>
            </div>
            </a>
            <div class="cerrarSesion centrar">
                <a href="<?php echo BASE_URL.'build/admin/content/cerrar-sesion.php'?>"><p class="blanco no_margin">Cerrar Sesión</p></a>
            </div>
            </div>
                    <?php
                }
            ?>
            <nav class="redes">
                <a href="#">
                    <div class="twitch centrar">
                        <img src="<?php echo BASE_URL.'build/img/iconos/twitch-svgrepo-com.svg'?>" alt="Icono Twitch">
                        <p class="blanco no_margin">Twitch</p>
                    </div>
                </a>
                <a href="#">
                    <div class="tiktok centrar">
                        <img src="<?php echo BASE_URL.'build/img/iconos/tiktok-outline-svgrepo-com.svg'?>" alt="Icono Tiktok">
                        <p class="blanco no_margin">TikTok</p>
                    </div>
                </a><a href="#">
                    <div class="instagram centrar">
                        <img src="<?php echo BASE_URL.'build/img/iconos/instagram.svg'?>" alt="Icono Instagram">
                        <p class="blanco no_margin">Instagram</p>
                    </div>
                </a>
                <a href="#">
                    <div class="twitter centrar">
                        <img src="<?php echo BASE_URL.'build/img/iconos/twitter-svgrepo-com.svg'?>" alt="Icono Twitter">
                        <p class="blanco no_margin">Twitter</p>
                    </div>
                </a>
            </nav>
        </div>
    </header>
    <div class="espacio-overlay centrar">
        <div class="overlayMenu">
            <a class="centrar" href="<?php echo BASE_URL.'arteOriginal.php'?>">
                <P class="no_margin centrar">Arte Original</P>
            </a>
            <a class="centrar" href="<?php echo BASE_URL.'comisiones.php'?>">
                <P class="no_margin centrar">Comisiones</P>
            </a>
            <a class="centrar" href="<?php echo BASE_URL.'fanArt.php'?>">
                <P class="no_margin centrar">Fan Art</P>
            </a>
        </div>
    </div>
    <section>
        <div class="titulo centrar">
            <div class="espacio-linea">
            <H2 class="no_margin"><?php echo $titulo; ?></H2>
                <div class="linea"></div>
            </div>
        </div>
    </section>