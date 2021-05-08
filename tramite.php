<?php if (!isset($_SESSION)) {
  session_start(); 
}
include "Negocio/TramiteNegocio.php";

if(isset($_GET['idTramite'])){
	$idTram = $_GET['idTramite'];

 
  }else if(isset($_POST['idTramite'])){
    $idTram =$_POST['idTramite'];
  }
  else{
    header('Location:tramites.php');
  }

  


  

if(isset($_POST['masc_sent'])){

  cambiarEstado($idTram, $_POST['idMascota'], $_POST['estado']);


}
$tramite =  getTramitePorId($idTram);


if($_SESSION['userRol'] == 'cliente' and $tramite->getIdUsuario()->getId() != $_SESSION['userId']){
  
  header("Location:tramites.php");
}


?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Pet Sitting - Free Bootstrap 4 Template by Colorlib</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link href="https://fonts.googleapis.com/css?family=Montserrat:200,300,400,500,600,700,800&display=swap" rel="stylesheet">

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
          	<p class="breadcrumbs mb-2"><span class="mr-2"><a href="index.html">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>About us <i class="ion-ios-arrow-forward"></i></span></p>
            <h1 class="mb-0 bread">About Us</h1>
          </div>
        </div>
      </div>
    </section>

    <section class="ftco-section pt-5 pb-5">
    	<div class="container">
    		<div class="row d-flex no-gutters">
    			<div class="col-md-5 d-flex">
    				<div class="img img-video d-flex align-self-stretch align-items-center justify-content-center justify-content-md-center mb-4 mb-sm-0" style="background-image:url(<?php echo $tramite->getIdMascota()->getFoto(); ?>);">
    				</div>
    			</div>
    			<div class="col-md-7 pl-md-5 py-md-5">
    				<div class="heading-section pt-md-5">
	            <h2 class="mb-4"><?php echo $tramite->getId(); ?></h2>
    				</div>
    				<div class="row">
	    				<div class="col-md-6 services-2 w-100 d-flex">
	    					<div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-stethoscope"></span></div>
	    					<div class="text pl-3">
	    						<h4><?php echo $tramite->getFechaSolicitud(); ?></h4>
	    						<p><?php echo  $tramite->getIdMascota()->getNombre(); ?></p>
	    					</div>
	    				</div>
              <a href="cliente.php?idUsuario=<?php echo $tramite->getIdUsuario()->getId();?>">
	    				<div class="col-md-6 services-2 w-100 d-flex">
	    					<div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-customer-service"></span></div>
	    					<div class="text pl-3">
	    						<h4>Cliente:</h4>
	    						<h4><?php echo $tramite->getIdUsuario()->getNombre(); ?></h4>
	    					</div>
	    				</div>
	    				</a>
              <div class="col-md-6 services-2 w-100 d-flex">
	    					<div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-emergency-call"></span></div>
	    					<div class="text pl-3">
	    						<h4>Emergency Services</h4>
	    						<p>Far far away, behind the word mountains, far from the countries.</p>
	    					</div>
	    				</div>
	    				<div class="col-md-6 services-2 w-100 d-flex">
	    					<div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-veterinarian"></span></div>
	    					<div class="text pl-3">
	    						<h4>Veterinary Help</h4>
	    						<p>Far far away, behind the word mountains, far from the countries.</p>
	    					</div>


                </div>
                <form action="tramite.php" method="post" class="form-edit">
                <div class="col-md-6 services-2 w-100 d-flex">
	    					<div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-veterinarian"></span></div>
	    					<div class="text pl-3">
                <label class="label" for="estado">Estado </label>

                <select name="estado" id="estado" class="form-control" >
                     <option value="aceptado" >Aceptado</option>
                     <option value="procesando" >Procesando</option>
                     <option value="cancelado" >Cancelado</option>
                     </select>
	    				</div>
	    					</div>
                <div class="col-md-6 services-2 w-100 d-flex pl-20" >
	    					<div class="text pl-3 pt-5 pl-5">

                
                <input type="hidden" value="<?php echo $tramite->getIdMascota()->getId(); ?>" class="btn btn-primary" name="idMascota">
                <input type="hidden" value="<?php echo 	$idTram; ?>" class="btn btn-primary" name="idTramite">
                <input type="submit" value="Guardar" class="btn btn-primary" name="masc_sent">
                
                
               
	    				</div>
	    					</div>
                </form>

                
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