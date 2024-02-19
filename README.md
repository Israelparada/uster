Posterior a montar el ambiente correspondiente: 
  * PHP 8.1.12
  * Symfony 5.8.8
  * Ubuntu 23.04
  * MySQL(Mariadb 10.11.2
Crear el proyecto en symfony:  composer create-project symfony/website-skeleton uster
Iniciar con la creacion de la base de datos.
  Se uso el comando php bin/console make:entity para la creación de las entidades, inicialmente la idea era que una vez creada la base de datos se ejecutara el comando "php bin/console doctrine:mapping:import App\\Entity annotation --path=src/Entity"
  pero para esta version de symfony ya esta descontinuada la instrucción import de doctrine.

Concluida la creación de las entidades se continuo con la creacion de los crud Vehicles y Drivers.

Para la parte del front se uso twig, solo la parte funcional, no se incursiono en la parte estetica.

Se continuo con la creacion de cun contralador para la parte de la asignacion de los viajes (trips) se pretendia agregar validaciones de campos y tipo de datos pero se dejo para el final.

El ultimo paso realizado fue la selección de la fecha para asignar conductor y vehiculo, sin embargo no se logro concluir con el desarrollo por falta de tiempo.

De antemano gracias por su tiempo.
  
