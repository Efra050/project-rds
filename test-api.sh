#!/bin/bash

# Script para probar el API de Laravel Sanctum

echo "=== Iniciando servidor Laravel ==="
php artisan serve > /tmp/laravel.log 2>&1 &
SERVER_PID=$!
sleep 3

echo "=== Obteniendo token de autenticación ==="
TOKEN_RESPONSE=$(curl -s -X POST http://127.0.0.1:8000/api/login \
  -H "Content-Type: application/json" \
  -d '{"email":"test@example.com","password":"password123"}')

echo "Respuesta de login: $TOKEN_RESPONSE"

TOKEN=$(echo $TOKEN_RESPONSE | grep -o '"token":"[^"]*' | cut -d'"' -f4)

if [ -z "$TOKEN" ]; then
    echo "❌ Error: No se pudo obtener el token"
    kill $SERVER_PID 2>/dev/null
    exit 1
fi

echo "✅ Token obtenido: $TOKEN"
echo ""
echo "=== Accediendo a /api/user ==="
curl -H "Authorization: Bearer $TOKEN" http://127.0.0.1:8000/api/user

echo ""
echo ""
echo "=== Test completado ==="
echo "Para usar manualmente:"
echo "curl -H \"Authorization: Bearer $TOKEN\" http://127.0.0.1:8000/api/user"

read -p "Presiona Enter para detener el servidor..."
kill $SERVER_PID 2>/dev/null
