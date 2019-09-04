<?php

/**
 * Created by PhpStorm.
 * User: jhoy
 * Date: 31/08/2019
 * Time: 00:21
 */
class Nestoria
{
    private $endPoint = 'https://api.nestoria.es/api?encoding=json&pretty=1&action=search_listings&country=es&has_photo=1&sort=newest';


    public function setCoordenadas($latitud,$longitud,$radio = '')
    {
        $this->endPoint .= "&centre_point=$latitud,$longitud";
        ($radio) ? $this->endPoint .= ",$radio" : '';
    }

    public function setPlaceName($place){
        $this->endPoint .= "&place_name=$place";
    }

    public function setListingType($type){
        $this->endPoint .= "&listing_type=$type";
    }

    public function setFilters($req)
    {
        $req = implode(',',$req);
        $this->endPoint .= "&keywords=$req";
    }

    public function setnumberOfResults($num){
        $this->endPoint .= "&number_of_results=$num";
    }

    public function setPage($num){
        $this->endPoint .= "&page=$num";
    }

    public function get(){

        $headers = array('Content-Type : application/x-www-form-urlencoded');
        //Iniciar la sesión de curl
        $ch = curl_init();

        //Establecemos la URL.
        curl_setopt($ch, CURLOPT_URL, $this->endPoint);
        //Usaremos post
        curl_setopt($ch, CURLOPT_POST, TRUE);
        //Obligatorio si se usa POST, aunque sea vacío
        curl_setopt($ch, CURLOPT_POSTFIELDS, array());
        //Para devolver el resultado como un string
        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, TRUE);
        //No necesitamos que se validen certificados
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        //Cabeceras de la petición
        curl_setopt ($ch, CURLOPT_HTTPHEADER, $headers);
        //Executamos la sesión
        $strResponse = curl_exec($ch);

        $data = [
          'estado' => 'ok'
        ];

        //Manejar los errores
        $curlErrno = curl_errno($ch);
        if ($curlErrno)
        {
            $curlError = curl_error($ch);
            $data['estado'] = 'error';
            $data['response'] = $curlErrno;
        }
        if ($strResponse == ''){
            $data['estado'] = 'error';
            $data['mensaje'] = 'Respuesta nestoria vacia';
        }
        //Cerramos la Sesión.
        curl_close($ch);
        $data['response'] = json_decode($strResponse);
        // El token viene tal cual, ni JSON ni nada, en el propio cuerpo
        return json_encode($data);
    }
}