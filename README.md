# proyecto_rds

## 1. Requisitos

Para usar este proyecto necesitas:

* PHP 8.4 o superior
* Composer 2.8 o superior
* MySQL 8.0 o superior
* Node.js y npm 
* curl para probar la API desde la terminal
* Laravel 13.x
* Laravel Sanctum para autenticación de API

## 2. Instalación

Desde la carpeta del proyecto, ejecuta:

bash:

composer install
cp .env.example .env
php artisan key:generate

Configura tu base de datos en .env:

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=db_3066552
DB_USERNAME=root
DB_PASSWORD=(contraseña de tu MySQL)

Luego ejecuta las migraciones y los seeders:

bash
php artisan migrate:fresh --seed
php artisan migrate

Si necesitas assets o pruebas de Node, instala dependencias de frontend:

bash:

npm install
npm run build

## 3. Ejecutar el servidor

Inicia Laravel con:

bash
php artisan serve

El servidor se ejecutará en:

* http://127.0.0.1:8000

## 4. Autenticación con Sanctum

### 4.1 Obtener token

Haz login con el endpoint público /api/login:

bash:

curl -X POST http://127.0.0.1:8000/api/login \
  -H "Content-Type: application/json" \
  -d '{"email":"efra@example.com","password":"efrain12345"}'

Respuesta esperada:

json
{
  "token": "TU_TOKEN_AQUI"
}

### 4.2 Usar el token en Insomnia o curl

En Insomnia agrega el header:

Authorization: Bearer TU_TOKEN_AQUI

Con curl:

bash:

curl -H "Authorization: Bearer TU_TOKEN_AQUI" http://127.0.0.1:8000/api/user

## 5. Endpoints de usuario

* GET /api/user - Devuelve los datos del usuario autenticado.
* GET /api/users - Lista usuarios paginados.
* GET /api/users/{id} - Muestra un usuario por ID.
* POST /api/users - Crea un usuario.
* PUT /api/users/{id} - Actualiza un usuario.
* DELETE /api/users/{id} - Elimina un usuario.

## 6. Endpoints de recursos

Todos los siguientes endpoints requieren token:

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

## 7. Ejemplos de uso

### 7.1 Obtener token

bash
curl -X POST http://127.0.0.1:8000/api/login \
  -H "Content-Type: application/json" \
  -d '{"email":"efra@example.com","password":"efrain12345"}'

### 7.2 Ver usuario autenticado

bash
curl -H "Authorization: Bearer TU_TOKEN_AQUI" http://127.0.0.1:8000/api/user

### 7.3 Listar usuarios

bash
curl -H "Authorization: Bearer TU_TOKEN_AQUI" http://127.0.0.1:8000/api/users

### 7.4 Crear usuario

bash
curl -X POST http://127.0.0.1:8000/api/users \
  -H "Content-Type: application/json" \
  -H "Authorization: Bearer TU_TOKEN_AQUI" \
  -d '{"name":"Nuevo Usuario","email":"nuevo@example.com","password":"password123"}'

### 7.5 Actualizar usuario

bash
curl -X PUT http://127.0.0.1:8000/api/users/1 \
  -H "Content-Type: application/json" \
  -H "Authorization: Bearer TU_TOKEN_AQUI" \
  -d '{"name":"Usuario Actualizado","email":"actualizado@example.com"}'

### 7.6 Eliminar usuario

bash
curl -X DELETE http://127.0.0.1:8000/api/users/1 \
  -H "Authorization: Bearer TU_TOKEN_AQUI"

### 7.7 Listar cargos

bash
curl -H "Authorization: Bearer TU_TOKEN_AQUI" http://127.0.0.1:8000/api/cargos

### 7.8 Crear cargo

bash
curl -X POST http://127.0.0.1:8000/api/cargos \
  -H "Content-Type: application/json" \
  -H "Authorization: Bearer TU_TOKEN_AQUI" \
  -d '{"nombre_cargo":"Gerente","descripcion":"Descripción del cargo"}'

### 7.9 Actualizar cargo

bash
curl -X PUT http://127.0.0.1:8000/api/cargos/1 \
  -H "Content-Type: application/json" \
  -H "Authorization: Bearer TU_TOKEN_AQUI" \
  -d '{"descripcion":"Descripción actualizada"}'

### 7.10 Eliminar cargo

bash
curl -X DELETE http://127.0.0.1:8000/api/cargos/1 \
  -H "Authorization: Bearer TU_TOKEN_AQUI"

### 7.11 Listar empleados

bash
curl -H "Authorization: Bearer TU_TOKEN_AQUI" http://127.0.0.1:8000/api/empleados

### 7.12 Crear empleado

bash
curl -X POST http://127.0.0.1:8000/api/empleados \
  -H "Content-Type: application/json" \
  -H "Authorization: Bearer TU_TOKEN_AQUI" \
  -d '{"cargo_id":1,"nombre":"Juan","apellido":"Pérez","fecha_nacimiento":"1990-01-01","fecha_ingreso":"2024-01-01","salario":1200.50,"estado":true}'

### 7.13 Actualizar empleado

bash
curl -X PUT http://127.0.0.1:8000/api/empleados/1 \
  -H "Content-Type: application/json" \
  -H "Authorization: Bearer TU_TOKEN_AQUI" \
  -d '{"salario":1300.75,"estado":false}'

### 7.14 Eliminar empleado

bash
curl -X DELETE http://127.0.0.1:8000/api/empleados/1 \
  -H "Authorization: Bearer TU_TOKEN_AQUI"

### 7.15 Listar funciones de cargo

bash
curl -H "Authorization: Bearer TU_TOKEN_AQUI" http://127.0.0.1:8000/api/funciones-cargos

### 7.16 Crear función de cargo

bash
curl -X POST http://127.0.0.1:8000/api/funciones-cargos \
  -H "Content-Type: application/json" \
  -H "Authorization: Bearer TU_TOKEN_AQUI" \
  -d '{"cargo_id":1,"descripcion_funcion":"Nueva función","estado":true}'

### 7.17 Actualizar función de cargo

bash
curl -X PUT http://127.0.0.1:8000/api/funciones-cargos/1 \
  -H "Content-Type: application/json" \
  -H "Authorization: Bearer TU_TOKEN_AQUI" \
  -d '{"descripcion_funcion":"Función actualizada","estado":false}'

### 7.18 Eliminar función de cargo

bash
curl -X DELETE http://127.0.0.1:8000/api/funciones-cargos/1 \
  -H "Authorization: Bearer TU_TOKEN_AQUI"

## 8. Insomnia

En Insomnia usa los mismos endpoints y configura la cabecera:

Authorization: Bearer TU_TOKEN_AQUI

Para las peticiones POST o PUT selecciona el tipo JSON y envía el cuerpo como JSON.

## 9. Paginación

Los listados admiten paginación mediante query params:

* ?per_page=15
* ?page=2

Ejemplo:

bash
curl -H "Authorization: Bearer TU_TOKEN_AQUI" http://127.0.0.1:8000/api/empleados?per_page=10&page=2





