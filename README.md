

# Shoppless


Creación de una SPA  para consumir API para compra de productos, registro de usuarios administradores y clientes, gestión de productos y gestión de inventario

Requerimientos para la prueba.

Tener instalado:

-Composer
-nodejs

[API documentacion](https://documenter.getpostman.com/view/3605815/SVzz1yWH)

Tecnologias:

 - Laravel 6.4
 - TailWind Css 0.7
 - Vue 2.0
 - tymon/jwt-auth 1.0.0

Instalacion

 - crear archivo .env y copiar contenido del archivo .env.example
 - crear base de datos de mysql
 - modificar los siguientes campos el archivo .env con las credenciales de la base de datos creada
 
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=laravel
    DB_USERNAME=root
    DB_PASSWORD=
    
 Acceder a la carpeta del proyecto desde la terminar y ejecutar los siguientes comandos.
 
 - Composer install
 - npm install
 - npm run dev
 - php artisan jwt:secret
 - php artisan key:generate
 - php artisan migrate:refresh --seed 
 
 Uso
 
 Para levantar la aplicacion se puede utilizar el siguiente comando
 
 php asrtisan verve deberia de levantar la aplicacion en la siguiente url
 
 http://127.0.0.1:8000/
 
 Ruta base de la API http://127.0.0.1:8000/api/register
 
 Ruta base de la Aplicacion Web http://127.0.0.1:8000/
 

 Para probar la API adjunto al inicio la documentacion de esta de como se puede consumir desde una aplicacion como Postman o desde la terminar con curl, siempre y cuando este arriba la aplicacion.
 
