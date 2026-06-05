#!/usr/bin/env bash
# Script rápido con comandos cURL guardados
# Descomenta los que necesites ejecutar

BASE="http://localhost:8000/api/funciones-cargos"

echo "=== Iniciando llamadas API ==="
echo ""

# 1. LISTAR TODAS
echo "1. Listar todas las funciones:"
curl.exe -i -X GET "$BASE"
echo ""
echo "---"
echo ""

# 2. VER POR ID
echo "2. Ver funcion con ID=1:"
curl.exe -i -X GET "$BASE/1"
echo ""
echo "---"
echo ""

# 3. CREAR
echo "3. Crear nueva funcion:"
curl.exe -i -X POST "$BASE" \
  -H "Content-Type: application/json" \
  -d '{"cargo_id":1,"descripcion_funcion":"Nueva funcion","estado":true}'
echo ""
echo "---"
echo ""

# 4. ACTUALIZAR
echo "4. Actualizar funcion ID=1:"
curl.exe -i -X PUT "$BASE/1" \
  -H "Content-Type: application/json" \
  -d '{"descripcion_funcion":"Actualizada","estado":false}'
echo ""
echo "---"
echo ""

# 5. ELIMINAR
echo "5. Eliminar funcion ID=1:"
curl.exe -i -X DELETE "$BASE/1"
echo ""

echo "=== Fin de llamadas ==="
