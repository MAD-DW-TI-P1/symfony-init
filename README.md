<img src="https://jorgebenitezlopez.com/github/symfony.jpg">

# Symfony Init

Primeros pasos con Symfony

# Requisitos

- Symfony CLI: https://symfony.com/download
- PHP: PHP 8.2.3 (cli). Por ejemplo se puede descargar en OSX con: https://formulae.brew.sh/formula/php
- Composer: https://getcomposer.org/download/


# Pasos para la instalación de Symfomy y paquetes

- symfony new init --version=5.4
- composer require symfony/orm-pack (Sin docker)
- composer require symfony/maker-bundle
- composer require form validator twig-bundle security-csrf annotations


# Configuración y creación de entidades

- Modificamos el .env para que genere un sqlite (https://www.sqlite.org/index.html)
- php bin/console make:entity (Creamos la entidad coder)
- php bin/console doctrine:schema:update --force (Actualizamos la base de datos)
- php bin/console make:crud (Creamos el CRUD de coder)
- Añado Bootstrap en el base.html.twig
- Genero una página de inicio dinámica recuperando parámetros de la url
- Creo un controlador y devuelvo los datos de coder en formato JSON
 

# Rutas de la aplicación:

| URL path                    | Description           | 
| :--------------------------:|:---------------------:|
| /coder/                   |  Listado de coders| 
| /coder/new                     |  New coder               |
| /api                       |  Home                |
| /home/Jorge                        |  Home personalizada               |


# Referencias

https://symfony.com




