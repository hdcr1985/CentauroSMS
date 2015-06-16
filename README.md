# CentauroSMS v1.2
API para integrar envió de SMS masivos en cualquier website. 

Para la integracion de la API en su website debe copiar la carpeta "lib" en el directorio de su sitio. 

Para obtener las credenciales para utilizar la API debe registrarse en http://www.centaurosms.com.ve

```php
#Include de la API de Centauro SMS
include_once ("lib/centaurosms.php");
$SMS = new CentauroSMS('user_credencial', 'secret_credencial');

```
