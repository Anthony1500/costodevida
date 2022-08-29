<?php
header( $header, $replace, $http_response_code );
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET');
header('Access-Control-Allow-Headers: token, Content-Type');
header('Access-Control-Max-Age: 178000');
    $serverName = "localhost";
    $username = "root";
    $password = "";
    $db="costodevida";
    $con = mysqli_connect($serverName,$username,$password,$db);
$mensaje = "";
    $response = array( 
            'status' => 0, 
            'msg' =>  '  Se produjeron algunos problemas. Inténtalo de nuevo.' 
        );          
        try{
            $tipo_gastos = $_POST['tipo_gastos'];   
            $fecha_gastos = $_POST['date']; 
            $valor_gastos= $_POST['valor_gastos'];   
            
        
            
            $sql = "INSERT INTO gastos (tipo_gastos,fecha_gastos,valor_gastos) 
            VALUES ('$tipo_gastos','$fecha_gastos','$valor_gastos')"; 
           
           

            echo $sql;
            $insert = mysqli_query($con,$sql); 
         
        if($insert){ 
            $response['status'] = 1; 
            $response['msg'] = '¡El dato se han agregado con éxito!'; 
        } 
}


catch (Exception $e){ //usar logs
$response = array( 
    'status' => 0, 
    'msg' =>  'El dato ya existe'  
);           
}
        
        echo json_encode($response); 


            header("Location: index.php");
exit();
            ?>