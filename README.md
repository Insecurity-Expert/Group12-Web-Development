# Convene — An Event Management System Web App

A web-based Event Management System built with Laravel. A single organizing body (the admin) creates and manages events; the public can browse events, register for a ticket, and get checked in at the door. Admins view attendance reports.

Built by Group 12 for our Web Development project.

- Astejada
- Bhasa
- Gaa
- Leñar

---

## Features

**Public / Attendee**
- Browse upcoming events without logging in
- View full event details (date, location, description, slots left)
- Register for an event and receive a unique ticket code
- View personal tickets under "My Tickets"
- Role-aware dashboard showing personal stats

**Admin**
- Full event management: create, edit, and delete events (CRUD)
- Attendance check-in by registration code
- Reports: per-event registration and check-in totals
- Admin-only dashboard with aggregate stats
- Admin-only areas protected by middleware

**System**
- Role-based access (`admin` / `attendee`) enforced via middleware
- Capacity / slot management with duplicate-registration prevention
- Responsive UI: top navbar for guests, sidebar for logged-in users
- CSRF protection, hashed passwords, and Eloquent query safety throughout

---

## Tech Stack

| Layer | Technology |
|---|---|
| Framework | Laravel |
| Language | PHP 8.5 |
| Database | MySQL |
| Frontend | Blade, Bootstrap 5 (CDN), Bootstrap Icons |
| Build tool | Vite |
| Auth scaffolding | Laravel Breeze (converted to Bootstrap) |

---

## Requirements

Before setting up, make sure you have installed:

- PHP 8.2+ (project uses 8.5)
- Composer
- Node.js & npm
- MySQL

---

## Setup

Clone the repository and run the following from the project root.

```bash
# 1. Install PHP dependencies
composer install

# 2. Install front-end dependencies
npm install

# 3. Create your environment file
cp .env.example .env

# 4. Generate the application key
php artisan key:generate
```

### Configure the database

Create a MySQL database named `events_app`, then open `.env` and set your database credentials:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=events_app
DB_USERNAME=root
DB_PASSWORD=your_password_here
```

### Run migrations and seed data

```bash
php artisan migrate:fresh --seed
```

> **Note:** `migrate:fresh --seed` drops all tables and reseeds. Use it for a clean setup or to reset data. It will erase any existing records.

### Run the application

Open **two terminals**:

```bash
# Terminal 1 — Laravel server
php artisan serve
```
```bash
# Terminal 2 — Vite (compiles CSS/JS)
npm run dev
```

Then visit **http://127.0.0.1:8000**

---

## Default Accounts

After seeding, you can log in with:

| Role | Email | Password |
|---|---|---|
| Admin | `admin@example.com` | `password123` |
| Attendee | `test@example.com` | `password` |

---

## Project Structure (key files)

```
app/
  Http/Controllers/
    Admin/EventController.php      # Admin event CRUD
    Admin/CheckInController.php    # Attendance check-in
    DashboardController.php        # Role-aware dashboard
    RegistrationController.php     # Public browsing + registration
    ReportController.php           # Reports
  Http/Middleware/
    EnsureUserIsAdmin.php          # Admin-only route protection
  Models/
    Event.php
    Registration.php
    User.php
resources/
  css/app.css                     # Convene theme
  views/
    layouts/sidebar.blade.php      # Logged-in shell
    layouts/guest.blade.php        # Public shell
    admin/events/                  # Event management views
    dashboard.blade.php
    welcome.blade.php              # Homepage
database/
  seeders/DatabaseSeeder.php       # Seeded users + events
routes/web.php
```

---

## Team

| Member | Area | Contribution |
|---|---|---|
| Angelo Gaa | Team lead · Admin Events · integration | 5/5 |
| Lydia Astejada | Registration · UI/UX Design | 5/5 |
| Jorelle Lenar | Check-in · Debug | 5/5 |
| Rhein Bhasa | Reports · Debug | 5/5 |

---

## Workflow

We work on feature branches and merge into `main` via pull requests, with Angelo reviewing and merging.

```bash
git checkout main
git pull origin main
git checkout -b feature/your-area
# ...work...
git add .
git commit -m "your message"
git push origin feature/your-area
# then open a PR into main
```

Shared files (models, `routes/web.php`, seeders) are coordinated through Angelo to avoid conflicts.
