# URL Shortener Application - Docker Setup

Quick start guide after pulling from git.

## Prerequisites

- Docker Desktop installed

## Quick Start

### 1. Build Docker image

```bash
docker-compose build
```

This builds the PHP image for your system.

### 2. Start all containers

```bash
docker-compose up -d
```

### 3. Install dependencies

```bash
docker-compose exec app composer install
```

### 4. Generate app key

```bash
docker-compose exec app php artisan key:generate
```

### 5. Run migrations and seed

```bash
docker-compose exec app php artisan migrate
docker-compose exec app php artisan db:seed
```

### 6. Access the application

Open browser: **http://localhost:8080**

---

## Database Access

**From MySQL client on your host machine:**
- Host: `localhost`
- Port: `3306`
- User: `laravel`
- Password: `secret`
- Database: `url_shortner`

> Note: This `localhost` address is for tools running on your host machine. Inside the PHP container, the Laravel app must use `DB_HOST=mysql` because it connects to the MySQL service by Docker service name.

---

## Common Commands

```bash
# View running containers
docker-compose ps

# View logs
docker-compose logs -f

# Access PHP container shell
docker-compose exec app bash

# Run artisan commands
docker-compose exec app php artisan <command>

# Stop containers
docker-compose stop

# Stop and remove containers (keeps data)
docker-compose down

# Stop and remove everything
docker-compose down -v
```

---

## For XAMPP Setup

See [README.md](README.md)
