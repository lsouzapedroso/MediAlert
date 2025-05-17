# MediAlert

# Make the script executable
chmod +x setup

# Build and start containers
./setup build
./setup start

# Initialize Laravel (run inside backend container)
docker exec -it doctoron-backend bash -c "php artisan key:generate && php artisan migrate"