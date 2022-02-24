Instrucciones

- clonar repositorio
- composer install
- yarn
- yarn run dev
- copy .env.example .env
- agregar las credenciales de Bd en el .env
- php artisan key:generate
- php artisan migrate:fresh --seed

- claves de acceso a la app
  - user: admin@claroinsurance.com
  - pass: $22PaClaro$0**

Objetivos Logrados:

- Modulo de Usuarios Funcional,
- Validacion de datos según lo solicitado
- Campos Select dinamicos para la seleccion de pais, estado, ciudad.
- Validación de datos de acceso
- Activación parcial del control de permisos.

Objetivos Pendientes:

- Modulo Mail
- Restriccion de permisos
- Modulo de Roles/Permisos
