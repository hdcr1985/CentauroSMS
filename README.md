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

$destinatarios = array("id" => "0","cel" => "Pedro Perez","nom" => "04140000000");	
$msg = 'Mensaje de prueba';
$js = json_encode($destinatarios);
$result = $SMS->set_sms_send($js,$msg); // Comando para enviar SMS Normales

```
Respuesta
```php
#Include de la API de Centauro SMS PHP
include_once ("lib/centaurosms.php");
$SMS = new CentauroSMS('codigo_credencial', 'codigo_secreto_credencial');

#Para enviar un SMS normal (Mensaje unico para uno o varios remitentes) debe armar un JSON para enviarlo al 
#servidor con la siguiente estructura

$destinatarios = array("id" => "0","cel" => "Pedro Perez","nom" => "04140000000");	
$msg = 'Mensaje de prueba';
$js = json_encode($destinatarios);
$result = $SMS->set_sms_send($js,$msg); // Comando para enviar SMS Normales

# Otra forma de enviar SMS armando un String JSON
$js = '{"id":"0","cel":"04140000000","nom":"Pedro Perez"},{"id":"0","cel":"04240000000","nom":"Jose Perez"}';
$msg = 'Mensaje de prueba 2';
$result = $SMS->set_sms_send($js,$msg); // Comando para enviar SMS Normales varios destinatarios

```
