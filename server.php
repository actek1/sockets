<?php
require_once "crypt.php";
//IP y puerto como server
$host_in=0;
$port_in=8000;
//IP y puerto como cliente
$host_out='127.0.0.1';
$port_out=8585;

$socket=socket_create(AF_INET,SOCK_STREAM,0);
//conexion al server central
$socket_out=socket_create(AF_INET,SOCK_STREAM,SOL_TCP);
$conection=socket_connect($socket_out,$host_out,$port_out);

socket_bind($socket, $host_in, $port_in);
socket_listen($socket);
 
$size=2048;

if($conection){
    echo "Conexion Exitosa, puerto ".$port_out."\n\n";
    $salida='';
	$mensaje = 'Hola Mundo';
    socket_write($socket_out, $mensaje);
 
    while($salida=socket_read($socket_out,$size)){
        echo $salida;
    }
}else{
    echo "\n la conexion TCP no se a podido realizar, puerto: ".$port_out;
}

while(true){
    $client = socket_accept($socket);
    $mensaje = socket_read($client, $size); //leemos mensaje del cliente
    $mensaje_encrypted = Encrypter::encrypt($mensaje); //encriptamos el mensaje
    socket_write($client, $mensaje_encrypted); //escribimos el buffer con el mensaje encriptado
    socket_close($client); //cerramos cliente
}
socket_close($socket);
?>