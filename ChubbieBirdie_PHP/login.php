<?php
include './includes/funciones.php';
require './build/admin/content/content.php';
$errores = [];
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = $_POST['text'];
    $password = $_POST['password'];
    if(!$user){
        array_push($errores, "El usuario no puede estar vacío");
    }
    if(!$password){
        array_push($errores,"La contraseña no puede estar vacía");
    }

    if(empty($errores)){
        $query = $users[0];

        if($query == $user){

            if($users[1] == $password){
                $auth = true;
                session_start();
                $_SESSION['login'] = true;
                header('location: ./build/admin/content/contenido.php');
            }
        }else {
            array_push($errores,"Usuario y/o contraseña incorrecta");
        }
    }


}
$titulo = "Login";
incluirTemplate('header', $titulo);
?>
<?php foreach ($errores as $error) : ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>
<section class="centrar form-login">
    <form class="login centrar" method="POST">
        <input type="text" name="text" placeholder="User">
        <input type="password" name="password" placeholder="Password">
        <input type="submit" class="boton" value="Log-In">
    </form>
</section>