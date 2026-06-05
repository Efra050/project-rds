Listar (index):

curl -i -X GET http://localhost:8000/api/funciones-cargos


Ver (show):

curl -i -X GET http://localhost:8000/api/funciones-cargos/1


Crear (store):

curl -i -X POST http://localhost:8000/api/funciones-cargos -H "Content-Type: application/json" -d "{\"cargo_id\":1,\"descripcion_funcion\":\"Descripción de prueba\",\"estado\":true}"


Actualizar (update) — PUT:

curl -i -X PUT http://localhost:8000/api/funciones-cargos/1 -H "Content-Type: application/json" -d "{\"descripcion_funcion\":\"Nueva descripción\",\"estado\":false}"


Borrar (destroy):

curl -i -X DELETE http://localhost:8000/api/funciones-cargos/1




// Cómo ejecutar los comandos en BASH

// Opción 1: Menú Interactivo 


bash ./scripts/curl_funciones_cargos.sh


Luego selecciona una opción:
//-Listar todas
//-Ver por ID
//-Crear nueva
//-Actualizar
//-Eliminar
//-Ejecutar todos los ejemplos

// Opción 2: Ejecutar todos los ejemplos de una vez

bash ./scripts/api_calls.sh


// Opción 3: Comandos individuales en bash

// Listar:

curl -i -X GET http://localhost:8000/api/funciones-cargos


// Ver por ID:

curl -i -X GET http://localhost:8000/api/funciones-cargos/1

// Crear:

curl -i -X POST http://localhost:8000/api/funciones-cargos \
  -H "Content-Type: application/json" \
  -d '{"cargo_id":1,"descripcion_funcion":"Nueva funcion","estado":true}'


// Actualizar:

curl -i -X PUT http://localhost:8000/api/funciones-cargos/1 \
  -H "Content-Type: application/json" \
  -d '{"descripcion_funcion":"Actualizada","estado":false}'


// Eliminar:

curl -i -X DELETE http://localhost:8000/api/funciones-cargos/1


//Notas importantes

- Si usas **PowerShell en Windows**, usa curl.exe en lugar de curl para evitar conflictos de alias
- Para **bash/WSL/Git Bash**, usa curl directamente (sin .exe)
- El servidor debe estar corriendo en http://localhost:8000
- Requiere curl instalado en el sistema
