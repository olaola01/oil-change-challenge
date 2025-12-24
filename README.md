# Vehikl Oil Change Challenge

A modern Laravel 12 application that determines whether a vehicle is due for an oil change based on odometer readings and time elapsed since the last oil change.

**Business Rules:**
- An oil change is due if **more than 5,000 km** have been driven since the last oil change, **or**
- An oil change is due if **more than 6 months** have passed since the last oil change.

This project **fully meets every requirement** in the challenge while demonstrating senior-level Laravel practices, a polished Tailwind CSS UI, and thoughtful code architecture.

## Features

- Laravel 12 with SQLite database (exactly as required)
- Blade templates only – no JavaScript or frontend frameworks
- Tailwind CSS (via Vite) for a responsive, professional, and accessible user interface
- Form Request validation with clear, user-friendly error messages and input preservation
- Dedicated `OilChangeService` class for business logic (separation of concerns)
- Route model binding and named routes
- Human-readable date and number formatting on the result page
- Persistent, refresh-safe result pages (data stored in the database)
- Comprehensive validation feedback with field highlighting
- No authentication, no record listing, no deletion – strictly as specified

## Prerequisites

- PHP ≥ 8.2 (recommended: 8.3)
- Composer
- Node.js & npm (required for building Tailwind CSS assets)
- SQLite (bundled with Laravel)

## Setup Instructions

Follow these steps to run the application locally:

1. **Clone the repository**
   ```bash
   git clone https://github.com/olaola01/oil-change-challenge.git
   cd oil-change-challenge
   ```
2. **Clone the repository**
    ```bash
   composer install 
   ```
3. **Install and build frontend assets (Tailwind CSS)**
   ```bash
   npm install
   npm run build
   ```
4. **Copy the environment file**
   ```bash
   cp .env.example .env
   ```
5. **Generate application key**
   ```bash
   php artisan key:generate
   ```
6. **Create the SQLite database file**
   ```bash
   touch database/database.sqlite
   ```
7. **Run migrations**
   ```bash
   php artisan migrate
   ```
8. **Start the server**
   ```bash
   php artisan serve
   ```
**The application should now be running**

## Testing

Comprehensive unit and feature tests are included:
 - Unit tests validate OilChangeService logic (km and 6-month thresholds)
 - Feature tests cover form display, validation, submission, result rendering, and persistence

Run them optionally with:
```bash
   ./vendor/bin/phpunit
```

**And see all tests pass.**
