<?php 
require 'conexionreporte.php';
function getgasto ()
{
  $mysqli = getConnexion();
  $query = 'SELECT * FROM  gasto ';
  return $mysqli->query($query);
}
?>