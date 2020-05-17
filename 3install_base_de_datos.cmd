@echo
@echo Por favor configure el archivo .env
@echo debe modificar su usario y contraseña de la base de datos.
@echo campos:
@echo DB_HOST=localhost
@echo DB_DATABASE=tu_base_de_datos
@echo DB_USERNAME=root
@echo DB_PASSWORD=contraseña_de_root
@echo luego agregue las siguientes lineas al archivo app\Providers\AppServiceProvider.php
@echo use Illuminate\Support\Facades\Schema;

@echo public function boot()
@echo {
@echo     Schema::defaultStringLength(191);
@echo }
@echo
@echo pulse cualquier tecla una vez haya modificado el archivo .env...
pause
 
@echo Migrando base de datos: php artisan migrate 
php artisan migrate:fresh --seed

@echo Configurando migraciones para spatie
php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider" --tag="config"