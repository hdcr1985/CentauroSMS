<?php
/**
 * Libreria de Integracion CentauroSMS v1.2
 * API para Integracion de Envios de SMS a cualquier Aplicacion Web
 * 
 * @autor Hernan Crespo
 *
 */
class CentauroSMS {

    private $client_id;
    private $client_secret;
    private $result_data;

    function __construct($client_id, $client_secret) {
        $this->client_id = $client_id;
        $this->client_secret = $client_secret;
    }

    /**
     * Obtener numero de SMS disponibles
     */
    public function get_sms_disponibles() {
       $credenciales = $this->cParametros(array(
            'client_id' => $this->client_id,
            'client_secret' => $this->client_secret,
			'client_opcion' => 'sms_disponibles'));

       return $result_data = cSMSClient::post("/controllersms/", $credenciales, "application/x-www-form-urlencoded");		
    }
    /**
     * Envio de SMS Masivos normales
     */    
    public function set_sms_send($json,$msg) {
       $credenciales = $this->cParametros(array(
            'client_id' => $this->client_id,
            'client_secret' => $this->client_secret,
			'json' => base64_encode(urlencode($json)),
			'msg' => base64_encode(urlencode($msg)),
			'client_opcion' => 'send_sms'));

       return $result_data = cSMSClient::post("/controllersms/", $credenciales, "application/x-www-form-urlencoded");		
    }
    /**
     * Envio de SMS Masivos personalizados
     */     	
    public function set_sms_send_personalizado($json){
       $credenciales = $this->cParametros(array(
            'client_id' => $this->client_id,
            'client_secret' => $this->client_secret,
            'json' => base64_encode(urlencode($json)),
            'client_opcion' => 'send_sms_personalizado'));

       return $result_data = cSMSClient::post("/controllersms/", $credenciales, "application/x-www-form-urlencoded");     
    }  
    private function cParametros($params) {
        if (function_exists("http_build_query")) {
            return http_build_query($params, "", "&");
        } else {
            foreach ($params as $name => $value) {
                $elements[] = "{$name}=" . urlencode($value);
            }
            return implode("&", $elements);
        }
    }	
	
}

/**
 * CentauroSMS cURL Cliente
 */
class cSMSClient{

    const API_BASE_URL = "http://api.centaurosms.com.ve";

    private static function get_connect($uri, $method, $content_type) {
        $connect = curl_init(self::API_BASE_URL . $uri);
        curl_setopt($connect, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($connect, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($connect, CURLOPT_HTTPHEADER, array("Accept: application/json", "Content-Type: " . $content_type));
        return $connect;
    }
    private static function set_data(&$connect, $data, $content_type) {
        if ($content_type == "application/json") {
            if (gettype($data) == "string") {
                json_decode($data, true);
            } else {
                $data = json_encode($data);
            }

            if(function_exists('json_last_error')) {
                $json_error = json_last_error();
                if ($json_error != JSON_ERROR_NONE) {
                    throw new Exception("JSON Error [{$json_error}] - Data: {$data}");
                }
            }
        }
        curl_setopt($connect, CURLOPT_POSTFIELDS, $data);
    }	
    private static function exec($method, $uri, $data, $content_type) {
        $connect = self::get_connect($uri, $method, $content_type);
        if ($data) {
            self::set_data($connect, $data, $content_type);
        }		
        $api_result = curl_exec($connect);
        $response = json_decode($api_result, true);		
        curl_close($connect);
        return $response;
    }
    public static function get($uri, $content_type = "application/json") {
        return self::exec("GET", $uri, null, $content_type);
    }

    public static function post($uri, $data, $content_type = "application/json") {
        return self::exec("POST", $uri, $data, $content_type);
    }

    public static function put($uri, $data, $content_type = "application/json") {
        return self::exec("PUT", $uri, $data, $content_type);
    }

}
?>
