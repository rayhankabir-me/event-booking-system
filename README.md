# 🎟️ Event Booking System API (Laravel 11)

This is a backend REST API for an **Event Booking System**, built with **Laravel 11**.  
It includes authentication, event and ticket management, bookings, payments (mocked), role-based access, notifications, queues, and caching.

---

## 🚀 Features

- 🔐 Authentication (Laravel Sanctum)
- 🧑‍💼 Role-based access (Admin, Organizer, Customer)
- 📅 Event & Ticket management
- 💳 Mocked payment system
- 📦 Queue & Notification support
- 🧩 Reusable Traits & Services
- ✅ Feature & Unit Testing (85%+ coverage)

---

## 🛠️ Tech Stack

- **Framework:** Laravel 11
- **Database:** MySQL
- **Auth:** Laravel Sanctum
- **Queue:** Database
- **Testing:** PHPUnit / Pest
- **Notifications:** Mail (Queued)

---

## ⚙️ Installation Guide

1️⃣ Clone the Repository
```bash
git clone https://github.com/rayhankabir-me/event-booking-system.git
cd event-booking-system


2️⃣ Install Dependencies
composer install
cp .env.example .env

2️⃣ Update your .env file:
APP_NAME="Event Booking System"
APP_URL=https://event-booking-system.test
DB_CONNECTION=mysql
DB_DATABASE=event_booking
DB_USERNAME=root
DB_PASSWORD=
QUEUE_CONNECTION=database
MAIL_MAILER=smtp
MAIL_HOST=
MAIL_PORT=
MAIL_USERNAME=your_email@gmail.com
MAIL_PASSWORD=your_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="your_email@gmail.com"

4️⃣ Generate App Key
php artisan key:generate

5️⃣ Run Migrations & Seeders
php artisan migrate:fresh --seed

6️⃣ Run Queue Worker
php artisan queue:work

7️⃣ Start Development Server
php artisan serve

Each authenticated request requires:
Authorization: Bearer {token}


# 🎟️ Postman collections are included in the root directory



