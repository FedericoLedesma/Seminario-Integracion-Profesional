composer install
composer require spatie/laravel-permission
php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider" --tag="migrations"
php artisan migrate
php artisan migrate --seed
php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider" --tag="config"
