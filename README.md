# content_scheduler

A simplified content scheduling Laravel application to create, schedule, and publish posts across multiple social platforms.

## Features

- User registration and login (Laravel Sanctum)
- Post CRUD with platform selection
- Scheduling posts with status (draft, scheduled, published)
- Platform management
- Dashboard with analytics
- Mock publishing process

## Installation

1. Clone the repo:
   ```bash
   git clone https://github.com/yourusername/content-scheduler.git
   cd content-scheduler
Install dependencies:

composer install
npm install
npm run dev

Setup your .env file:

cp .env.example .env
php artisan key:generate

Configure your database in .env file.

Run migrations and seeders:

php artisan migrate --seed

to run command which publish scheduled posts 
 php artisan posts:publish-due
admin credentials : admin@admin.com , password
