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
          string(7) "7603178"
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

### Otra forma de enviar SMS con string JSON a varios destinatarios
```php
# Otra forma de enviar SMS armando un String JSON
$js = '{"id":"0","cel":"04140000000","nom":"Pedro Perez"},{"id":"0","cel":"584240000000","nom":"Jose Perez"}';
$msg = 'Mensaje de prueba 2';
$result = $SMS->set_sms_send($js,$msg); // Comando para enviar SMS Normales varios destinatarios

```
Respuesta
```php
{"status":"200","response":[{"datos":[{"Nom":"Pedro Perez","Cel":"4140000000","Messageid":"7603178","StatusText":"Message accepted for delivery","Msg":"Mensaje de prueba"},{"Nom":"Jose Perez","Cel":"4240000000","Messageid":"7603179","StatusText":"Message accepted for delivery","Msg":"Mensaje de prueba"}]}]}
```
```php
array(2) {
  ["status"]=>
  string(3) "200"
  ["response"]=>
  array(2) {
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
          string(7) "7603178"
          ["StatusText"]=>
          string(29) "Message accepted for delivery"
          ["Msg"]=>
          string(29) "Mensaje de prueba"
        }
      }
    }
    [1]=>
    array(1) {
      ["datos"]=>
      array(1) {
        [0]=>
        array(5) {
          ["Nom"]=>
          string(13) "Jos Perez"
          ["Cel"]=>
          string(10) "4240000000"
          ["Messageid"]=>
          string(7) "7603179"
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
Nota: Todos los numeros enviados al servidor en un formato valido, se devuelven en forma limpia, ejemplo 584140000000 a 4140000000

### Envio de SMS personalizados con nuevo comando un destinatario

El comando set_sms_send_personalizado solo esta disponible en la version 1.2 de la API si usted dispone de la version anterior le recomendamos actualizar el archivo para poder hacer uso del comando.

```php
#Include de la API de Centauro SMS PHP
include_once ("lib/centaurosms.php");
$SMS = new CentauroSMS('codigo_credencial', 'codigo_secreto_credencial');

$destinatarios = array("id" => "0","cel" => "04140000000","nom" => "Pedro Perez","msg" => "Mensaje Personalizado");	
$js = json_encode($destinatarios);
$result = $SMS->set_sms_send_personalizado($js); // Comando para enviar SMS Personalizados
echo json_encode($result);
```
Respuesta
```php
{"status":"200","response":[{"datos":[{"Nom":"Pedro Perez","Cel":"04140000000","Messageid":"7603178","StatusText":"Message accepted for delivery","Msg":"Mensaje Personalizado"}]}]}
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
          string(7) "7603178"
          ["StatusText"]=>
          string(29) "Message accepted for delivery"
          ["Msg"]=>
          string(29) "Mensaje Personalizado"
        }
      }
    }
  }
}
```
### Otra forma de enviar SMS con string JSON nuevo comando a varios destinatarios
```php
# Otra forma de enviar SMS armando un String JSON
$js = '{"id":"0","cel":"04140000000","nom":"Pedro Perez","msg":"Mensaje personalizado para Pedro"},{"id":"0","cel":"584240000000","nom":"Jose Perez","msg":"Mensaje personalizado para Jose"}';
$result = $SMS->set_sms_send_personalizado($js); // Comando para enviar SMS Normales varios destinatarios

```
Respuesta
```php
{"status":"200","response":[{"datos":[{"Nom":"Pedro Perez","Cel":"4140000000","Messageid":"7603178","StatusText":"Message accepted for delivery","Msg":"Mensaje personalizado para Pedro"},{"Nom":"Jose Perez","Cel":"4240000000","Messageid":"7603179","StatusText":"Message accepted for delivery","Msg":"Mensaje personalizado para Pedro"}]}]}
```
```php
array(2) {
  ["status"]=>
  string(3) "200"
  ["response"]=>
  array(2) {
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
          string(7) "7603178"
          ["StatusText"]=>
          string(29) "Message accepted for delivery"
          ["Msg"]=>
          string(29) "Mensaje personalizado para Pedro"
        }
      }
    }
    [1]=>
    array(1) {
      ["datos"]=>
      array(1) {
        [0]=>
        array(5) {
          ["Nom"]=>
          string(13) "Jos Perez"
          ["Cel"]=>
          string(10) "4240000000"
          ["Messageid"]=>
          string(7) "7603179"
          ["StatusText"]=>
          string(29) "Message accepted for delivery"
          ["Msg"]=>
          string(29) "Mensaje personalizado para Jose"
        }
      }
    }    
  }
}
```

Tratamiento de la respuesta del servidor

```php
$result = $SMS->set_sms_send($js,$msg); // Comando para enviar SMS Normales

if ($result['status']=='200'){ // Donde 200 es el codigo de una conexion exitosa con el servidor
  // Variables
  $nombre = $result['response'][0]['datos'][0]['Nom'];
  $celular = $result['response'][0]['datos'][0]['Cel'];
  $Messageid = $result['response'][0]['datos'][0]['Messageid'];
  $StatusText = $result['response'][0]['datos'][0]['StatusText'];
  $Msg = $result['response'][0]['datos'][0]['Msg'];
}
```
