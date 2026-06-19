# Guía práctica para usar la API con Laravel Sanctum

## 1. Problemas comunes y solución

### 1.1 Token inválido
- Problema: se está usando un placeholder como `TU_TOKEN_AQUI`
- Solución: haz login primero y usa el token devuelto en `Authorization: Bearer [token]`

### 1.2 Servidor no iniciado
- Problema: el servidor Laravel no está corriendo en `http://127.0.0.1:8000`
- Solución: ejecuta `php artisan serve` antes de enviar peticiones

### 1.3 Base de datos no configurada
- Problema: las migraciones o seeders no se han ejecutado
- Solución:
  - `php artisan migrate:fresh --seed`

## 2. Probar la API desde la terminal

### Paso 1: Iniciar el servidor
```bash
php artisan serve
```

### Paso 2: Obtener un token
```bash
curl -X POST http://127.0.0.1:8000/api/login \
  -H "Content-Type: application/json" \
  -d '{"email":"test@example.com","password":"password123"}'
```

Respuesta esperada:

```json
{
  "token": "2|rLNPVlcTJSL4PCGKrhsNESzkv8sdpxO3AuHIhTpm94a90ea7"
}
```

### Paso 3: Acceder con el token
```bash
curl -H "Authorization: Bearer 2|rLNPVlcTJSL4PCGKrhsNESzkv8sdpxO3AuHIhTpm94a90ea7" \
  http://127.0.0.1:8000/api/user
```

Respuesta esperada:

```json
{
  "id": 1,
  "name": "Usuario Prueba",
  "email": "test@example.com",
  "email_verified_at": "2026-06-10T19:36:56.000000Z",
  "created_at": "2026-06-10T19:36:57.000000Z",
  "updated_at": "2026-06-10T19:36:57.000000Z"
}
```

## 3. Usuarios de ejemplo

| Email | Contraseña | Rol |
|-------|-----------|-----|
| test@example.com | password123 | Usuario |
| admin@example.com | admin123 | Admin |

## 4. Uso con Insomnia

Configura el método HTTP y la URL. Agrega el header:

```
Authorization: Bearer TU_TOKEN_AQUI
```

Para POST o PUT, usa el cuerpo en formato JSON.

## 5. Automatizar con script

Puedes ejecutar el script de pruebas:

```bash
bash test-api.sh
```

## 6. Consejos finales

- Token Bearer: siempre incluye `Authorization: Bearer [token]`
- Content-Type: usa `application/json` para POST y PUT
- El servidor Laravel corre en `http://127.0.0.1:8000`
- Si usas Insomnia, el endpoint es el mismo `http://127.0.0.1:8000`
