#!/usr/bin/env bash
# cURL examples para funciones-cargos con menú interactivo
# Uso: bash ./scripts/curl_funciones_cargos.sh

BASE="http://localhost:8000/api/funciones-cargos"

# Colores
GREEN='\033[0;32m'
BLUE='\033[0;34m'
YELLOW='\033[1;33m'
NC='\033[0m'

show_menu() {
    echo -e "\n${BLUE}=== cURL Funciones-Cargos ===${NC}"
    echo "1) Listar todas"
    echo "2) Ver por ID"
    echo "3) Crear nueva"
    echo "4) Actualizar"
    echo "5) Eliminar"
    echo "6) Ejecutar todos los ejemplos"
    echo "7) Salir"
    echo -e "${BLUE}==============================${NC}"
}

list_all() {
    echo -e "${GREEN}[GET] Listando...${NC}"
    curl -i -X GET "$BASE"
    echo -e "\n"
}

show_by_id() {
    read -p "ID (default=1): " ID
    ID="${ID:-1}"
    echo -e "${GREEN}[GET] ID=$ID${NC}"
    curl -i -X GET "$BASE/$ID"
    echo -e "\n"
}

create_funcion() {
    read -p "cargo_id (default=1): " CARGO_ID
    CARGO_ID="${CARGO_ID:-1}"
    read -p "descripción: " DESC
    read -p "estado (1=true, 0=false, default=1): " ESTADO
    ESTADO="${ESTADO:-1}"
    [ "$ESTADO" = "0" ] && ESTADO="false" || ESTADO="true"
    
    echo -e "${GREEN}[POST] Creando...${NC}"
    curl -i -X POST "$BASE" \
        -H "Content-Type: application/json" \
        -d "{\"cargo_id\":$CARGO_ID,\"descripcion_funcion\":\"$DESC\",\"estado\":$ESTADO}"
    echo -e "\n"
}

update_funcion() {
    read -p "ID a actualizar: " ID
    read -p "nueva descripción: " DESC
    read -p "estado (1=true, 0=false): " ESTADO
    [ "$ESTADO" = "0" ] && ESTADO="false" || ESTADO="true"
    
    echo -e "${GREEN}[PUT] Actualizando $ID...${NC}"
    curl -i -X PUT "$BASE/$ID" \
        -H "Content-Type: application/json" \
        -d "{\"descripcion_funcion\":\"$DESC\",\"estado\":$ESTADO}"
    echo -e "\n"
}

delete_funcion() {
    read -p "ID a eliminar: " ID
    echo -e "${GREEN}[DELETE] Eliminando $ID...${NC}"
    curl -i -X DELETE "$BASE/$ID"
    echo -e "\n"
}

run_all_examples() {
    echo -e "${GREEN}=== Ejemplos ===${NC}\n"
    
    echo -e "${GREEN}1. Listar${NC}"
    curl -i -X GET "$BASE"
    echo -e "\n"
    
    echo -e "${GREEN}2. Ver ID=1${NC}"
    curl -i -X GET "$BASE/1"
    echo -e "\n"
    
    echo -e "${GREEN}3. Crear${NC}"
    curl -i -X POST "$BASE" -H "Content-Type: application/json" -d '{"cargo_id":1,"descripcion_funcion":"Test","estado":true}'
    echo -e "\n"
    
    echo -e "${GREEN}4. Actualizar ID=1${NC}"
    curl -i -X PUT "$BASE/1" -H "Content-Type: application/json" -d '{"descripcion_funcion":"Actualizado","estado":false}'
    echo -e "\n"
    
    echo -e "${GREEN}5. Eliminar ID=1${NC}"
    curl -i -X DELETE "$BASE/1"
    echo -e "\n"
}

while true; do
    show_menu
    read -p "Opción: " opcion
    
    case $opcion in
        1) list_all ;;
        2) show_by_id ;;
        3) create_funcion ;;
        4) update_funcion ;;
        5) delete_funcion ;;
        6) run_all_examples ;;
        7) echo -e "${GREEN}¡Hasta luego!${NC}"; exit 0 ;;
        *) echo -e "${YELLOW}Opción inválida${NC}" ;;
    esac
done
