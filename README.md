# CentauroSMS v1.2
API para integrar envió de SMS masivos en cualquier website. 

Para la integracion de la API en su website debe copiar la carpeta "lib" en el directorio de su sitio. 

Para obtener las credenciales para utilizar la API debe registrarse en http://www.centaurosms.com.ve

```php
#Include de la API de Centauro SMS PHP
include_once ("lib/centaurosms.php");
$SMS = new CentauroSMS('codigo_credencial', 'codigo_secreto_credencial');

#Para enviar un SMS normal (Mensaje unico para uno o varios remitentes) debe armar un JSON para enviarlo al 
#servidor con la siguiente estructura

$destinatarios = array("id" => "0","cel" => "04140000000","nom" => "Pedro Perez");	
$msg = 'Mensaje de prueba';
$js = json_encode($destinatarios);
$result = $SMS->set_sms_send($js,$msg); // Comando para enviar SMS Normales
echo json_encode($result);
```
Respuesta
```php
{"status":"200","response":[{"datos":[{"Nom":"Pedro Perez","Cel":"04140000000","Messageid":"7603178","StatusText":"Message accepted for delivery","Msg":"Mensaje de prueba"}]}]}
```
```php
array(2) {
  ["status"]=>
  string(3) "200"
  ["response"]=>
  array(1) {
    [0]=>
    array(1) {
      ["datos"]=>
      array(1) {
        [0]=>
        array(5) {
          ["Nom"]=>
          string(13) "Pedro Perez"
          ["Cel"]=>
          string(10) "4140000000"
          ["Messageid"]=>
          string(7) "8760365"
          ["StatusText"]=>
          string(29) "Message accepted for delivery"
          ["Msg"]=>
          string(29) "Mensaje de prueba"
        }
      }
    }
  }
}
```
###Tratamiento de la respuesta del servidor

```php
$result = $SMS->set_sms_send($js,$msg); // Comando para enviar SMS Normales

if ($result['status']=='200'){ // Donde 200 es el codigo de una conexion exitosa con el servidor
  // Variables
  $nombre = $result['response'][0]['datos'][0]['Nom'];
  $celular = $result['response'][0]['datos'][0]['Cel'];
  $Messageid = $result['response'][0]['datos'][0]['Messageid'];
  $StatusText = $result['response'][0]['datos'][0]['Messageid'];
  $Msg = $result['response'][0]['datos'][0]['Messageid'];
}
```

```php
# Otra forma de enviar SMS armando un String JSON
$js = '{"id":"0","cel":"04140000000","nom":"Pedro Perez"},{"id":"0","cel":"04240000000","nom":"Jose Perez"}';
$msg = 'Mensaje de prueba 2';
$result = $SMS->set_sms_send($js,$msg); // Comando para enviar SMS Normales varios destinatarios

```
