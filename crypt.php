<?php
 class Encrypter{
	
    public static function encrypt ($input) {
		
		$llave1 = str_split('$*/.$=-_+&$#z/.$X-_+&$z#/.$X*/.$=--_+&&$#z/.$');
		$llave2 = str_split('Gi01QDL3Q44Kx551ZBpnESsxCGASZs8p0nzmB5JyCs0Qt');
        $mensaje_array = str_split($input);
		$num = 0;
		$i = 0;
		
		foreach($mensaje_array as $letra)
		{
			$num = ord($letra); //convierto el caracter a su numero ASCII
			while($num > 99) //reduzco el valor a dos cifras dividiendolo entre 3
			{
				$num = $num/3;
			}
			//si es par lo convierto a letra
			if (round($num)%2==0){
				$num = chr(round($num));
			}
			
			//concateno las llaves con los numeros/letras obtenidas
			$str_num[$i] = (string)round($num).$llave1[$i].$llave2[$i];
			//echo $str_num[$i].'  ';
			$i++;
		}
		//var_dump($str_num);
		$cadena_encriptada = implode("",$str_num);
		
		$output = $cadena_encriptada;
		return $output;
    }
 }
?>