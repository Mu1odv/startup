# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

Startap va Investorlar Boshqaruv Tizimi - Laravel asosida yaratilgan minimal startup va investor management system.

## Common Commands

```bash
# Development server
php artisan serve --host=0.0.0.0 --port=8080

# Database operations
php artisan migrate
php artisan db:seed --class=StartupInvestorSeeder
php artisan migrate:fresh --seed

# Code generation
php artisan make:model ModelName -m
php artisan make:controller ControllerName --resource
php artisan make:seeder SeederName
```

## Architecture

### Models and Relationships
- **Startup**: Asosiy startap ma'lumotlari (name, description, funding_goal, current_funding, status, deadline)
- **Investor**: Investor ma'lumotlari (name, email, total_budget, investor_type)
- **Investment**: Startup va investor o'rtasidagi bog'lanish (amount, status: pending/approved/rejected)

### Key Features
- Startap CRUD operatsiyalari
- Investor CRUD operatsiyalari
- Investitsiya jarayoni (yaratish, tasdiqlash, rad etish)
- Funding progress tracking
- Bootstrap UI bilan responsive design

### Database Structure
- SQLite ishlatiladi (development uchun)
- Foreign key constraints bilan bog'langan
- Soft deletes yo'q, cascade delete ishlatiladi

### Views Structure
- `layouts/app.blade.php` - asosiy layout
- `startups/` - startap-related views
- `investors/` - investor-related views  
- `investments/` - investitsiya-related views

## Development Workflow

1. Model o'zgarishlari uchun migration yarating
2. Controller methodlarida validation qo'shing
3. View fayllarida Bootstrap classlarini ishlating
4. Error handling uchun session flash messages ishlating
5. Route model binding Laravel convention bo'yicha