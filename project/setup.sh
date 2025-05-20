  #!/bin/bash

# Colors
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
CYAN='\033[0;36m'
NC='\033[0m'

# Project Variables
BACKEND_DIR="DoctorON_api"
FRONTEND_DIR="material_kit"

show_help() {
    echo -e "${YELLOW}Usage: ./setup [command]${NC}"
    echo -e "${CYAN}Available commands:${NC}"
    echo -e "  ${GREEN}start${NC}    - Start all services"
    echo -e "  ${GREEN}stop${NC}     - Stop all services"
    echo -e "  ${GREEN}restart${NC}  - Restart all services"
    echo -e "  ${GREEN}build${NC}    - Rebuild containers"
    echo -e "  ${GREEN}logs${NC}     - Show service logs"
    echo -e "  ${GREEN}clean${NC}    - Remove containers and clean volumes"
    echo -e "  ${GREEN}status${NC}   - Show container status"
    echo -e "  ${GREEN}backend${NC}  - Access backend container"
    echo -e "  ${GREEN}frontend${NC} - Access frontend container"
}

start_services() {
    echo -e "${GREEN}Starting DoctorON system...${NC}"

    if [ ! -f ".env" ]; then
        echo -e "${YELLOW}Creating .env from example...${NC}"
        cp .env.example .env
    fi

    docker compose up -d

    echo -e "${CYAN}\nServices running:${NC}"
    echo -e "Laravel: ${YELLOW}http://localhost${NC}"
    echo -e "React:   ${YELLOW}http://localhost:3000${NC}"
    echo -e "MySQL:   ${YELLOW}port ${FORWARD_DB_PORT:-3306}${NC}"
    echo -e "Redis:   ${YELLOW}port ${FORWARD_REDIS_PORT:-6379}${NC}"
}

stop_services() {
    echo -e "${YELLOW}Stopping all services...${NC}"
    docker compose down
}

build_services() {
    echo -e "${YELLOW}Building containers...${NC}"

    # Build Laravel
    if [ -d "$BACKEND_DIR" ]; then
        echo -e "${CYAN}Building Laravel container...${NC}"
        docker compose build laravel
    fi

    # Build React
    if [ -d "$FRONTEND_DIR" ]; then
        echo -e "${CYAN}Building React container...${NC}"
        docker compose build react
    fi

    echo -e "${GREEN}Build completed successfully!${NC}"
}

case "$1" in
    start)
        start_services
        ;;
    stop)
        stop_services
        ;;
    restart)
        stop_services
        start_services
        ;;
    build)
        build_services
        ;;
    logs)
        docker compose logs -f
        ;;
    clean)
        echo -e "${RED}Cleaning up...${NC}"
        docker compose down -v
        docker system prune -f
        ;;
    status)
        docker compose ps
        ;;
    backend)
        docker exec -it doctoron-api bash
        ;;
    frontend)
        docker exec -it material-kit sh
        ;;
    *)
        show_help
        exit 1
        ;;
esac