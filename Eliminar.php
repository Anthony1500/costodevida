<?php
header( $header, $replace, $http_response_code );
$response = array( 
    'status' => 0, 
    'msg' =>  '  Se produjeron algunos problemas. Inténtalo de nuevo.'); 
    $id=$_GET['id'];// obtengo el id seleccionado a eliminar 
    $serverName = "localhost";
    $username = "root";
    $password = "";
    $db="costodevida";
    $con = mysqli_connect($serverName,$username,$password,$db);
                
                $sql = "DELETE FROM gastos WHERE id_gastos='{$id}'"; 
                $delete = $con->query($sql); 
                
                if($delete){ 
                    $response['status'] = 1; 
                    $response['msg'] = '¡Los datos se han eliminado con éxito!'; 
                }else{ 
                $response['msg'] = 'Por favor complete todos los campos obligatorios.'; 
            } 
            echo json_encode($response); 


            header("Location: index.php");// aqui redirecciona a la pantalla index 
exit();
            ?>