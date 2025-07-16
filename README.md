# پروژه آدمک 3 (Adamak 3)

سیستم مدیریت کاربران مبتنی بر Laravel و Filament با احراز هویت شماره موبایل

## ویژگی‌های کلیدی

- 🔐 **احراز هویت مبتنی بر شماره موبایل** - به جای ایمیل از شماره موبایل استفاده می‌کند
- 👤 **مدیریت کاربران پیشرفته** - سیستم کامل مدیریت پروفایل کاربران
- 🛡️ **کنترل دسترسی** - سیستم نقش‌ها و مجوزها با Spatie Permission
- 📊 **پنل ادمین مدرن** - رابط کاربری زیبا و کاربردی با Filament v3
- ⚡ **عملکرد بالا** - بهینه‌سازی شده برای سرعت و مقیاس‌پذیری

## تکنولوژی‌های استفاده شده

- **Backend**: Laravel 12.x + PHP 8.2+
- **Admin Panel**: Filament v3.3
- **UI Framework**: Tailwind CSS v4
- **Real-time**: Livewire v3.6
- **Database**: SQLite (قابل تغییر به MySQL/PostgreSQL)
- **Build Tool**: Vite v6.2

## نصب و راه‌اندازی

### پیش‌نیازها

- PHP 8.2 یا بالاتر
- Composer
- Node.js 18+ و npm
- Git

### مراحل نصب

1. **کلون کردن پروژه**
```bash
git clone https://github.com/modernandishan/adamak_3.git
cd adamak_3
```

2. **نصب dependencies**
```bash
composer install
npm install
```

3. **پیکربندی environment**
```bash
cp .env.example .env
php artisan key:generate
```

4. **ایجاد دیتابیس**
```bash
touch database/database.sqlite
php artisan migrate
```

5. **ایجاد کاربر ادمین (اختیاری)**
```bash
php artisan make:filament-user
```

6. **اجرای سرور توسعه**
```bash
composer run dev
```

سایت در آدرس `http://localhost:8000` در دسترس خواهد بود.
پنل ادمین در آدرس `http://localhost:8000/admin` قابل دسترسی است.

## ساختار پروژه

```
adamak_3/
├── app/
│   ├── Filament/          # کامپوننت‌های پنل ادمین
│   ├── Models/            # مدل‌های دیتابیس (User, Profile)
│   ├── Policies/          # سیاست‌های دسترسی
│   └── Providers/         # ارائه‌دهندگان سرویس
├── database/
│   ├── migrations/        # فایل‌های migration
│   └── factories/         # Factory ها برای تست
├── resources/
│   ├── views/            # فایل‌های Blade
│   └── js/               # فایل‌های JavaScript
└── config/               # فایل‌های پیکربندی
```

## راهنمای توسعه

### اجرای تست‌ها
```bash
composer run test
```

### اصلاح کد (Linting)
```bash
./vendor/bin/pint
```

### ساخت برای production
```bash
npm run build
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

## مستندات

- 📋 [تحلیل پروژه](PROJECT_ANALYSIS.md) - تحلیل کامل معماری و ویژگی‌ها
- 🔧 [مشخصات فنی](TECHNICAL_SPECS.md) - جزئیات فنی و پیکربندی‌ها  
- 🗺️ [نقشه راه توسعه](DEVELOPMENT_ROADMAP.md) - برنامه توسعه و timeline

## API (در حال توسعه)

API endpoints برای موبایل اپ:

```
POST   /api/v1/auth/login      # ورود با شماره موبایل
POST   /api/v1/auth/register   # ثبت نام
GET    /api/v1/user           # پروفایل کاربر
PUT    /api/v1/user           # به‌روزرسانی پروفایل
```

## مشارکت در پروژه

1. Fork کنید
2. یک branch جدید ایجاد کنید (`git checkout -b feature/amazing-feature`)
3. تغییرات خود را commit کنید (`git commit -m 'Add amazing feature'`)
4. Push کنید (`git push origin feature/amazing-feature`)
5. یک Pull Request ایجاد کنید

## مجوز

این پروژه تحت مجوز [MIT License](LICENSE) منتشر شده است.

## پشتیبانی

- 📧 ایمیل: [support@example.com](mailto:support@example.com)
- 📱 تلگرام: [@support_channel](https://t.me/support_channel)
- 🐛 گزارش باگ: [GitHub Issues](https://github.com/modernandishan/adamak_3/issues)

---

**نسخه**: 1.0.0  
**آخرین به‌روزرسانی**: ۲۶ دی ۱۴۰۳  
**توسعه‌دهنده**: تیم مدرن اندیشان
