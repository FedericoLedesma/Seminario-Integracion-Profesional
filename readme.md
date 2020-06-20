<p align="center">
 <img src="images/unlu_logo.png" alt="Logo" width="160" height="160">
  <h1 align="center">Seminario de Integración Profesional (11087)</h1>
  <h2 align="center">Trabajo Práctico de Campo</h2>   
</p>


## Docentes
Mg. Bibiana Rossi <br/>
Lic. Viviana Chapetto <br/>
Lic. David Petrocelli <br/>

## Integrantes del grupo:
Larena Estaban Nicolás <br/>
Ledesma Arnaldo Federico <br/>
Cravero Cristian <br/>

## Acerca del proyecto

El proyecto fue desarrollado para el sector de nutrición del Hospital Nacional "Dr. Baldomero Sommer" ubicado en la localidad de General Rodríguez, Buenos Aires, Argentina.


### Objetivos alcanzados

 - Automatizar la integración de los datos recolectados por los nutricionistas a la hora de asignar el menú que va a recibir una persona durante el día.
 - Generar informes dirigidos hacia el personal que se encarga de preparar las raciones (personal de cocina), los cuales se harán de forma digital con la posibilidad de ser impresos.
 - Generar un informe anual con los insumos que se utilizaron a lo largo del año, con el objetivo de servir como guía para una compra (licitación) de alimentos. Dichos informes podrán ser anuales y mensuales.
 -	Además, el sistema ofrece una funcionalidad mínima para el alta y baja de pacientes o personal, con el fin de realizar el seguimiento de la alimentación recibida por los mismos.
-	Ofrecer al profesional de turno una recomendación de qué menú asignar a las personas que se encuentran en el hospital, según la disponibilidad de las raciones y lo que han consumido a lo largo de un periodo, también brinda información del historial nutricional de los pacientes.
-	El sistema lleva un control de stock diario de las raciones en sus respectivos horarios, registrando los movimientos que se hacen sobre las mismas.

## Herramientas utilizadas para el desarrollo
<br/>
<p align="center">
<img src="images/new-php-logo.png" alt="Logo" width="160" height="110"></img>
<img src="images/laravel_logo.svg" alt="Logo" width="300"></img>
<img src="images/mariadb_logo.svg" alt="Logo" width="300"></img>
<img src="images/bootstrap_logo.png" alt="Logo" width="160"></img>
<img src="images/adminlte_logo.svg" alt="Logo" width="300"></img>
</p>
## Demo

## Guía de instalación

- Clonar el repositorio utilizando `git clone https://github.com/FedericoLedesma/Seminario-Integracion-Profesional.git`
- Ejecutar `composer install` para instalar las dependencias
- Crear una base de datos con codificación `utf8mb4_general_ci` 
- Renombrar el archivo de configuración con el comando `copy .env.example .env` 
- Migrar la base de datos con `php artisan migrate` 
- Correr el seeder **DatabaseSeeder.php** con el comando `php artisan db:seed--class=DatabaseSeeder`
- Levantar el servidor u `php artisan serve`


## Manual de usuario

## Screenshots

## Licencia

The Laravel framework is open-source software licensed under the [MIT license](https://opensource.org/licenses/MIT).
