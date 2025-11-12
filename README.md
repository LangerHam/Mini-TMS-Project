# Task Management System

Laravel-based system for managing employees and tasks.

## Setup

```bash
# 1. Clone & Install
git clone https://github.com/LangerHam/TMS.git
cd TMS
composer install 
npm install

# 2. Environment
copy .env.example .env          # Windows
php artisan key:generate

# 3. Database (edit .env with your credentials)
mysql -u root -p
CREATE DATABASE tms;
EXIT;

# 4. Migrate & Seed
php artisan migrate:fresh --seed

# 5. Start
php artisan serve
```

Visit: **http://localhost:8000**

## Features

-   Employee Management (CRUD)
-   Task Management with status tracking
-   Dashboard with statistics
-   Search & filters
-   Bootstrap 5 UI

## Tech Stack

Laravel 12 • PHP 8.2+ • MySQL 8+ • Bootstrap 5
