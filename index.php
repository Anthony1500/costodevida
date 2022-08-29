<!doctype html>
<html>
<head>
<title>Cargar Ficheros</title>

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
        function GetDateTime() {
            var currentTime = new Date()
            var month = currentTime.getMonth() + 1
            var day = currentTime.getDate()
            var year = currentTime.getFullYear()
           if(month < 10){
            month = "0" + month
           }
           if(day < 10){
            day = "0" + day
           }
           
            document.getElementById('date').value = year + "-" + month + "-" + day ;
        }  
        function isNumberKey(evt)
			{
				var charCode = (evt.which) ? evt.which : evt.keyCode;
				if (charCode != 46 && charCode > 31 
				&& (charCode < 48 || charCode > 57))
				return false;
				return true;
			}  
      
      function reporte() {
        window.location.href='reportes.php';
    
   
    
	
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

<?php
 session_start();
 if( isset($_SESSION['usuario']) ==false)
 header("location: login.php") ;
 //si existe el usuario se queda en la pagina si no se redirecciona al login
?>
<body onload="return GetDateTime();">
<div role="navigation" class="navbar navbar-inverse navbar-static-top">
  <div class="container">
    <div class="navbar-header">
     
      <a  class="navbar-brand">PROYECTO</a> </div>
    <div class="navbar-collapse collapse">
      <ul class="nav navbar-nav">
      </ul>
    </div>
    <!--/.nav-collapse --> 
  </div>
</div>

<div class="container">
  <div class="row">
    <h4>Ingreso de Gastos</h4>
    <hr style="margin-top:5px;margin-bottom: 5px;">
    <div class="content"> </div>
    <div class="panel panel-primary">
      <div class="panel-heading">
        <h3 class="panel-title">Formulario Ingreso de Gastos</h3>
      </div>
      <div class="panel-body">
        <div class="col-lg-3">
          <form method="POST"  action="guardar.php" type="sumit">
<div class="form-group">
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<h5><b>Fecha</b></h5>
<div class="input-group" >
   <div class="input-group-addon" >
	<span class="glyphicon glyphicon-calendar"></span> 
   </div>
  
   <input size="16"  type="text" class="date form-control input-sm " name="date" value="" id="date" readonly>
         
             
              </div>  
 <!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
</div>

<div class="form-group">
<h5><b>Gastos</b></h5>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<div class="input-group" >
   <div class="input-group-addon" >
	<span class="glyphicon glyphicon-list-alt"></span> 
   </div>
  
   
   <select  id="tipo_gastos" class="gasto form-control input-sm " name="tipo_gastos"  readonly>
   
    <option value="Alimentación">Alimentación</option>
    <option value="Medicina (salud)">Medicina (salud)</option>
    <option value="Arriendo">Arriendo</option>
    <option value="Educación">Educación</option>
    <option value="Transporte">Transporte</option>
    <option value="Diversión">Diversión</option>
    <option value="Viajes">Viajes</option>
    <option value="Otros">Otros</option>
  </select>     
             
              </div>  
 <!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
</div>

<div class="form-group">
<h5><b>Valor</b></h5>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<div class="input-group" >
  
   <div class="input-group-addon" >
	<span class="glyphicon glyphicon-usd"></span> 
   </div>
  
   
   <input type="number" min="0.00" step="0.05"  name="valor_gastos" value="0.00" id="valor_gastos" onkeypress="return isNumberKey(event)" class="valor form-control input-sm" placeholder="ingrese un valor.">    
             
              </div>  
 <!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
</div>

          <button class="btn btn-primary" type="submit">Guardar</button>
          
          </form>
          
        </div>
        <div class="col-lg-6"> </div>
      </div>
    </div>
  
<!--tabla-->
    <div class="panel panel-primary">
      <div class="panel-heading">
        <h3 class="panel-title">Datos Disponibles</h3>
      </div>
      <div class="panel-body">
   
<table class="table">
  <thead>
    <tr>
      <th width="7%">#</th>
      <th width="13%" style="text-align: center;">Tipo de Gasto</th>
      <th width="10%" style="text-align: center;">Fecha</th>
      <th width="10%" style="text-align: center;">Valor</th>
      
    </tr>
  </thead>
  <tbody>
  
<?php

  
$serverName = "localhost";
$username = "root";
$password = "";
$db="costodevida";
$con = mysqli_connect($serverName,$username,$password,$db);
$sql = "SELECT * from gastos g "; 
    $result= mysqli_query($con,$sql); 
    


$num=0;
//for ($i=2; $i<count($archivos); $i++)
while( $record = mysqli_fetch_assoc($result) ) 

{$num++;
?>
<p>  
 </p>
         
    <tr>
      <th scope="row"><?php echo $num;?></th>
      <td style="text-align: center;"><?php echo $record['tipo_gastos']; ?></td>
      <td style="text-align: center;"><?php echo $record['fecha_gastos']; ?></td>
      <td style="text-align: center;"><?php echo $record['valor_gastos']; ?></td>
      
      <td><a title="Eliminar" href="Eliminar.php?id=<?php echo $record['id_gastos'];?>" style="color: red; font-size:18px;" onclick="return confirm('Esta seguro de eliminar el archivo?');"> <span class="glyphicon glyphicon-trash" aria-hidden="true"></span> </a></td>
    </tr>
    
 <?php }?> 

  </tbody>
  
</table>
<button style="transform: translate(600%, 1%);" class="btn btn-warning" onclick="reporte()" type="sumit">Reportes</button>
</div>
</div>




</div>


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
   