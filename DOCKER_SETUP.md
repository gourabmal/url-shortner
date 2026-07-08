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

> The Docker setup uses these default MySQL credentials:
>
> - `DB_HOST=mysql`
> - `DB_DATABASE=url_shortner`
> - `DB_USERNAME=laravel`
> - `DB_PASSWORD=secret`
>
> These values are configured in `docker-compose.yml` and `data/.env`.

### 2. Start all containers

```bash
docker-compose up -d
```

### 3. Create the environment file

```bash
cd data
copy .env.example .env
```

### 4. Install dependencies

```bash
docker-compose exec app composer install
```

### 5. Generate app key

```bash
docker-compose exec app php artisan key:generate
```

### 6. Run migrations and seed

```bash
docker-compose exec app php artisan migrate
docker-compose exec app php artisan db:seed
```

### 7. Access the application

Open browser: **http://localhost:8080**

---

## Demo

**For a detailed demo, visit:**

https://url-shortner-demo.pages.dev/

---

## For XAMPP Setup

See [README.md](README.md)
