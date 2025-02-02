<?php if (!isset($_SESSION)) {
  session_start(); 
  if(!isset($_SESSION['userRol']) or $_SESSION['userRol'] != 'admin'){
    header('Location: index.php');
  }
}
include "Negocio/TramiteNegocio.php";




if( !isset($_SESSION['userNombre']) ){
	header('Location: index.php');
  
  }

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
  header("Location:tramite.php?idTramite=".$idTram."&edit=1");

}
$tramite =  getTramitePorId($idTram);


if($_SESSION['userRol'] == 'cliente' and $tramite->getIdUsuario()->getId() != $_SESSION['userId']){
  
  header("Location:tramites.php");
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
          	<p class="breadcrumbs mb-2"><span class="mr-2"><a href="index.php">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Trámite <i class="ion-ios-arrow-forward"></i></span></p>
            <h1 class="mb-0 bread">Detalle de trámite</h1>
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
	            <h2 class="mb-4">ID de trámite: <?php echo $tramite->getId(); ?></h2>
    				</div>
            <?php  if(isset($_GET['edit']) and $_GET['edit'] == 1){ ?>
              <div class="alert alert-primary " role="alert"> Edición éxitosa  </div>
            
            <?php } ?>
    				<div class="row">
	    				<div class="col-md-6 services-2 w-100 d-flex">
	    					<div class="icon d-flex align-items-center justify-content-center"><i class="far fa-clock icon-pets"></i></div>
	    					<div class="text pl-3">
	    						<h4>Fecha de solicitud</h4>
	    						<p><?php echo $tramite->getFechaSolicitud(); ?></p>
	    					</div>
	    				</div>
              
	    				<div class="col-md-6 services-2 w-100 d-flex">
	    					<div class="icon d-flex align-items-center justify-content-center"><i class="far fa-user icon-pets"></i></div>
	    					<div class="text pl-3">
                <a href="cliente.php?idUsuario=<?php echo $tramite->getIdUsuario()->getId();?>">
	    						<h4>Cliente:</h4>
	    						<p><?php echo $tramite->getIdUsuario()->getNombre(); ?></p>
                  </a>
	    					</div>
	    				</div>
              <div class="col-md-6 services-2 w-100 d-flex">
	    					<div class="icon d-flex align-items-center justify-content-center"><i class="fas fa-at icon-pets"></i></div>
	    					<div class="text pl-3">
	    						<h4>Email:</h4>
                  <p><?php echo $tramite->getIdUsuario()->getCorreo();?></p>
	    					</div>
	    				</div>

              <div class="col-md-6 services-2 w-100 d-flex">
	    					<div class="icon d-flex align-items-center justify-content-center"><i class="fas fa-phone icon-pets"></i></span></div>
	    					<div class="text pl-3">
	    						<h4>Celular:</h4>
                  <p><?php echo $tramite->getIdUsuario()->getInfo()->getCelular();?></p>
	    					</div>
	    				</div>
             
	    				<div class="col-md-6 services-2 w-100 d-flex">
	    					<div class="icon d-flex align-items-center justify-content-center"><i class="fas fa-paw icon-pets"></i></span></div>
	    					<div class="text pl-3">
                <a href="pet.php?idMascota=<?php echo $tramite->getIdMascota()->getId();?>">
	    						<h4>Mascota a adoptar:</h4>
	    						<p><?php echo $tramite->getIdMascota()->getNombre(); ?></p>
                  </a>
	    					</div>
	    				</div>

              <div class="col-md-6 services-2 w-100 d-flex">
	    					<div class="icon d-flex align-items-center justify-content-center"><i class="fas fa-venus-mars icon-pets"></i></span></div>
	    					<div class="text pl-3">
	    						<h4>Especie & Sexo:</h4>
                  <p><?php echo $tramite->getIdMascota()->getEspecie() ." / ". $tramite->getIdMascota()->getSexo() ;?></p>
	    					</div>
	    				</div>
	    				
              <?php if($tramite->getEstado() == "aceptado"){ ?>
              <div class="col-md-6 services-2 w-100 d-flex">
	    					<div class="icon d-flex align-items-center justify-content-center"><i class="far fa-file-pdf icon-pets"></i></div>
	    					<div class="text pl-3">
	    						<h4>Reporte de trámite</h4>
	    						<a href= "reporte.php?idTramite=<?php echo $tramite->getId();?>" target="_blank"> <button  class="btn btn-dark" >PDF</button></a>
	    					</div>
	    				</div>
              <?php } ?>
	    				
                <form action="tramite.php" method="post" class="form-edit">
                <div class="col-md-10   ">
	    					<div class="col-md-8 "></div>
	    					<div class="text pl-1 mb-3 col-md-8">
                <h4><label class="label" for="estado">Estado  <?php if($tramite->getEstado() == "aceptado"){ echo " aceptado";}?> </label></h4>
                <?php if($tramite->getEstado() != "aceptado"){?>
                <select name="estado" id="estado" class="form-control col-md-12 " <?php if($_SESSION['userRol']!= 'admin') echo "disabled"; ?>>
                     <option value="aceptado" <?php echo ($tramite->getEstado() == "aceptado") ? "selected" : ""; ?>>Aceptado</option>
                     <option value="procesando"<?php echo ($tramite->getEstado() == "procesando") ? "selected" : ""; ?> >Procesando</option>
                     <option value="cancelado" <?php echo ($tramite->getEstado() == "cancelado") ? "selected" : ""; ?>>Cancelado</option>
                     </select>
                <?php } ?>
	    				</div>
	    					</div>
                <div class="" >
	    					<div class="col-md-3 offset-md-4  mt-4 pt-3 pl-3">


                <input type="hidden" value="<?php echo $tramite->getIdMascota()->getId(); ?>" class="btn btn-primary" name="idMascota">
                <input type="hidden" value="<?php echo 	$idTram; ?>" class="btn btn-primary" name="idTramite">
                
                <?php if($_SESSION['userRol']== 'admin' and  $tramite->getEstado() != "aceptado"){ ?>
                
                <input type="submit" value="Guardar" class="btn btn-primary" name="masc_sent" onclick="return confirm('¿Seguro desea editar el tramite? \nSi aceptas este trámite no podrás volver a cambiar su estado')" >
                <?php }  ?>
                
               
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