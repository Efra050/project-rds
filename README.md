Requisitos del equipo Para usar este proyecto:

 * PHP 8.4.22 o superior
 * Composer 2.8.10 o superior, para instalar dependencias de Laravel
 * Node.js y npm
 * MySQL 8.0 o superior, para la base de datos
 * curl, para probar los endpoints de la API desde la terminal
 * Laravel 13.14.0
 * Laravel Sanctum 3.2.0, para autenticación de API
 > Este proyecto usa Laravel 13.8 y Laravel Sanctum para autenticación de API.

## 2. Instalación básica

Desde la carpeta del proyecto

bash: 
 * git clone https://github.com/Efra050/project-rds.git
 * cd "proyecto_rds"
 * composer install
 * cp .env.example .env
 * php artisan key:generate


Configura tu base de datos en el archivo .env:
* DB_CONNECTION=mysql
* DB_HOST=127.0.0.1
* DB_PORT=3306
* DB_DATABASE=db_3066552
* DB_USERNAME=root
* DB_PASSWORD=0000


Luego ejecuta migraciones:

bash: 
* php artisan migrate:fresh --seed
* php artisan migrate


Si quieres usar los scripts de frontend o pruebas locales también puedes instalar dependencias de Node:

bash:
* npm install
* npm run build


## 3. Iniciar el servidor

bash:
php artisan serve
 
El servidor se ejecutará en:

- http://127.0.0.1:8000



## 4. Autenticación con token (Sanctum)

Generar token desde la API
Endpoint público:

http POST /api/login


Ejemplo con `curl`:

bash:
curl -X POST http://127.0.0.1:8000/api/login \
  -H "Content-Type: application/json" \
  -d '{"email":"efra@example.com","password":"efrain12345"}'


Respuesta:

json:
{
  "token": "TU_TOKEN_AQUI"
}

---Usar el token en las solicitudes

Todos los endpoints protegidos requieren el encabezado:

http
Authorization: Bearer TU_TOKEN_AQUI


## 5. Endpoints de usuario

* GET /api/user - Devuelve los datos del usuario autenticado en la sesión actual.
* GET /api/users - Lista todos los usuarios.
* GET /api/users/{id} - Muestra un usuario por ID.
* POST /api/users - Crea un nuevo usuario.
* PUT /api/users/{id} - Actualiza un usuario existente.
* DELETE /api/users/{id} - Elimina un usuario.

## 6. Endpoints de recursos disponibles

Estos endpoints sí están disponibles y requieren token:

 * GET /api/cargos
 * GET /api/cargos/{id}
 * POST /api/cargos
 * PUT /api/cargos/{id}
 * DELETE /api/cargos/{id}

 * GET /api/empleados
 * GET /api/empleados/{id}
 * POST /api/empleados
 * PUT /api/empleados/{id}
 * DELETE /api/empleados/{id}

 * GET /api/funciones-cargos
 * GET /api/funciones-cargos/{id}
 * POST /api/funciones-cargos
 * PUT /api/funciones-cargos/{id}
 * DELETE /api/funciones-cargos/{id}

## 7. Ejemplos con (curl)

---Obtener token

bash:
curl -X POST http://127.0.0.1:8000/api/login \
  -H "Content-Type: application/json" \
  -d '{"email":"efra@example.com","password":"efrain12345"}'


---Ver usuario autenticado

bash:
curl -H "Authorization: Bearer TU_TOKEN_AQUI" http://127.0.0.1:8000/api/user


--- Listar usuarios

bash:
curl -H "Authorization: Bearer TU_TOKEN_AQUI" http://127.0.0.1:8000/api/users


--- Crear usuario

bash:
curl -X POST http://127.0.0.1:8000/api/users \
  -H "Content-Type: application/json" \
  -H "Authorization: Bearer TU_TOKEN_AQUI" \
  -d '{"name":"Nuevo Usuario","email":"nuevo@example.com","password":"password123"}'


--- Actualizar usuario

bash:
curl -X PUT http://127.0.0.1:8000/api/users/1 \
  -H "Content-Type: application/json" \
  -H "Authorization: Bearer TU_TOKEN_AQUI" \
  -d '{"name":"Usuario Actualizado","email":"actualizado@example.com"}'


--- Eliminar usuario

bash:
curl -X DELETE http://127.0.0.1:8000/api/users/1 \
  -H "Authorization: Bearer TU_TOKEN_AQUI"


--- Listar cargos

bash:
curl -H "Authorization: Bearer TU_TOKEN_AQUI" http://127.0.0.1:8000/api/cargos


--- Crear cargo

bash:
curl -X POST http://127.0.0.1:8000/api/cargos \
  -H "Content-Type: application/json" \
  -H "Authorization: Bearer TU_TOKEN_AQUI" \
  -d '{"nombre_cargo":"Gerente","descripcion":"Descripción del cargo"}'


--- Actualizar cargo

bash:
curl -X PUT http://127.0.0.1:8000/api/cargos/1 \
  -H "Content-Type: application/json" \
  -H "Authorization: Bearer TU_TOKEN_AQUI" \
  -d '{"descripcion":"Descripción actualizada"}'


--- Eliminar cargo

bash:
curl -X DELETE http://127.0.0.1:8000/api/cargos/1 \
  -H "Authorization: Bearer TU_TOKEN_AQUI"


--- Listar empleados

bash:
curl -H "Authorization: Bearer TU_TOKEN_AQUI" http://127.0.0.1:8000/api/empleados


--- Crear empleado

bash:
curl -X POST http://127.0.0.1:8000/api/empleados \
  -H "Content-Type: application/json" \
  -H "Authorization: Bearer TU_TOKEN_AQUI" \
  -d '{"cargo_id":1,"nombre":"Juan","apellido":"Pérez","fecha_nacimiento":"1990-01-01","fecha_ingreso":"2024-01-01","salario":1200.50,"estado":true}'


--- Actualizar empleado

bash:
curl -X PUT http://127.0.0.1:8000/api/empleados/1 \
  -H "Content-Type: application/json" \
  -H "Authorization: Bearer TU_TOKEN_AQUI" \
  -d '{"salario":1300.75,"estado":false}'


--- Eliminar empleado

bash:
curl -X DELETE http://127.0.0.1:8000/api/empleados/1 \
  -H "Authorization: Bearer TU_TOKEN_AQUI"


--- Listar funciones de cargo

bash
curl -H "Authorization: Bearer TU_TOKEN_AQUI" http://127.0.0.1:8000/api/funciones-cargos


--- Crear función de cargo

bash:
curl -X POST http://127.0.0.1:8000/api/funciones-cargos \
  -H "Content-Type: application/json" \
  -H "Authorization: Bearer TU_TOKEN_AQUI" \
  -d '{"cargo_id":1,"descripcion_funcion":"Nueva función","estado":true}'


--- Actualizar función de cargo

bash:
curl -X PUT http://127.0.0.1:8000/api/funciones-cargos/1 \
  -H "Content-Type: application/json" \
  -H "Authorization: Bearer TU_TOKEN_AQUI" \
  -d '{"descripcion_funcion":"Función actualizada","estado":false}'


--- Eliminar función de cargo

bash:
curl -X DELETE http://127.0.0.1:8000/api/funciones-cargos/1 \
  -H "Authorization: Bearer TU_TOKEN_AQUI"

