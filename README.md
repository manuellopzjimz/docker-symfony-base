# Symfony Docker

Configuración Docker para crear y arrancar proyectos Symfony junto a servicio BBDD y servidor SMTP fake para probar el envío de emails.

## Arranque

1. En un terminal ejecutamos `docker-compose up -d`.
2. En la aplicación Docker Desktop comprobamos que los contenedores se han creado correctamente y clickeamos sobre el contenedor que representa el servidor web PHP (debería aparecer con el nombre _php-1_ o similar) para ver sus logs. Esto lo haremos para ver si ya tenemos disponible la aplicación Symfony o está esperando al arranque de la BBDD para conectarse a ella.
3. Una vez haya arrancado la aplicación en el contenedor, accedemos a _https://localhost_ en nuestro navegador para comprobar que se renderiza la página estándar de Symfony error 404.
    1. Es posible que el navegador te diga que el certificado de _localhost_ no es seguro. Para ignorarlo, debe aparecerte un botón "Avanzado" o similar que cuando lo clickeas te muestra la opción "Continuar de todos modos".
4. El proyecto cuenta con dos controladores y una entidad ORM ejemplo para revisar que Doctrine puede crear tablas en la BBDD, Xdebug funciona correctamente y que nuestro contenedor fake SMTP recibe correos que enviemos desde la aplicación.

## Servicios 
El proyecto cuenta con los siguientes servicios:
- **php**: Servidor web que ejecutará la aplicación web Symfony. Puertos disponibles: **443** (HTTPS).
- **database**: BBDD PostgreSQL. Puerto disponible: **5432**
- **mailer**: Servidor SMTP fake para probar el envío de correos electrónicos. Puertos disponibles: **3000** (página web donde se pueden ver los correos) **2525** (SMTP).

## Depurar código con Xdebug y PHPStorm

Para depurar el código desde PHPStorm es necesario realizar los siguientes pasos:
1. En "Settings"/"Preferences" nos vamos a "PHP | Servers" y creamos un nuevo servidor.
   1. Nombre: El que prefieras.
   2. Host: localhost
   3. Puerto: 443
   4. Debugger: Xdebug
   5. Marca "Use path mappings"
   6. Añade "Absolute path on the server": /app
2. Una vez has creado el servidor, ve a "Run" y "Start listening for PHP Debug Connections".
3. Pon los puntos de ruptura que sean necesarios.
4. Accede desde el navegador a la ruta a probar añadiendo ?XDEBUG_SESSION=PHPSTORM al final.
5. PHPStorm debería detenerse en el punto de ruptura que estableciste con todo el contexto de la aplicación.

## Instalar dependencias al proyecto a través de Composer

Se recomienda usar el terminal del contenedor _php_ para instalar nuevas dependencias a través de Composer. Para ello se cliqueará en el contenedor en Docker Desktop. Primero nos mostrará los logs, pero tendremos disponible la pestaña template donde podremos introducir comandos. Si lanzamos desde ahí un _composer require_, el contenedor nos instalará la dependencia en la carpeta _vendor_ además de actualizar el fichero _composer.json_.
