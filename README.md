# ClearSight Care Portal — Laravel Backend

A secure, role-based care management portal for ClearSight Domiciliary.
Built with Laravel 11 + MySQL + Blade Templates.

---

## Requirements

- PHP 8.2+
- Composer
- MySQL 8.0+
- Laravel 11

---

## Setup Instructions (Step by Step)

### Step 1 — Create a fresh Laravel project

```bash
composer create-project laravel/laravel clearsight-app
cd clearsight-app
```

### Step 2 — Copy all provided files into the project

Replace / copy these folders from the zip into your Laravel project root:

```
app/Http/Controllers/     ← All 6 controllers
app/Http/Middleware/       ← RoleMiddleware.php
app/Models/                ← 5 models
bootstrap/app.php          ← Overwrites existing (middleware alias)
database/migrations/       ← 5 migration files
database/seeders/          ← DatabaseSeeder.php
resources/views/           ← All blade views
routes/web.php             ← Overwrites existing
.env.example               ← Reference only
```

### Step 3 — Create MySQL Database

Open MySQL / phpMyAdmin and run:

```sql
CREATE DATABASE clearsight_portal CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

### Step 4 — Configure .env

```bash
cp .env.example .env
```

Then edit `.env` and update:

```env
DB_DATABASE=clearsight_portal
DB_USERNAME=root
DB_PASSWORD=your_mysql_password
```

### Step 5 — Install dependencies & generate key

```bash
composer install
php artisan key:generate
```

### Step 6 — Run migrations and seed demo data

```bash
php artisan migrate
php artisan db:seed
```

### Step 7 — Start the server

```bash
php artisan serve
```

Visit: **http://localhost:8000**

---

## Demo Login Credentials

| Role       | Email                    | Password   |
|------------|--------------------------|------------|
| Admin      | admin@clearsight.co.uk   | password   |
| Care Home  | sarah@amberley.co.uk     | password   |

---

## Database Tables Created

| Table             | Purpose                                      |
|-------------------|----------------------------------------------|
| `users`           | Login accounts (admin + care home users)     |
| `care_homes`      | Registered care home organisations           |
| `residents`       | Individual residents per care home           |
| `service_requests`| Eye/hearing service requests                 |
| `messages`        | Secure messaging between care home & admin   |

---

## User Roles

### Admin (`role = admin`)
- URL prefix: `/admin/`
- Can see ALL care homes, residents, requests, messages
- Can update request statuses
- Can add/edit/delete care homes and residents

### Care Home (`role = carehome`)
- URL prefix: `/portal/`
- Can ONLY see their own care home's data
- Can add/edit their own residents
- Can submit service requests
- Can message ClearSight admin

---

## File Structure

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── AuthController.php
│   │   ├── AdminDashboardController.php
│   │   ├── CareHomeDashboardController.php
│   │   ├── CareHomeController.php
│   │   ├── ResidentController.php
│   │   ├── ServiceRequestController.php
│   │   └── MessageController.php
│   └── Middleware/
│       └── RoleMiddleware.php
└── Models/
    ├── User.php
    ├── CareHome.php
    ├── Resident.php
    ├── ServiceRequest.php
    └── Message.php

resources/views/
├── layouts/
│   ├── app.blade.php        ← Main layout (sidebar + topbar)
│   └── auth.blade.php       ← Login/register layout
├── auth/
│   ├── login.blade.php
│   └── register.blade.php
├── admin/
│   ├── dashboard.blade.php
│   ├── care-homes/          ← index, show, create, edit
│   ├── residents/           ← index, show, create, edit
│   ├── requests/            ← index
│   └── messages/            ← index
├── carehome/
│   ├── dashboard.blade.php
│   ├── residents/           ← index, show, create, edit
│   ├── requests/            ← index
│   └── messages/            ← index
└── partials/
    └── info-row.blade.php

routes/
└── web.php                  ← All routes with role middleware
```

---

## Resident Status Logic

Status is **automatically calculated** every time a resident record is saved:

| Condition                          | Status    |
|------------------------------------|-----------|
| `next_recall_date` is in the past  | `overdue` |
| Within 30 days of recall date      | `due`     |
| More than 30 days away             | `ok`      |

This logic lives in `app/Models/Resident.php` in the `booted()` method.

---

## Future Phase 2 Features (Ready to Build On)

- Email notifications for new requests
- Document/PDF uploads per resident
- Multi-user roles per care home
- Automated recall reminder emails (Laravel Scheduler)
- Reporting & analytics dashboard
- Mobile PWA layer

---

## Support

Built for ClearSight Domiciliary Care Portal — Phase 1.
Contact developer for any setup issues.
