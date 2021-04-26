<?php 



function obtenerTramites()
{
include_once "Entidades/Tramite.php";
include("Conexion.php");

 $queryTramites = "SELECT id, id_usuario, id_mascota, estado, fecha_solicitud FROM emp_tramite";

  // Ejecutamos el query
  $resQueryTramites = mysqli_query($connLocalhost, $queryTramites) or trigger_error("El query de login de usuario falló");

  $Tramites = [];


if (mysqli_num_rows($resQueryTramites)) { 

while ($tramData = mysqli_fetch_assoc($resQueryTramites)){
    $tram = new Tramite();
	$tram->setId =  $tramData['id'];
	$tram->setIdUsuario =  $tramData['id_usuario'];
	$tram->setIdMascota=  $tramData['id_mascota'];
	$tram->setEstado =  $tramData['estado'];
	$tram->setFechaSolicitud =  $tramData['fecha_solicitud'];
	
	

	array_push($Tramites, $tram);
} 
}

 return $Tramites;

}

function agregarTramite( $idUsuario, $idMascota, $estado)
{

  include_once("Conexion.php");
  $connLocalhost = conexion();

$queryInsertTramite = sprintf(
      "INSERT INTO emp_tramite (id_usuario, id_mascota, estado) VALUES ( '%d', '%d', '%s')",
      mysqli_real_escape_string($connLocalhost, trim($idUsuario)),
      mysqli_real_escape_string($connLocalhost, trim($idMascota)),
      mysqli_real_escape_string($connLocalhost, trim($estado))
     

    );

    // Ejecutamos el query en la BD
    $resQueryTramite = mysqli_query($connLocalhost, $queryInsertTramite) or trigger_error("El query de inserción de usuarios falló");

    if ($resQueryTramite) {
      $connLocalhost->close();
      return true;
    } else {
      $connLocalhost->close();
      return false;
    }


    
}

function editarTramite($id, $idUsuario, $idMascota, $estado)
{
include_once("Conexion.php");

$queryEditTramite = sprintf(
      "UPDATE  emp_tramite SET id_usuario = '%d', id_mascota = '%d', estado = '%s' WHERE id = '%d' ",
      mysqli_real_escape_string($connLocalhost, trim($idUsuario)),
      mysqli_real_escape_string($connLocalhost, trim($idMascota)),
      mysqli_real_escape_string($connLocalhost, trim($estado)),
      mysqli_real_escape_string($connLocalhost, trim($id))

     

    );

    // Ejecutamos el query en la BD
    $resQueryTramite = mysqli_query($connLocalhost, $queryEditTramite) or trigger_error("El query de inserción de usuarios falló");

    
}

function eliminarTramite($id){

	include_once("Conexion.php");
	$queryDeleteTramite = sprintf(
    "DELETE from emp_tramite where id = '%d'",
    mysqli_real_escape_string($connLocalhost, trim($id))

  );

  // Ejecutamos el query en la BD
  $resQueryUsuarioInfo = mysqli_query($connLocalhost, $queryDeleteTramite) or trigger_error("El query de eliminación de mascotas falló");
}