# TaskMaster

TaskMaster is a modern, responsive Employee Task Management System built using the Laravel ecosystem. It features a dual-interface architecture: a powerful Filament v3 admin backend for managers and a custom Tailwind CSS + Livewire frontend for employees.

## Features

- **Dual-Interface Architecture:** Strict separation between the Admin portal and Employee portal using middleware and route guards.
- **Admin Panel (Filament v3):**
  - **Dashboard:** Real-time metrics including *Total Open Tasks*, *Completed This Week*, and an *Overdue Tasks* data table.
  - **User Management:** Create, read, update, and delete employee accounts.
  - **Task Management:** Create tasks, set due dates, and assign them to specific employees.
- **Employee Portal (Livewire v3):**
  - **Custom Login:** Polished, responsive login screen exclusive to employees.
  - **My Tasks Dashboard:** Employees view only their assigned tasks.
  - **Real-Time Status Updates:** Instantly change a task's status (Pending -> In Progress -> Completed) without full page reloads.
- **Role-Based Access Control:** Secure boundaries preventing unauthorized access to the admin dashboard.

## Tech Stack

- **Framework:** [Laravel 12](https://laravel.com/)
- **Admin Panel:** [Filament v3](https://filamentphp.com/)
- **Frontend Interactivity:** [Laravel Livewire v3](https://livewire.laravel.com/)
- **Styling:** [Tailwind CSS v4](https://tailwindcss.com/)
- **Database:** SQLite (Default for local development)

## Installation Guide

### Prerequisites
- PHP 8.2 or higher
- Composer
- Node.js & npm

### Setup Instructions

1. **Clone the repository:**
   ```bash
   git clone https://github.com/yourusername/TaskMaster.git
   cd TaskMaster
   ```

2. **Install PHP dependencies:**
   ```bash
   composer install
   ```

3. **Install NPM dependencies & build assets:**
   ```bash
   npm install
   npm run build
   ```

4. **Environment Setup:**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
   *Note: Ensure `DB_CONNECTION=sqlite` is set in your `.env` file.*

5. **Create the SQLite database:**
   ```bash
   # Windows (Powershell)
   New-Item -ItemType File -Path "database\database.sqlite" -Force
   
   # Mac/Linux
   touch database/database.sqlite
   ```

6. **Run Migrations & Seed the Database:**
   This will migrate the schema and populate the database with a default Admin and several Demo Employees with sample tasks.
   ```bash
   php artisan migrate:fresh --seed
   ```

7. **Start the local development server:**
   ```bash
   php artisan serve
   ```

## Usage

**Admin Panel Access**
- URL: `http://127.0.0.1:8000/admin`
- Email: `admin@taskmaster.com`
- Password: `password`

**Employee Portal Access**
- URL: `http://127.0.0.1:8000/login`
- Email: `alice@taskmaster.com` (or bob/carol)
- Password: `password`

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
