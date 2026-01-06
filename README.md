# Innovior Student Registration & Payment Tracking System

A robust Student Registration & Payment Tracking System built with Laravel, MySQL, and Tailwind CSS. This comprehensive web application features a dual-panel architecture (Admin/Reception) with QR code automation, PDF report generation, role-based authentication, and automated payment notifications.

## 🚀 Features

### Core Functionality
- **Dual-Panel Architecture**: Separate interfaces for Admin and Reception roles
- **Student Management**: Complete CRUD operations for student records
- **Payment Tracking**: Record and monitor student payments with multiple payment types
- **Attendance System**: QR code-based check-in/check-out system
- **PDF Report Generation**: Dynamic reports for students, payments, and attendance
- **Automated Notifications**: Email notifications for payment confirmations and reminders
- **QR Code Integration**: Automatic QR code generation for each student

### Admin Panel Features
- Comprehensive dashboard with key metrics
- Student management and monitoring
- Payment overview and tracking
- Attendance monitoring
- Advanced reporting capabilities

### Reception Panel Features
- Student registration with QR code generation
- Payment recording and processing
- QR code scanner for attendance
- Quick access to student information
- Payment history tracking

## 🛠️ Technology Stack

- **Backend**: Laravel 11/12 (PHP 8.1+)
- **Database**: MySQL
- **Frontend**: Tailwind CSS
- **QR Code**: SimpleSoftwareIO/simple-qrcode
- **PDF Generation**: Barryvdh/laravel-dompdf
- **Authentication**: Laravel Sanctum

## 📋 Requirements

- PHP 8.1 or higher
- Composer
- MySQL 5.7+ or MariaDB 10.3+
- Node.js & NPM (for asset compilation)

## 🔧 Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/Pawan-Dananjaya/Innovior-Student-Registration-and-Payment-Tracking-System-Laravel.git
   cd Innovior-Student-Registration-and-Payment-Tracking-System-Laravel
   ```

2. **Install dependencies**
   ```bash
   composer install
   npm install
   ```

3. **Environment configuration**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Configure database**
   Edit `.env` file:
   ```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=innovior_student_system
   DB_USERNAME=root
   DB_PASSWORD=your_password
   ```

5. **Run migrations and seeders**
   ```bash
   php artisan migrate --seed
   ```

6. **Start the development server**
   ```bash
   php artisan serve
   ```

7. **Access the application**
   Open your browser and navigate to `http://localhost:8000`

## 👥 Default Credentials

### Admin Account
- Email: `admin@innovior.com`
- Password: `password`

### Reception Account
- Email: `reception@innovior.com`
- Password: `password`

## 📱 Usage

### Admin Users
1. Login with admin credentials
2. Access the admin dashboard
3. Manage students, view payments, check attendance
4. Generate comprehensive reports

### Reception Users
1. Login with reception credentials
2. Register new students (automatic QR code generation)
3. Record student payments
4. Scan QR codes for attendance tracking
5. View student and payment information

### QR Code Attendance
1. Navigate to QR Scanner in Reception panel
2. Enter or scan student ID
3. First scan = Check-in
4. Second scan (same day) = Check-out

## 📊 Features in Detail

### Student Management
- Complete student profiles
- Enrollment tracking
- Course assignment
- Status management (Active/Inactive/Graduated)
- QR code generation

### Payment System
- Multiple payment types (Tuition, Registration, Exam, Library, Other)
- Payment status tracking (Paid, Pending, Overdue, Cancelled)
- Reference number generation
- Payment history
- Automated notifications

### Attendance Tracking
- QR code-based check-in/check-out
- Daily attendance records
- Status tracking (Present, Late, Absent, Excused)
- Attendance reports

### Reporting
- Student comprehensive reports
- Payment transaction reports
- Attendance summaries
- System-wide statistics
- PDF export functionality

## 🔒 Security Features

- Role-based access control (Admin/Reception)
- Secure authentication
- Password hashing
- CSRF protection
- SQL injection prevention
- XSS protection

## 🗂️ Project Structure

```
├── app/
│   ├── Http/Controllers/     # Application controllers
│   ├── Models/               # Eloquent models
│   ├── Mail/                 # Email notifications
│   └── Http/Middleware/      # Custom middleware
├── database/
│   ├── migrations/           # Database migrations
│   └── seeders/              # Database seeders
├── resources/
│   └── views/                # Blade templates
│       ├── admin/            # Admin panel views
│       ├── reception/        # Reception panel views
│       ├── reports/          # PDF report templates
│       └── emails/           # Email templates
├── routes/
│   └── web.php              # Web routes
└── public/                  # Public assets
```

## 🤝 Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

## 📄 License

This project is open-sourced software licensed under the MIT license.

## 📞 Support

For support, email support@innovior.com or open an issue in the repository.

## 🏷️ Tags

`#Laravel` `#TailwindCSS` `#MySQL` `#WebDevelopment` `#StudentManagementSystem` `#QRCode` `#AttendanceSystem` `#Automation` `#SoftwareDevelopment` `#PaymentTracking` `#PDFReports`