<?php 
include "Negocio/MascotaNegocio.php";
include "Negocio/UsuarioNegocio.php";
if (!isset($_SESSION)) {
  session_start();
}


if(isset($_SESSION['userId']) and $_SESSION['userRol'] == "cliente"){
  obtenerActivacion($_SESSION['userId']);

if(isset($_GET['SendEmail'])){
  $token = "us".rand(0,100000);
  updateToken($_SESSION['userCorreo'],$token);
  confirmarEmail($_SESSION['userCorreo'],  $token, $_SESSION['userNombre']);
}
}


$busqueda = "";
$estado ="disponible";
if(isset($_GET['estado']) and $_GET['estado'] == "adoptado"){
  $estado = "adoptado";
}

if (empty($_GET['buscar'])) {
  $busqueda = "";
} else {
  $busqueda = $_GET['buscar'];
  
}

if (!isset($_GET['numPag'])) {
  $_GET['numPag'] = 1;
}

$totalMascotas = getTotalMascotas($busqueda,$estado);
$maximo = 6;
$pagina = (int)$_GET['numPag'];

$mostrar = ceil($totalMascotas / $maximo);
$pags = $mostrar;
$mostrar =  ((int)$_GET['numPag'] - 1) * $maximo;


$mascotas = getMascotas($busqueda, $mostrar , $maximo, $estado);

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Clan Canino</title>
    <link rel="shortcut icon" href="images/icon.png" >
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link href="https://fonts.googleapis.com/css?family=Montserrat:200,300,400,500,600,700,800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
 
    <link rel="stylesheet" href="css/animate.css">
    
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">


    <link rel="stylesheet" href="css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="css/jquery.timepicker.css">

    <link rel="stylesheet" href="css/flaticon.css">
    <link rel="stylesheet" href="css/style.css">

    <!-- <link rel="stylesheet" href="css/search.css"> -->

  </head>
  <body>
  <?php include("includes/header.php"); ?>
    <!-- END nav -->
    <section class="hero-wrap hero-wrap-2" style="background-image: url('images/bg_2.jpg');" data-stellar-background-ratio="0.5">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text align-items-end">
          <div class="col-md-9 ftco-animate pb-5">
          	<p class="breadcrumbs mb-2"><span class="mr-2"><a href="index.php">Home <i class="ion-ios-arrow-forward"></i></a></span> </p>
            <h1 class="mb-0 bread"><?php if(isset($_SESSION['userNombre'])){ echo "Hola, ". $_SESSION['userNombre'];}else{echo "Inicio";} ?></h1>
          </div>
        </div>
      </div>
    </section>


	<div class="s010   bg-light py-4 text-center" id="mascotas_enc ">
		<form action="index.php" method="GET">
			<div class="inner-form  col-md-6 offset-md-3">
				<div class="basic-search ">
					<div class="input-field">
						<input id="search" type="text" placeholder="Buscar" name='buscar'>
						<input type="text" hidden name = "numPag" value="1">
            
						<div class="icon-wrap">
							<button type="submit" value="numPag"  class="transparency-glass" >
							<svg xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 24 24">
							<path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"></path>
							</svg>
						</div>
					</div>
				</div>
       
      
          </div>  
          <div class="radio-form">
       
       <input type="radio" id="adoptadas" name="estado" value="adoptado" class="radio-input" <?php if(isset($_GET['estado']) and $_GET['estado'] == "adoptado"){ echo 'checked'; } ?> onclick="linkear('index.php?estado=adoptado')">
       <label for="adoptadas" class="radio-input" onclick="linkear('index.php?estado=adoptado')">Adoptadas</label>
     
       <input type="radio" id="disponible" name="estado" value="disponible" class="radio-input radio-1" <?php if(isset($estado) and $estado == "disponible"){ echo 'checked'; } ?>  onclick="linkear('index.php?estado=disponible')">
       <label for="disponible" class="radio-input" onclick="linkear('index.php?estado=disponible')">Disponibles</label>
			</div>
		</form>
	</div>

    <section class="ftco-section bg-light">
      <div class="container">
      
            
          <?php   if(isset($_GET['status']) and $_GET['status'] == "saved" ) {?>
              <div class="alert alert-success" role="alert"> La información se ha guardado exitosamente </div>
              <?php }?>

              <?php   if(isset($_GET['mascotaAdd']) and $_GET['mascotaAdd'] == "true" ) {?>
              <div class="alert alert-success" role="alert"> La mascota se ha agregado exitosamente </div>
              <?php }?>


        <div class="row d-flex">
        <?php if(isset($_SESSION['userActiva']) and $_SESSION['userRol'] == "cliente" and $_SESSION['userActiva'] == 0 ) {?>
              <div class="alert alert-danger" role="alert"> Para poder adoptar debes de activar tu cuenta, se mandó un correo electronico a  <?php echo $_SESSION['userCorreo'] ?> ¿No recibiste un correo? <a href="index.php?SendEmail=1012">Clic aquí para volver a enviarlo </a></div>
            
            <?php } 

       
        
          foreach($mascotas as $mascota ){ ?>
          <div class="col-md-4 d-flex ftco-animate">
            <div class="blog-entry align-self-stretch">
              <a href="<?php echo "pet.php?idMascota=".$mascota->getId(); ?>"><img class="img-fluid "src="<?php echo $mascota->getFoto(); ?>" alt="This is a image from pet <?php echo $mascota->getNombre(); ?>">
              </a>
              <div class="text p-4">
              	<div class="meta mb-2">
                  <div><a href="pet.php?idMascota=<?php echo $mascota->getId() ?>"><?php echo $mascota->getFechaMascota(); ?></a></div>
                  <div><a ></a></div>
                  <div><a href="pet.php?idMascota=<?php echo $mascota->getId() ?>" class="meta-chat"><span <?php if($mascota->getEspecie() == "Gato" or $mascota->getEspecie() == "gato") {?>class="fas fa-cat" <?php }else{ ?>class="fas fa-paw"<?php } ?>></span> <?php if($mascota->getEdad() < 1){ echo "cachorro"; }else{ echo $mascota->getEdad()." año(s) "; } ?></a></div>
                </div>
                <h3 class="heading"><a href="<?php echo "pet.php?idMascota=".$mascota->getId(); ?>"><?php echo $mascota->getNombre()." ". $mascota->getHistoria(); ?></a></h3>
                <a href="pet.php?idMascota=<?php echo $mascota->getId() ?>">Ver más</a>
             
              </div>
            </div>
          </div>
          <?php
          } ?>
         
        </div>
                  <?php
                    include_once("includes/common_functions.php");
                    paginacion($pags, $pagina, $busqueda, "index.php?estado=".$estado."&");
                  ?>
      </div>
    </section>

    <?php include("includes/footer.php");
    
    ?>
    
  

  <!-- loader -->
  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>


  <script src="js/functions.js"></script>
  <script src="js/jquery.min.js"></script>
  <script src="js/jquery-migrate-3.0.1.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/jquery.easing.1.3.js"></script>
  <script src="js/jquery.waypoints.min.js"></script>
  <script src="js/jquery.stellar.min.js"></script>
  <script src="js/jquery.animateNumber.min.js"></script>
  <script src="js/bootstrap-datepicker.js"></script>
  <script src="js/jquery.timepicker.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.magnific-popup.min.js"></script>
  <script src="js/scrollax.min.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
  <script src="js/google-map.js"></script>
  <script src="js/main.js"></script>
 
  

    
  </body>
</html>