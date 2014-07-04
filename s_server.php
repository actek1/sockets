<?php
require_once "crypt.php";
//IP y puerto
$socket = stream_socket_server("tcp://0.0.0.0:8585", $errno, $errstr);
$client_array = array();

//socket_bind($socket, $host_in, $port_in);
//socket_listen($socket);
 
$size=2048;

//escuchando...
while(true){
    
	$new_client = stream_socket_accept($socket);
	
	if($new_client)
	{
		echo 'Se conecto: ' . stream_socket_get_name($new_client, true) . " \n";
		array_push($client_array, $new_client);
		echo "Actualmente hay ". count($client_array) . " clientes \n\n";
	}
	
	
	/*$client = socket_accept($socket);
    $mensaje = socket_read($client, $size); //leemos mensaje del cliente
    $mensaje_encrypted = Encrypter::encrypt($mensaje); //encriptamos el mensaje
    socket_write($client, $mensaje_encrypted); //escribimos el buffer con el mensaje encriptado
    socket_close($client); //cerramos cliente
	*/
}
//socket_close($socket);
?>