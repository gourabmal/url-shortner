# URL Shortener Application - XAMPP Setup

Quick start guide after pulling from git.

## Prerequisites

- PHP 8.1+, Composer, MySQL, XAMPP

## Quick Start

### 1. Navigate to project and install dependencies

```bash
cd data
composer install
```

### 2. Setup environment file

```bash
copy .env.example .env
```

### 3. Generate app key

```bash
php artisan key:generate
```

### 4. Create database

Open phpMyAdmin (http://localhost/phpmyadmin) and create database `url_shortner`

### 5. Run migrations and seed

```bash
php artisan migrate
php artisan db:seed
```

### 6. Start the app

**Option A - Laravel built-in server:**

```bash
php artisan serve
```

Then open: http://127.0.0.1:8000

**Option B - XAMPP:**

1. Start Apache & MySQL in XAMPP
2. Open: http://localhost/url-shortner/

---

## Demo

**For a detailed demo, visit:**

https://url-shortner-demo.pages.dev/

---

## For Docker Setup

See [DOCKER_SETUP.md](DOCKER_SETUP.md)
