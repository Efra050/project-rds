# cURL examples for `funciones-cargos` (PowerShell)
# Usage: from PowerShell run:
#   powershell -ExecutionPolicy Bypass -File .\scripts\curl_funciones_cargos.ps1

$base = "http://localhost:8000/api/funciones-cargos"

# List
curl -i "$base"

# Show (replace 1 with a real id)
curl -i "$base/1"

# Create (ensure cargo_id exists)
curl -i -X POST "$base" -H "Content-Type: application/json" -d "{\"cargo_id\":1,\"descripcion_funcion\":\"Descripción de prueba\",\"estado\":true}"

# Update (replace 1 with the id to update)
curl -i -X PUT "$base/1" -H "Content-Type: application/json" -d "{\"descripcion_funcion\":\"Nueva descripción\",\"estado\":false}"

# Delete (replace 1 with the id to delete)
curl -i -X DELETE "$base/1"

# Examples with Authorization header (replace <TOKEN> with your token):
# curl -i -X POST "$base" -H "Authorization: Bearer <TOKEN>" -H "Content-Type: application/json" -d "{\"cargo_id\":1,\"descripcion_funcion\":\"Descripción autenticada\",\"estado\":true}"
