# URL Shortener Application - Docker Setup

Quick start guide after pulling from git.

## Prerequisites

- Docker Desktop installed

## Quick Start

### 1. Clone the repo

```bash
git clone https://github.com/gourabmal/url-shortner.git
cd data
```

### 2. Build Docker image

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

### 3. Start all containers

```bash
docker-compose up -d
```

### 4. Create the environment file

```bash
copy .env.example .env
```

> Update the SMTP details in `data/.env` before using email features (mail host, port, username, password, and from address).

### 5. Install dependencies

```bash
docker-compose exec app composer install
```

### 6. Generate app key

```bash
docker-compose exec app php artisan key:generate
```

### 7. Run migrations and seed

```bash
docker-compose exec app php artisan migrate
docker-compose exec app php artisan db:seed
```

### 8. Access the application

Open browser: **http://localhost:8080**

### Portal Login

Open: **http://localhost:8080/admin-login**

---

## Demo

**For a detailed demo, visit:**

https://url-shortner-demo.pages.dev/

---

## For XAMPP Setup

See [README.md](README.md)
