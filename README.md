# Sobre la aplicación #

Chefmind es una aplicación desarrollada como proyecto final de Francisco Piaggio para la carrera Desarrollo web cursada en Escuela Davinci.

### Frameworks y requerimientos ###

* Laravel 5.7
* PHP >= 7.1.3
* OpenSSL PHP Extension
* PDO PHP Extension
* Mbstring PHP Extension
* Tokenizer PHP Extension
* XML PHP Extension
* Ctype PHP Extension
* JSON PHP Extension

### Setup ###

* Para instalar el proyecto primero debemos tener configurado composer:  
https://getcomposer.org/

* Pararse sobre el proyecto
```  
cd chefmind
```  

* Actualizar las dependencias de composer
```
composer install
```  

* Generar la key
```
php artisan key:generate
```  

* La base de datos debe llamarse "chefmind" como está configurado en el archivo /.env

* Para generar los datos de prueba correr el comando:  
```
php artisan migrate:refresh --seed
```

* Para iniciar el proyecto local sobre la raiz ejecutar:
```
php artisan serve
```



