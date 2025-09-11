# Metodología de trabajo colaborativo

> Cuándo estemos en un equipo de desarrollo
> dónde hay varios miembros (programadores) que trabajamos en el mismo proyecto
> no se suele crear un proyecto por cada uno de los miembros del equipo
> Si somos cinco desarrolladores en este proyecto, no se hacen cinco instalaciones completas

1. solamente uno (un programador) genera la instalación inicial del proyecto
2. Éste crea las migraciones
3. También crea los Seeders
4. También instala paquetes necesarios
5. Copia los archivos que no vayan a ser procesados por Laravel
6. Copia las vistas con sus layouts y componentes
7. Una vez listo lo sube a un repositorio

> Luego el resto de los miembros del equipo de desarrollo clona el repositorio
> Y de esta manera ya tiene listo el Setup inicial del proyecto

## Si no sé usar git
> Si no se usar git, igualmente puedo descargar un proyecto desde Github
> en la rama correspondiente, pulsamos el botón que dice "Code"
> va a parecer un desplegable
> seleccionamos el enlace que dice "Download ZIP"
> se descomprimirá una carpeta con el nombre "repositorio-rama"
> en nuestro caso el nombre de la carpeta es: "CatalogoMVC-catalogo"
> Lo único que nos interesa de esta carpeta es el proyecto en sí, es decir: la carpeta llamada "catalogo"

## Si sé usar git
> Clonamos el proyecto con el comando

`git clone url`

> en nuestro caso sería: 

    git clone https://github.com/jahcr1/CatalogoMVC.git

> Si necesitamos una rama específica, una vez clonado el proyecto, nos movemos a la raiz del proyecto
> en nuestro caso la carpeta "catalogo" que esta dentro de CatalogoMVC

    cd catalogo

> Una vez dentro de la carpeta del proyecto podemos ver
> las ramas remotas que existen y nos movemos a la rama que necesitemos.
> En caso de que existan, esto lo podemos hacer así: 

    git branch -r

> y luego nos movemos a la rama en la cual querramos trabajar ( en este caso, la rama default es catalogo)

    git checkout nombre-de-la-rama

## Actualizando el proyecto
> Si ahora intento correr el proyecto me va a dar error
> el asunto es que no está y corazón del proyecto: la carpeta "vendor"
> ni tampoco el archivo .env
>
> Nos movemos a la carpeta "catalogo" y corremos el siguiente comando

    composer install  

> ¿con esto ya está todo listo? aún no
> El próximo paso es crear el archivo .env y configurarlo
> y no debemos olvidar generar la llave

## Configuración de entorno
> Copiamos el archivo de ejemplo .env.example para crear .env

    cp .env.example .env

> Luego editamos las variables necesarias (DB, cache, etc)
> No debemos olvidar generar la clave de la aplicación
>
> Creación de llave

    php artisan key:generate  

## Migraciones y Seeders (correr migraciones)
> Migraciones

    php artisan migrate

> Esto ejecuta todas las migraciones pendientes y crea/actualiza tablas.

> Seeders (insercion de datos en las tablas)

    php artisan db:seed

> Ejecuta el DatabaseSeeder, que a su vez puede llamar a varios seeders (ej: categorías, productos).

> Si no se configuró el DatabaseSeeder con seeders, entonces podemos
> correr cada seeder uno a uno de la siguiente forma:

    php artisan db:seed --class=Nombre1Seeder

> y los que necesitemos:

    php artisan db:seed --class=Nombre2Seeder

> Esto salta el DatabaseSeeder y ejecuta únicamente ese seeder en particular.

> Si quisieramos hacer Migraciones y correr seeders todo de una
> podriamos hacer:

    php artisan migrate --seed

> Corre migraciones y luego el DatabaseSeeder.
> Útil cuando recién clonas el proyecto por primera vez.


## Ejecutando el proyecto con assets de VITE

    composer run dev  
