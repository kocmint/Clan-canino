<?php if (!isset($_SESSION)) {
  session_start(); 
}
include "Negocio/UsuarioNegocio.php";

if(isset($_GET['idMascota'])){
	include "Negocio/MascotaNegocio.php";
  include "Negocio/TramiteNegocio.php";
	$mascota = getMascota($_GET['idMascota']);



if(isset($_SESSION['userId']) and $_SESSION['userRol'] == "cliente"){
  obtenerActivacion($_SESSION['userId']);

if(isset($_GET['SendEmail'])){
  confirmarEmail($_SESSION['userCorreo'],  $_SESSION['userToken'], $_SESSION['userNombre']);
}

  $tramiteActivo = getTramiteMasc($_GET['idMascota'], $_SESSION['userId']);
	
  
}
  if (!$mascota){
	header('Location:index.php');

  }

}else{
	header('Location:index.php');
}


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
  </head>
  <body>

    
		<?php include("includes/header.php"); ?>
    <!-- END nav -->
    <section class="hero-wrap hero-wrap-2" style="background-image: url('images/bg_2.jpg');" data-stellar-background-ratio="0.5">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text align-items-end">
          <div class="col-md-9 ftco-animate pb-5">
          	<p class="breadcrumbs mb-2"><span class="mr-2"><a href="index.php">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Mascota <i class="ion-ios-arrow-forward"></i></span></p>
            <h1 class="mb-0 bread">Mascota</h1>
          </div>
        </div>
      </div>
    </section>

    <section class="ftco-section pt-5 pb-5">
    	<div class="container">
    		<div class="row d-flex no-gutters">
    			<div class="col-md-5 d-flex">
    				<div class="img img-video d-flex align-self-stretch align-items-center justify-content-center justify-content-md-center mb-4 mb-sm-0" style="background-image:url(<?php echo $mascota->getFoto(); ?>);">
    				</div>
    			</div>
    			<div class="col-md-7 pl-md-5 py-md-5">
    				<div class="heading-section pt-md-5">
            <?php  if(!isset($_SESSION['userNombre'])){ ?>
            <a href="login.php">
              <div class="alert alert-primary " role="alert"> ¡Inicia sesión para conocerme!  </div>
            </a>
            <?php } ?>
            <?php if(isset($_SESSION['userActiva']) and $_SESSION['userRol'] == "cliente" and $_SESSION['userActiva'] == 0 ) {?>
              <div class="alert alert-danger" role="alert"> Para poder adoptar debes de activar tu cuenta, se mandó un correo electronico a  <?php echo $_SESSION['userCorreo'] ?> ¿No recibiste un correo? <a href="pet.php?idMascota=<?php echo $mascota->getId(); ?>&SendEmail=1012">Clic aquí para volver a enviarlo </a></div>
            
            <?php } if(isset($_SESSION['userActiva']) and $_SESSION['userRol'] == "cliente" and $tramiteActivo != false){?>
              <div class="alert alert-primary " role="alert"> Tienes un tramite activo con esta mascota   <a href="tramites.php#search">Clic aquí para ver tus trámites </a></div>
            <?php } ?>
            <?php  if( $mascota->getEstado() == 'adoptado'){?>
              <div class="alert alert-primary " role="alert"> Esta mascota ya fue adoptada :) </a></div>
            <?php } ?>
            
	            <h2 class="mb-4"><?php echo "Mascota ".$mascota->getNombre() ?></h2>
    				</div>
            
    				<div class="row">
	    				<div class="col-md-6 services-2 w-100 d-flex">
	    					<div class="icon d-flex align-items-center justify-content-center"><i class="fas fa-dog icon-pets"></i></div>
	    					<div class="text pl-3">
	    						<h4>Especie & sexo</h4>
	    						<p><?php echo $mascota->getEspecie(). ' / '. $mascota->getSexo() ?></p>
	    					</div>
	    				</div>
              <div class="col-md-6 services-2 w-100 d-flex">
	    					<div class="icon d-flex align-items-center justify-content-center"><i class="fas fa-paw icon-pets"></i></div>
	    					<div class="text pl-3">
	    						<h4>Edad</h4>
	    						<p><?php echo $mascota->getEdad() ?> año(s)</p>
	    					</div>
	    				</div>
	    				<div class="col-md-6 services-2 w-100 d-flex">
	    					<div class="icon d-flex align-items-center justify-content-center"> <i class="fas fa-book-open icon-pets"></i></div>
	    					<div class="text pl-3">
	    						<h4>Historia</h4>
	    						<p><?php echo $mascota->getHistoria() ?></p>
	    					</div>
	    				</div>
	    				
	    				<div class="col-md-6 services-2 w-100 d-flex">
	    					<div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-veterinarian"></span></div>
	    					<div class="text pl-3">
	    						<h4>Observaciones</h4>
	    						<p><?php echo $mascota->getObservaciones() ?></p>
	    					</div>
	    				</div>
              <?php if (isset($_SESSION['userNombre']) and $_SESSION['userRol']=='admin'){ ?>
              <div class="col-md-6 services-2 w-100 d-flex">
	    				
	    					<div class="text pl-3">
               
                <a href="editarMascota.php?idMascota=<?php echo $mascota->getId() ?>" class="btn btn-dark"> Editar </a>
                </div>               
	    				</div>
              <?php }else{ ?>
              <div class="col-md-6 services-2 w-100 d-flex"></div>
              <?php } ?>
              
              <div class="col-md-6 services-2 w-100 d-flex justify-content-start">
	    				
	    					<div class="text pl-3">
                <?php if(isset($_SESSION['userNombre']) and $_SESSION['userRol']!='admin' and $_SESSION['userActiva'] == 1) { if($tramiteActivo == false and $mascota->getEstado() == 'disponible' ) {?>
                  <a href="formulario.php?idMascota=<?php echo $mascota->getId() ?>" class="btn btn-primary"> Adoptar </a>
	    					<?php } }?>
                <?php if(!isset($_SESSION['userNombre'])){ ?>
                  <a href="login.php" class="btn btn-primary"> Iniciar sesión </a>
                <?php } ?>
                </div>
	    				</div>
	    			</div>
	        </div>
        </div>
    	</div>
    </section>


    
    

	<?php include("includes/footer.php"); ?>

    
  

  <!-- loader -->
  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>


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