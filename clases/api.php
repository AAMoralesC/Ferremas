<?php

class API
{
	public function enviaNotificacion($numero,$nivel,$id_emergencia,$id_usuario)
	{
        
        $parametros="?id_emergencia=".$id_emergencia."&id_usuario=".$id_usuario;
        $url="https://codtrauma.toledofarias.cl/app/seguimiento/confirma.php".$parametros;
        $mensaje="CODIGO TRAUMA: Nivel de Emergencia: ".$_POST['nivel_emergencia']."Pinche Link para confirmar asistencia:".$url;
        $curl = curl_init();
        $api_key = 'd94d98d843f44bcf3ee01fad16d4650a-209d5a4f-3d57-4213-8059-a9f110a6286d';

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://j33yy9.api.infobip.com/sms/2/text/advanced',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>'{"messages":[{"destinations":['.$numero.'],"from":"InfoSMS","text":"'.$mensaje.'"}]}',
            CURLOPT_HTTPHEADER => array(
                'Authorization: App d94d98d843f44bcf3ee01fad16d4650a-209d5a4f-3d57-4213-8059-a9f110a6286d',
                'Content-Type: application/json',
            ),
        ));

        $response = curl_exec($curl);
        //var_dump($response);
       // exit();
	}
}


?>