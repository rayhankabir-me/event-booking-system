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

### 1️⃣ Clone the Repository
```bash
git clone https://github.com/rayhankabir-me/event-booking-system.git
cd event-booking-system

2️⃣ Install Dependencies
composer install
cp .env.example .env

