# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

Laravel 12 application running in a Docker environment with PHP 8.3, nginx, and MySQL 8.0. This is a learning project from a Udemy course on becoming a full-stack engineer.

## Architecture

**Multi-container Docker setup:**
- `app`: PHP 8.3-fpm container running Laravel application
- `web`: nginx 1.25-alpine serving as the web server (port 80)
- `db`: MySQL 8.0 database (port 3305 mapped from 3306)

**Container Communication:**
- nginx proxies PHP requests to `app:9000` via FastCGI
- Laravel connects to database at `db:3306`
- Vite dev server runs on port 5173 (exposed for HMR)

**Environment Configuration:**
- Database credentials configured via `.env` file
- Production setup uses `docker-compose.prod.yml` overlay, designed for Aurora MySQL (local db container excluded)

## Development Commands

All commands should be run from the project root directory.

**Container Management:**
```bash
# Start development environment
docker-compose up -d

# View container status
docker-compose ps

# View logs
docker-compose logs -f

# Stop environment
docker-compose down

# Stop and remove volumes (deletes database)
docker-compose down -v

# Start production environment
docker-compose -f docker-compose.yml -f docker-compose.prod.yml up -d
```

**Laravel/PHP Commands:**
```bash
# Access PHP container shell
docker-compose exec app bash

# Run Composer commands
docker-compose exec app composer install
docker-compose exec app composer update

# Run Artisan commands
docker-compose exec app php artisan migrate
docker-compose exec app php artisan migrate:fresh --seed
docker-compose exec app php artisan key:generate

# Run tests
docker-compose exec app composer test
# Or directly:
docker-compose exec app php artisan test

# Code linting with Laravel Pint
docker-compose exec app ./vendor/bin/pint
```

**Frontend Development:**
```bash
# Access app container for npm commands
docker-compose exec app npm install
docker-compose exec app npm run dev
docker-compose exec app npm run build
```

**Integrated Development Workflow:**
```bash
# Inside app container: run all dev services concurrently
docker-compose exec app composer dev
# This runs: Laravel server, queue listener, Pail logs, and Vite
```

**Project Setup (first time):**
```bash
# 1. Copy environment file
cp .env.example .env

# 2. Start containers
docker-compose up -d

# 3. Run Laravel setup
docker-compose exec app composer setup
# This runs: composer install, .env setup, key generation, migrations, npm install & build
```

## Frontend Stack

- **Vite** for asset bundling
- **Tailwind CSS v4** via `@tailwindcss/vite` plugin
- Vite server configured to accept external connections (0.0.0.0:5173) for Docker compatibility
- HMR configured for localhost:5173

## Testing

- **PHPUnit** 11.5.3 for unit and feature tests
- Tests located in `src/tests/Feature` and `src/tests/Unit`
- Run via `composer test` or `php artisan test`

## Database

- MySQL 8.0 in development
- Data persisted in `db-store` Docker volume
- Timezone: Asia/Tokyo
- External access: localhost:3305

## Key File Locations

- Laravel source: `src/` directory
- Docker configurations: `infra/php`, `infra/nginx`, `infra/mysql`
- Vite config: `src/vite.config.js` (includes Docker-specific server config)
- Routes: `src/routes/web.php`, `src/routes/console.php`
