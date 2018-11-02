## Ejecución de la aplicación
Crear base de datos en Mysql llamada gestorurls (utf8_spanish2_ci)

# Crear base de datos
php artisan migrate:refresh

# Cargar datos
php artisan db:seed

    La carga inicial se hace a través del archivo urls.xlsx ubicado en public/excel