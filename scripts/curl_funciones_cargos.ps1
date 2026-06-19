# Ejemplos de cURL para `funciones-cargos` (PowerShell)
# Uso: desde PowerShell ejecuta:
#   powershell -ExecutionPolicy Bypass -File .\scripts\curl_funciones_cargos.ps1

$base = "http://localhost:8000/api/funciones-cargos"

# Listar
curl -i "$base"

# Mostrar (reemplaza 1 con un ID real)
curl -i "$base/1"

# Crear (asegúrate de que cargo_id exista)
curl -i -X POST "$base" -H "Content-Type: application/json" -d "{\"cargo_id\":1,\"descripcion_funcion\":\"Descripción de prueba\",\"estado\":true}"

# Actualizar (reemplaza 1 con el ID a actualizar)
curl -i -X PUT "$base/1" -H "Content-Type: application/json" -d "{\"descripcion_funcion\":\"Nueva descripción\",\"estado\":false}"

# Eliminar (reemplaza 1 con el ID a eliminar)
curl -i -X DELETE "$base/1"

# Ejemplos con cabecera de autorización (reemplaza <TOKEN> con tu token):
# curl -i -X POST "$base" -H "Authorization: Bearer <TOKEN>" -H "Content-Type: application/json" -d "{\"cargo_id\":1,\"descripcion_funcion\":\"Descripción autenticada\",\"estado\":true}"
