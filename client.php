<?php
//captar mensaje escrito
array_shift($argv);
$mensaje = implode(" ", $argv);

//arreglo de IP's
$host = array('127.0.0.1', '', '', '');

$puerto=4545;
//crear scoket
$socket=socket_create(AF_INET,SOCK_STREAM,SOL_TCP);
$conexion=socket_connect($socket,$host[0],$puerto);
//tamaño del buffer
$tamaño=2048;

if($conexion){
    echo "Conexion Exitosa, puerto ".$puerto."\n\n";
    $salida='';
    socket_write($socket, $mensaje);
 
    while($salida=socket_read($socket,$tamaño)){
        echo $salida;
    }
 
}else{
    echo "\n la conexion TCP no se a podido realizar, puerto: ".$puerto;
    }
 
socket_close($socket); //cierra el recurso socket dado por $socket
?>