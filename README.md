## CentauroSMS v2.0

API para integrar envío de SMS masivos en cualquier website. 

Actualización: Para que los ejemplos puedan funcionar sin ningun problema su servidor local o hosting debe tener activadas las librerias cURL.

Para obtener las credenciales para utilizar la API debe registrarse en http://www.centaurosms.com.ve 
y poseer un plan de SMS activo, validos para Venezuela ó Colombia.


### Instalación

Agregar lo siguiente en su archivo `composer.json`

```json
    "require": {
        "centauro-sms/centauro-sms": "dev-master"
    }
``` 


```php
//Include de la API de Centauro SMS PHP
<?php

require 'vendor/autoload.php';

use centauroSMS\Api;

try{

  $api = new Api('id_credencial','codigo_secreto_credencial');
  
}catch(\centauroSMS\Exceptions\BaseException $e){

  echo $e->getMessage(); // manejar el error
}

//Para enviar un SMS normal (Mensaje unico para uno o varios remitentes) debe armar un JSON para enviarlo al 
//servidor con la siguiente estructura

$destinatarios = ["id" => "0","cel" => "04140000000","nom" => "Pedro Perez"];	

$msg    = 'Mensaje de prueba';
$js     = json_encode($destinatarios);
$result = $api->setSmsSend($js,$msg); // Comando para enviar SMS Normales

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
// Otra forma de enviar SMS armando un String JSON
$js     = '{"id":"0","cel":"04140000000","nom":"Pedro Perez"},{"id":"0","cel":"584240000000","nom":"Jose Perez"}';
$msg    = 'Mensaje de prueba 2';
$result = $api->setSmsSend($js,$msg); // Comando para enviar SMS Normales varios destinatarios

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

El comando `setSmsSendPersonalizado` solo esta disponible en la version 1.2 de la API si usted dispone de la version anterior le recomendamos actualizar el archivo para poder hacer uso del comando.

```php


$destinatarios = ["id" => "0","cel" => "04140000000","nom" => "Pedro Perez","msg" => "Mensaje Personalizado"];	

$js      = json_encode($destinatarios);
$result  = $api->setSmsSendPersonalizado($js); // Comando para enviar SMS Personalizados

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
// Otra forma de enviar SMS armando un String JSON
$js = '{"id":"0","cel":"04140000000","nom":"Pedro Perez","msg":"Mensaje personalizado para Pedro"},{"id":"0","cel":"584240000000","nom":"Jose Perez","msg":"Mensaje personalizado para Jose"}';

$result = $api->setSmsSendPersonalizado($js); // Comando para enviar SMS Normales varios destinatarios

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
### Acceder a la cantidad de SMS disponibles

```php

$api_disponibles = $api->getSmsDisponibles(); 

echo $api_disponibles['response']['sms_disponibles'];
```
Respuesta

```php
{"status":"200","response":{"sms_disponibles":"500"}}
```

```php
array(2) {
  ["status"]=>
  string(3) "200"
  ["response"]=>
  array(1) {
    ["sms_disponibles"]=>
    string(4) "500"
  }
}
```

### Tratamiento de la respuesta del servidor

```php
$result = $api->setSmsSend($js,$msg); // Comando para enviar SMS Normales
$result = $api->setSmsSendPersonalizado($js); // Comando para enviar SMS Personalizados

if ($result['status']=='200'){ // Donde 200 es el codigo de una conexion exitosa con el servidor
  // Variables
  $nombre = $result['response'][0]['datos'][0]['Nom'];
  $celular = $result['response'][0]['datos'][0]['Cel'];
  $Messageid = $result['response'][0]['datos'][0]['Messageid'];
  $StatusText = $result['response'][0]['datos'][0]['StatusText'];
  $Msg = $result['response'][0]['datos'][0]['Msg'];
}
```

### Codigos de respuesta del servidor

```php
if ($result['status']=='305'){ echo "No tiene SMS disponibles para realizar este envio";}
if ($result['status']=='304'){ echo "Los parametros no son correctos por favor no modifique la API";}
if ($result['status']=='303'){ echo "Error grave no se recibio parametro de la API";}
if ($result['status']=='302'){ echo "Servidores fuera de linea";}
if ($result['status']=='301'){ echo "Error de credenciales";}
if ($result['status']=='300'){ echo "No se recibieron los parametros necesarios";}

```

JSON Respuesta de error

```json

{"status":"305","response":{"error":"No tiene SMS disponibles para realizar este envio"}}
{"status":"304","response":{"error":"Los parametros no son correctos por favor no modifique la API"}}
{"status":"303","response":{"error":"Error grave no se recibio parametro de la API"}}
{"status":"302","response":{"error":"Servidores fuera de linea"}}
{"status":"301","response":{"error":"Error de credenciales"}}
{"status":"300","response":{"error":"No se recibieron los parametros necesarios"}}

```

ARRAY Respuesta de error

```php

array(2) {
  ["status"]=>
  string(3) "305"
  ["response"]=>
  array(1) {
    ["error"]=>
    string(21) "No tiene SMS disponibles para realizar este envio"
  }
}

array(2) {
  ["status"]=>
  string(3) "304"
  ["response"]=>
  array(1) {
    ["error"]=>
    string(21) "Los parametros no son correctos por favor no modifique la API"
  }
}

array(2) {
  ["status"]=>
  string(3) "303"
  ["response"]=>
  array(1) {
    ["error"]=>
    string(21) "Error grave no se recibio parametro de la API"
  }
}

array(2) {
  ["status"]=>
  string(3) "302"
  ["response"]=>
  array(1) {
    ["error"]=>
    string(21) "Servidores fuera de linea"
  }
}

array(2) {
  ["status"]=>
  string(3) "301"
  ["response"]=>
  array(1) {
    ["error"]=>
    string(21) "Error de credenciales"
  }
}

array(2) {
  ["status"]=>
  string(3) "300"
  ["response"]=>
  array(1) {
    ["error"]=>
    string(21) "No se recibieron los parametros necesarios"
  }
}
```
