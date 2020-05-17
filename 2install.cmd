
@echo Un chmod a los windows sobre la carpeta public
icacls public /reset /t /c /q
@echo
@echo Creando archivo de configuración de Laravel: 'copy .env.example .env'
copy .env.example .env
@echo
@echo Creando un nuevo API Key: php artisan key:generate
php artisan key:generate
@echo
@echo instalando spatie: composer require spatie/laravel-permission
composer require spatie/laravel-permission
@echo
@echo Publicando migraciones para spatie
php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider" --tag="migrations"

