# مشخصات فنی پروژه adamak_3

## نمای کلی معماری

### الگوی معماری
- **Pattern**: MVC (Model-View-Controller)
- **Architecture**: Monolithic with modular structure
- **Design**: Domain-driven design principles

### ساختار دایرکتوری‌ها

```
adamak_3/
├── app/                    # کد اصلی اپلیکیشن
│   ├── Filament/          # کامپوننت‌های Filament
│   │   ├── Pages/         # صفحات سفارشی
│   │   │   ├── Auth/      # صفحات احراز هویت
│   │   │   │   ├── Login.php
│   │   │   │   └── Register.php
│   │   │   └── EditProfile.php
│   │   └── Admin/         # منابع پنل ادمین
│   ├── Http/              # Controllers و Middleware
│   ├── Models/            # مدل‌های Eloquent
│   │   ├── User.php
│   │   └── Profile.php
│   ├── Policies/          # سیاست‌های دسترسی
│   └── Providers/         # Service Providers
├── config/                # فایل‌های پیکربندی
├── database/              # Migration ها و Seeders
├── resources/             # Views و Assets
└── routes/                # تعریف Route ها
```

## پیکربندی‌های کلیدی

### 1. احراز هویت سفارشی

**User Model** (`app/Models/User.php`):
```php
protected $fillable = [
    'name',        // نام
    'family',      // نام خانوادگی  
    'mobile',      // شماره موبایل (یکتا)
    'password',    // رمز عبور
];

// استفاده از mobile به جای email
protected function casts(): array
{
    return [
        'mobile_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}
```

**Database Schema**:
```sql
-- جدول کاربران
users:
  - id (bigint, primary key)
  - name (varchar)
  - family (varchar)
  - mobile (varchar, unique)
  - mobile_verified_at (timestamp, nullable)
  - password (varchar)
  - remember_token (varchar, nullable)
  - timestamps

-- جدول بازیابی رمز عبور
password_reset_tokens:
  - mobile (varchar, primary key)
  - token (varchar)
  - created_at (timestamp)
```

### 2. پنل ادمین Filament

**AdminPanelProvider** (`app/Providers/Filament/AdminPanelProvider.php`):
```php
$panel
    ->id('admin')
    ->path('admin')
    ->login()                    // فعال‌سازی صفحه ورود
    ->registration()             // فعال‌سازی ثبت نام
    ->passwordReset()            // فعال‌سازی بازیابی رمز
    ->colors([
        'primary' => Color::Amber,  // رنگ اصلی: نارنجی
    ])
    ->plugins([
        FilamentShieldPlugin::make(),  // پلاگین مجوزها
    ]);
```

### 3. سیستم مجوزها

**Packages Used**:
- `spatie/laravel-permission`: مدیریت نقش‌ها و مجوزها
- `bezhansalleh/filament-shield`: ادغام با Filament

**User Model Integration**:
```php
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;
    // ...
}
```

## Dependencies و Packages

### Core Dependencies
```json
{
  "php": "^8.2",
  "laravel/framework": "^12.0",
  "filament/filament": "^3.3",
  "livewire/livewire": "^3.6",
  "bezhansalleh/filament-shield": "^3.3"
}
```

### Development Dependencies
```json
{
  "fakerphp/faker": "^1.23",
  "laravel/pint": "^1.13",        // Code Style Fixer
  "laravel/sail": "^1.41",        // Docker Development
  "phpunit/phpunit": "^11.5.3"    // Testing Framework
}
```

### Frontend Dependencies
```json
{
  "@tailwindcss/vite": "^4.0.0",
  "tailwindcss": "^4.0.0",
  "vite": "^6.2.4",
  "laravel-vite-plugin": "^1.2.0"
}
```

## Environment Configuration

### Database
```env
DB_CONNECTION=sqlite
DB_DATABASE=database/database.sqlite
```

### Application
```env
APP_NAME="Adamak 3"
APP_ENV=local
APP_DEBUG=true
APP_TIMEZONE=Asia/Tehran
```

## Performance & Optimization

### Caching Strategy
- **Config Cache**: `php artisan config:cache`
- **Route Cache**: `php artisan route:cache`
- **View Cache**: `php artisan view:cache`

### Database Optimization
- **Indexes**: mobile field در جدول users
- **Foreign Keys**: برای حفظ یکپارچگی داده
- **Soft Deletes**: قابل پیاده‌سازی برای کاربران

## Security Features

### 1. Authentication Security
- Password hashing with bcrypt
- CSRF protection
- Session management
- Mobile verification system

### 2. Authorization
- Role-based access control (RBAC)
- Permission-based restrictions
- Policy-driven authorization

### 3. Input Validation
- Form validation through Filament
- CSRF token validation
- XSS protection

## Development Workflow

### Available Scripts
```bash
# Development server
composer run dev

# Testing
composer run test

# Code style fixing
./vendor/bin/pint

# Database operations
php artisan migrate
php artisan db:seed
```

### Git Workflow
```bash
# مراحل توسعه
git checkout -b feature/new-feature
# development work
git add .
git commit -m "Add new feature"
git push origin feature/new-feature
```

## Deployment Considerations

### Production Requirements
- PHP 8.2+
- Composer
- Node.js 18+ (for asset compilation)
- Database (MySQL/PostgreSQL recommended)

### Build Process
```bash
composer install --optimize-autoloader --no-dev
npm run build
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

## API Design (Future Development)

### Planned Endpoints
```
GET    /api/user              # پروفایل کاربر
PUT    /api/user              # به‌روزرسانی پروفایل
POST   /api/auth/login        # ورود
POST   /api/auth/register     # ثبت نام
POST   /api/auth/logout       # خروج
```

## Monitoring & Logging

### Logging Configuration
```php
// config/logging.php
'channels' => [
    'stack' => [
        'driver' => 'stack',
        'channels' => ['single'],
    ],
]
```

### Error Handling
- Exception handling through Laravel's built-in system
- Custom error pages for production
- Detailed error reporting in development

---

**Document Version**: 1.0  
**Last Updated**: July 16, 2025  
**Maintainer**: Development Team