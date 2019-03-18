##David Raga Renteria

## Test-macasoft

## Prueba técnica de macasoft

Ejecutar el comando 

*        php artisan passport:install
Luego ejecutar el comando
*        php artisan migrate:refresh --seed

Se creará un usuario administrador con las siguientes credenciales : </br>
email: macasoft@example.com </br>
password: password</br>


##Nota

Unicamente puede acceder a las rutas el <strong>Administrador</strong> </br>

## Rutas de la api


*        /api/auth/users/login    //Para loguearse  //POST con los datos de session, si no estás logueado no puedes acceder a las otras rutas
*        /api/auth/users          //Obtener los usuarios  //GET  
*        /api/auth/users/{id}     //Obtener los usuarios por id  //GET
*        /api/auth/users           // para agregar usuario  //POST con los datos que se quieren registrar
*        /api/auth/users/{id}      //para editar usuario  //PUT  Enviar los datos que se quieren editar
*        /api/auth/users/{id}      //para editar usuario  //DELETE  id del usuario que se quiere eliminar
*        /api/auth/usersNombre/{nombre}  //obtener usuarios por nombre  //GET 
*        /api/auth/usersRole/{rol}  //obtener usuarios por rol  //GET 


*        /api/auth/roles/       //obtener los roles  //GET 
*        /api/auth/roles/{id}   //obtener los roles por id  //GET 
*        /api/auth/roles/       //para registrar roles  //POST con los datos a registrar 
*        /api/auth/roles/{id}     //para eliminar roles  //DELETE


 


