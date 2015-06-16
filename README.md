# CentauroSMS v1.2
API para integrar envió de SMS masivos en cualquier website. 

Para la integracion de la API en su website debe copiar la carpeta "lib" en el directorio de su sitio. 

Para obtener las credenciales para utilizar la API debe registrarse en http://www.centaurosms.com.ve

```php
#Include de la API de Centauro SMS PHP
include_once ("lib/centaurosms.php");
$SMS = new CentauroSMS('codigo_credencial', 'codigo_secreto_credencial');

#Para enviar un SMS normal (Mensaje unico para uno o varios remitentes) debe armar un JSON para enviarlo al Servidor con la siguiente estructura

```
