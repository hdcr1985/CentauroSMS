<?php


namespace centauroSMS;

class Api extends Client
{
    private $clientId;
    private $clientSecret;
    private $resultData;

  /**
   * Crear un nuevo objeto.
   *
   * @param string $clientId       llave cliente
   * @param string $clientSecret   llave secreta
   * Requeridas.
   */
    public function __construct($clientId, $clientSecret) {

	  if (empty($clientId) || empty($clientSecret)) {
		  throw new Exceptions\BaseException('Los parámetros "clientId" y "clientSecret" son requeridos para procesar la petición.');
	  }
        $this->clientId     = $clientId;
        $this->clientSecret = $clientSecret;
    }

  /**
   * Consultar SMS disponibles
   *
   * @return array<string>
   */

    public function getSmsDisponibles() {

       $credenciales = $this->cParametros([
            'client_id'     => $this->clientId,
            'client_secret' => $this->clientSecret,
			'client_opcion' => 'sms_disponibles'
       ]);

       return $resultData = parent::post('/controllersms/', $credenciales, 'application/x-www-form-urlencoded');
    }

  /**
   * Envio de SMS Masivos normales
   *
   * @return array<string>
   */

    public function setSmsSend($json,$msg) {

       $credenciales = $this->cParametros([
            'client_id'     => $this->clientId,
            'client_secret' => $this->clientSecret,
			'json'          => base64_encode(urlencode($json)),
			'msg'           => base64_encode(urlencode($msg)),
			'client_opcion' => 'send_sms'
       ]);

       return $resultData = parent::post('/controllersms/', $credenciales, 'application/x-www-form-urlencoded');
    }

  /**
   * Envio de SMS Masivos personalizados
   *
   * @return array<string>
   */
    public function setSmsSendPersonalizado($json){

       $credenciales = $this->cParametros([
            'client_id'     => $this->clientId,
            'client_secret' => $this->clientSecret,
			'json'          => base64_encode(urlencode($json)),
            'client_opcion' => 'send_sms_personalizado'
       ]);

       return $resultData = parent::post('/controllersms/', $credenciales, 'application/x-www-form-urlencoded');
    }

  /**
   *
   * @return array<string>
   */
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