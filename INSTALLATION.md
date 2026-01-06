# Installation Guide

## Prerequisites

Before you begin, ensure you have the following installed:
- PHP 8.1 or higher
- Composer
- MySQL 5.7+ or MariaDB 10.3+
- Node.js & NPM (for asset compilation)
- Git

## Step-by-Step Installation

### 1. Clone the Repository

```bash
git clone https://github.com/Pawan-Dananjaya/Innovior-Student-Registration-and-Payment-Tracking-System-Laravel.git
cd Innovior-Student-Registration-and-Payment-Tracking-System-Laravel
```

### 2. Install PHP Dependencies

```bash
composer install
```

If you encounter any issues, try:
```bash
composer install --ignore-platform-reqs
```

### 3. Install Node Dependencies

```bash
npm install
```

### 4. Environment Configuration

Copy the example environment file:
```bash
cp .env.example .env
```

Generate application key:
```bash
php artisan key:generate
```

### 5. Configure Database

Edit the `.env` file with your database credentials:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=innovior_student_system
DB_USERNAME=root
DB_PASSWORD=your_password
```

Create the database:
```bash
mysql -u root -p
CREATE DATABASE innovior_student_system;
exit;
```

### 6. Run Migrations and Seeders

```bash
php artisan migrate --seed
```

This will create all necessary tables and populate them with sample data.

### 7. Configure Mail (Optional)

For email notifications, update the mail settings in `.env`:

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your_username
MAIL_PASSWORD=your_password
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="noreply@innovior.com"
```

### 8. Build Assets

```bash
npm run build
```

For development:
```bash
npm run dev
```

### 9. Storage Permissions

Ensure storage and cache directories are writable:

```bash
chmod -R 775 storage bootstrap/cache
```

### 10. Start the Development Server

```bash
php artisan serve
```

The application will be available at `http://localhost:8000`

## Default Login Credentials

### Admin Account
- **Email:** admin@innovior.com
- **Password:** password

### Reception Account
- **Email:** reception@innovior.com
- **Password:** password

## Troubleshooting

### Common Issues

1. **Composer install fails**
   - Try: `composer install --ignore-platform-reqs`
   - Or update your PHP version

2. **Migration errors**
   - Check database credentials in `.env`
   - Ensure database exists
   - Try: `php artisan migrate:fresh --seed`

3. **Permission denied errors**
   - Run: `chmod -R 775 storage bootstrap/cache`
   - Check folder ownership

4. **500 Server Error**
   - Check `storage/logs/laravel.log` for details
   - Ensure `.env` file exists and is configured
   - Run: `php artisan config:clear`

5. **Assets not loading**
   - Run: `npm run build`
   - Clear browser cache

## Production Deployment

For production deployment:

1. Set `APP_ENV=production` in `.env`
2. Set `APP_DEBUG=false` in `.env`
3. Run: `php artisan config:cache`
4. Run: `php artisan route:cache`
5. Run: `php artisan view:cache`
6. Use a proper web server (Apache/Nginx)
7. Set up SSL certificate
8. Configure proper database backups

## Next Steps

After installation:
1. Login with the default credentials
2. Explore the Admin and Reception panels
3. Register test students
4. Record test payments
5. Try the QR scanner functionality
6. Generate PDF reports

For more information, see the main [README.md](README.md)
