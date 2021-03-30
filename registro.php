
<?php
  // Inicializamos la sesion o la retomamos
if(!isset($_SESSION)) {
    header('Cache-Control: no cache'); //no cache
    session_cache_limiter('private_no_expire');
    session_start();
    // Protegemos el documento para que solamente sea visible cuando NO HAS INICIADO sesión
   // if(isset($_SESSION['userId'])) header('Location: index.php');
   // if(!isset($_SESSION['userId'])) header('Location: formulario.php');
}



if (isset($_POST['register_sent'])){
    foreach ($_POST as $inputs => $vars) {
if(trim($vars) == "") $error[] = "La caja $inputs es obligatoria";
}
include 'Negocio/UsuarioNegocio.php';
$permitido = false;
if (!isset($error)) {
    $permitido = addUsuario($_POST['nombre'], $_POST['email'], $_POST['contrasena'], $_POST['contrasena2'] );
    }

    if(!$permitido){
        $error[] = "Ha ocurrido un error al registrarse";            
    }

    
    if (!isset($error)) {
        header('Location:login.php');
        }else{

        }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

    <form class="center" action="registro.php" method="post">
        <h1>Registro de usuario</h1>
            <div class="txt_field">
                <label>Nombre</label><br>
                <input type="text" name="nombre" placeholder="Nombre">
            
            </div>
            
            <div class="txt_field">
                <label>Correo electronico</label><br>
                <input type="text" name="email" placeholder="Correo electronico">
            </div>
            
            
            <div class="txt_field">
                <label>Contraseña</label><br>
                <input type="password" name="contrasena" placeholder="Contraseña">
            </div>

            <div class="txt_field">
                <label>Repita su contraseña</label><br>
                <input type="password" name="contrasena2" placeholder="Contraseña">
            </div>

            <div class="ssingup">
            <input type="submit"  value="Registrarse" name="register_sent">
            </div>
    </form>
    
</body>
</html>