<!doctype html>
<html>
<head>
<title>Cargar Ficheros</title>
<?php
    header("Cache-Control: no-cache, must-revalidate");
    header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
?>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" >
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.11.2/css/bootstrap-select.min.css'>

    <!-- Bootstra Datepicker CSS -->
    <link rel="stylesheet" href="assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css">
    
    <script type="text/javascript">
        
        function isNumberKey(evt)
			{
				var charCode = (evt.which) ? evt.which : evt.keyCode;
				if (charCode != 46 && charCode > 31 
				&& (charCode < 48 || charCode > 57))
				return false;
				return true;
			}  
     
    
            function actualizar(){ window.location.href='reportes.php';}
//Función para actualizar cada 4 segundos(4000 milisegundos)
  setInterval("actualizar()",35000);
	
      function othername() {
       
    var fechainicial =document.getElementById("fechainicio").value;
    var fechafinal = document.getElementById("fechafinal").value; 
    

    window.location.href = window.location.href + "?fechainicial=" + fechainicial + "&fechafinal=" + fechafinal;
   
    
	
	}
    function inicio(){ window.location.href='index.php';}

    function excel() {
  window.location.href = "reporteExcel.php";
  
}
    </script>
    
<style>
  input[type=text] {
    padding: 10px 11px;
    
}
.navbar {
	position: relative;
	min-height: 50px;
	margin-bottom: 5px;
}
</style>
</head>
<body>
<div role="navigation" class="navbar navbar-inverse navbar-static-top">
  <div class="container">
    <div class="navbar-header">
     
      <a  class="navbar-brand">PROYECTO</a> </div>
    <div class="navbar-collapse collapse">
      
    </div>
    <!--/.nav-collapse --> 
  </div>
</div>

<div class="container">
  
    
    
   
    <div class="panel ">
     
      
        <div class="col-lg-3">
                   
          </form>
      
        
      </div>
    </div>
  
<!--tabla-->
   
      
   

  <tbody>
  


<h4>Reportes</h4>
<div class="panel panel-primary">
      <div class="panel-heading">
        <h3 class="panel-title">Reportes de los Gastos</h3>
        
      </div>
      <div class="panel-body">
        <div class="col-lg-3">
        <button  class="btn btn-warning" onclick="inicio()" type="sumit">Página de Inicio</button>
<div class="form-group">
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<h5><b>Fecha Inicio</b></h5>
<div class="input-group" >
   <div class="input-group-addon" >
	<span class="glyphicon glyphicon-calendar"></span> 
   </div>
  
   <input size="16"  type="text" class="date form-control input-sm "name="fechainicio" value="" id="fechainicio" readonly>
         
         
   
              </div>  
 <!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
</div>
<div class="form-group">
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<h5><b>Fecha final</b></h5>
<div class="input-group" >
   <div class="input-group-addon" >
	<span class="glyphicon glyphicon-calendar"></span> 
   </div>
  
   <input size="16"  type="text" class="date form-control input-sm"  name="fechafinal" value="" id="fechafinal" readonly>
         
             
              </div>  
 <!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
 
</div>

<button class="btn btn-primary" onclick="actualizar()" type="sumit">Limpiar</button>
<button class="btn btn-primary" onclick="othername()" type="sumit">Buscar</button>



</div>

<h4  style="transform: translate(23%, 550%);">Lista de los Gastos</h4>
      <div class="panel-body">
      <button class="btn btn-success"style="transform: translate(310%, -166%);" onclick="excel()"  type="sumit">Descargar Reporte General</button>
<table class="table" url="buscar.php">
  
  <thead >
  
  
    <tr >
    
      <th width="7%">#</th>
      <th width="13%">Tipo de Gasto</th>
      <th width="10%">Fecha</th>
      <th width="10%">Valor</th>
      
    </tr>
  </thead>
  <tbody>
  
 
<?php


$serverName = "localhost";
$username = "root";
$password = "";
$db="costodevida";
$con = mysqli_connect($serverName,$username,$password,$db);
if (isset($_GET["fechainicial"]) && isset($_GET["fechafinal"])) {
  // asignar w1 y w2 a dos variables
  $fechainicial = $_GET["fechainicial"];
  $fechafinal = $_GET["fechafinal"];
// echo $fechainicial;

 //echo $fechafinal ;
  $sql1 = "SELECT * from gastos g where fecha_gastos BETWEEN '{$fechainicial}' AND '{$fechafinal}'"; 
  $result= mysqli_query($con,$sql1); 
 
} else {
  $sql2 = "SELECT * from gastos g where fecha_gastos BETWEEN '2050-08-12' and '2050-08-12'"; 
  $result= mysqli_query($con,$sql2); 
}




    
    


$num=0;

//for ($i=2; $i<count($archivos); $i++)
while( $record = mysqli_fetch_assoc($result) ) 

{$num++;
?>
<p>  
 </p>
         
    <tr>
      
      <th scope="row"><?php echo $num;?></th>
      <td><?php echo $record['tipo_gastos']; ?></td>
      <td><?php echo $record['fecha_gastos']; ?></td>
      <td><?php echo $record['valor_gastos']; ?></td>
      
     
    </tr>
 <?php }?> 

  </tbody>
</table>
<?php


$serverName = "localhost";
$username = "root";
$password = "";
$db="costodevida";
$con = mysqli_connect($serverName,$username,$password,$db);
if (isset($_GET["fechainicial"]) && isset($_GET["fechafinal"])) {
  // asignar w1 y w2 a dos variables
  $fechainicial = $_GET["fechainicial"];
  $fechafinal = $_GET["fechafinal"];
// echo $fechainicial;

 //echo $fechafinal ;
  $sql1 = "SELECT sum(valor_gastos) AS suma from gastos g where fecha_gastos BETWEEN '{$fechainicial}' AND '{$fechafinal}'"; 
  $result= mysqli_query($con,$sql1); 
 
} else {
  $sql2 = "SELECT sum(valor_gastos) AS suma from gastos g where fecha_gastos BETWEEN '2050-08-12' and '2050-08-12'"; 
  $result= mysqli_query($con,$sql2); 
}
//for ($i=2; $i<count($archivos); $i++)
$record = mysqli_fetch_assoc($result)

?>



<div class="col-lg-3">
<div class="form-group" style="transform: translate(170%, 50%);">
<h5><b>Gasto Total</b></h5>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<div class="input-group" >
  
   <div class="input-group-addon" >
	<span class="glyphicon glyphicon-usd"></span> 
   </div>
  
   
   <input type="number"  min="0.00" step="0.05" value="<?php echo $record['suma']; ?>" name="valor_gastos" value="0.00" id="valor_gastos" onkeypress="return isNumberKey(event)" class="valor form-control input-sm" placeholder="ingrese un valor." readonly>    
             
              </div>  
 <!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
</div>
</div>




</div>

</div>

<!-- Fin tabla--> 
  </div>
  
</div>

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Bootstrap Datepicker JS -->
    <script src="assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
    <!-- Page Script -->
    <script src="assets/js/scripts.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js"></script>
</body>
</html>
   