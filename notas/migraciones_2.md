<img src="imagenes/laravel-eloquent-orm.png">

# Modelos + flags

## Generación de un modelo: 
    php artisan make:model Nombre -mcrs

## Ejecución: 

1. correr migraciones
2. correr seeders

### Opción a (si existen seeders)

    php artisan db:seed --class=CategoriaSeeder  
    php artisan db:seed --class=ProductoSeeder

### Opción b ( Modificar DatabaseSeeder.php)
> en DatabaseSeeder.php (en database/seeders/DatabaseSeeder.php), agregar:

        $this->call([
            Model1Seeder::class,
            Model2Seeder::class,
            Model3Seeder::class
        ]);

> en terminar ejecutar el siguiente comando que ejecuta el DatabaseSeeder
> y llena las tablas con las migraciones configuradas: 

    php artisan db:seed 