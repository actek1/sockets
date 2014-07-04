<?php
require_once "crypt.php";

$direccion=0;
$puerto=4545;
$socket=socket_create(AF_INET,SOCK_STREAM,0);

socket_bind($socket, $direccion, $puerto);
socket_listen($socket);
 
$tamaño=2048;
while(true){
    $cliente = socket_accept($socket);
    $mensaje = socket_read($cliente, $tamaño); //leemos mensaje del cliente
    $mensaje_encrypted = Encrypter::encrypt($mensaje); //encriptamos el mensaje
    socket_write($cliente, $mensaje_encrypted); //escribimos el buffer con el mensaje encriptado
    socket_close($cliente); //cerramos cliente
}
socket_close($socket);
?>