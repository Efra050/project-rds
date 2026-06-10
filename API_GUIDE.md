# Guía: Cómo usar el API con Laravel Sanctum

## Problemas identificados y solucionados

### 1. **Token inválido**
- **Problema**: Usabas `TU_TOKEN_AQUI` como placeholder
- **Solución**: Primero debes hacer login para obtener un token válido

### 2. **Servidor no ejecutándose**
- **Problema**: El servidor Laravel no estaba corriendo en `http://127.0.0.1:8000`
- **Solución**: Ejecutar `php artisan serve` antes de hacer las peticiones

### 3. **Base de datos no configurada**
- **Problema**: Las migraciones y seeders no estaban ejecutados
- **Solución**: 
  - `php artisan migrate` - ejecuta las migraciones
  - `php artisan db:seed` - ejecuta los seeders

## Pasos para probar el API manualmente

### Paso 1: Iniciar el servidor
```bash
php artisan serve
```

### Paso 2: Obtener un token (Login)
```bash
curl -X POST http://127.0.0.1:8000/api/login \
  -H "Content-Type: application/json" \
  -d '{"email":"test@example.com","password":"password123"}'
```

**Respuesta esperada:**
```json
{
  "token": "2|rLNPVlcTJSL4PCGKrhsNESzkv8sdpxO3AuHIhTpm94a90ea7"
}
```

### Paso 3: Usar el token para acceder al usuario
```bash
curl -H "Authorization: Bearer 2|rLNPVlcTJSL4PCGKrhsNESzkv8sdpxO3AuHIhTpm94a90ea7" \
  http://127.0.0.1:8000/api/user
```

**Respuesta esperada:**
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

## Usuarios de prueba disponibles

| Email | Contraseña | Rol |
|-------|-----------|-----|
| test@example.com | password123 | Usuario |
| admin@example.com | admin123 | Admin |

## Automatizar el proceso

Ejecuta el script automatizado:
```bash
bash test-api.sh
```

Este script:
1. Inicia el servidor Laravel
2. Obtiene un token automáticamente
3. Accede a `/api/user` con el token
4. Detiene el servidor cuando termina

## Puntos importantes

- **Token Bearer**: Siempre incluye `Authorization: Bearer [token]` en la cabecera
- **Content-Type**: Para POST usa `Content-Type: application/json`
- **localhost vs 127.0.0.1**: El .env usa `APP_URL=http://localhost` pero el servidor corre en `127.0.0.1:8000`
