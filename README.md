# URL Shortener Application - XAMPP Setup

Quick start guide after pulling from git.

## Prerequisites

- PHP 8.1+, Composer, MySQL, XAMPP

## Quick Start

### 1. Clone the repo

```bash
git clone https://github.com/gourabmal/url-shortner.git
cd data
```

### 2. Install dependencies

```bash
composer install
```

### 3. Setup environment file

```bash
copy .env.example .env
```

> Update the SMTP details in `data/.env` before using email features (mail host, port, username, password, and from address).

### 4. Generate app key

```bash
php artisan key:generate
```

### 5. Create database

Open phpMyAdmin (http://localhost/phpmyadmin) and create database `url_shortner`

### 6. Run migrations and seed

```bash
php artisan migrate
php artisan db:seed
```

### 7. Start the app

**Option A - Laravel built-in server:**

```bash
php artisan serve
```

Then open: http://127.0.0.1:8000

**Option B - XAMPP:**

1. Start Apache & MySQL in XAMPP
2. Open: http://localhost/url-shortner/

### Portal Login

Open: http://localhost/url-shortner/admin-login

---

## Demo

**For a detailed demo, visit:**

https://url-shortner-demo.pages.dev/

---

## For Docker Setup

See [DOCKER_SETUP.md](DOCKER_SETUP.md)
