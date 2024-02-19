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

Se continuo con la creacion de un contralador para la parte de la asignacion de los viajes (trips) se pretendia agregar validaciones de campos y tipo de datos pero se dejo para el final.

El ultimo paso realizado fue la selección de la fecha para asignar conductor y vehiculo, sin embargo no se logro concluir con el desarrollo por falta de tiempo.

De antemano gracias por su tiempo.

La url: http://localhost/uster/public/index.php/
![Captura desde 2024-02-18 23-04-00](https://github.com/Israelparada/uster/assets/26722859/7e21c064-ae2a-40fa-8620-4eb4c8e0844a)
![Captura desde 2024-02-18 23-05-06](https://github.com/Israelparada/uster/assets/26722859/28c6dc3c-3b5c-4c06-8839-5801829946a8)
![Captura desde 2024-02-18 23-05-34](https://github.com/Israelparada/uster/assets/26722859/61c4e4c1-4adb-4c6e-92b0-ec5bb5ba4a8e)
![imagen](https://github.com/Israelparada/uster/assets/26722859/ff890159-2e63-45a2-a34f-4702245bb71e)
![imagen](https://github.com/Israelparada/uster/assets/26722859/4f24adf0-929f-4b19-be65-76d645e5bd19)

