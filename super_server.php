<?php
 
// abrir server en puerto 8585
$server = stream_socket_server("tcp://0.0.0.0:8585");
 
if ($server === false)
{
    die("No se pudo enlazar al socket: $errorMessage");
}
 
$client_socks = array();

//escuchando
while(true)
{
    //lectores de sockets (arreglos)
    $read_socks = $client_socks;
    $read_socks[] = $server;
     
    //se comienza a leer los sockets
    if(!stream_select ( $read_socks, $write, $except, 300000 ))
    {
        die('error al leer el socket');
    }
     
    //se agregan los Nuevos Clientes
    if(in_array($server, $read_socks))
    {
        $new_client = stream_socket_accept($server);
         
        if ($new_client)
        {
            //imprime imformacion del cliente conectado
            echo 'Se conecto: ' . stream_socket_get_name($new_client, true) . " \n";
             
            $client_socks[] = $new_client;
            echo "Actualmente hay ". count($client_socks) . " clientes \n\n";
        }
         
        //se borra el server socket del lector de sockets
        unset($read_socks[ array_search($server, $read_socks) ]);
    }
     
    //Mensajes de los clientes existentes
    foreach($read_socks as $sock)
    {
        $data = fread($sock, 128);
        if(!$data)
        {
            //Quitar el cliente que se desconecto del arreglo de clientes
			unset($client_socks[ array_search($sock, $client_socks)]);
            fclose($sock);
            echo "Un cliente se desconecto. Ahora hay ". count($client_socks) . " clientes \n";
            continue;
        }
        //enviar el mensaje de regreso al cliente
        fwrite($sock, $data);
    }
}
?>