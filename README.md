# Para bajar el proyecto:

# git clone https://github.com/micaelapetterson/segurarseback.git 
# acceder al repositorio. (En este caso segurarseback) 
# Crear el archivo .env en raíz del proyecto.
# Crear una base de datos para el proyecto.

# Apuntar a la base de datos en el archivo .env. Por ejemplo:

# DB_CONNECTION=mysql
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=segurarsedb // Aquí se configuraria el nombre de la base.
# DB_USERNAME=root
# DB_PASSWORD=

# Correr el siguiente comando en la raíz:
# composer install
# Luego:
# php artisan key:generate
# Luego:
# php artisan migrate
# php artisan db:seed
# ó
# php artisan migrate:refresh --seed

# php artisan serve

# Se pueden realizar pruebas desde vscode, instalando la extensión REST Client
# Luego se dirige a tests/tests/auth.rest
# utiliza "Send Request" en ### login
# Y obtiene el token que utilizará para probar las demás funciones.

# Laravel Framework 9.52.16
# PHP 8.0.28
