<?php
//captar mensaje escrito
array_shift($argv);
$mensaje = implode(" ", $argv);

//arreglo de IP's
$host = array('127.0.0.1', '10.0.0.153', '10.0.0.51', '10.0.0.152');
$port = array(8000,3535,4545,7000);
$num_rand = rand(0,3);
//crear scoket
$socket=socket_create(AF_INET,SOCK_STREAM,SOL_TCP);
$conexion=socket_connect($socket,$host[$num_rand],$port[$num_rand]);
//tamaño del buffer
$tamano=2048;

if($conexion){
    echo "Conexion Exitosa, puerto: ".$port[$num_rand]."\n\n";
    $salida='';
    socket_write($socket, $mensaje);
 
    while($salida=socket_read($socket,$tamano)){
        echo $salida;
    }
 
}else{
    echo "\n la conexion TCP no se a podido realizar en el puerto: ".$port[$num_rand];
}
 
socket_close($socket); //cierra el recurso socket dado por $socket
?>