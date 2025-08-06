<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# TeachingPlatform

منصة تعليمية متكاملة مبنية باستخدام Laravel، تهدف إلى تسهيل إدارة العملية التعليمية إلكترونيًا من خلال لوحة تحكم سهلة الاستخدام باللغة العربية.

---

## وصف المشروع

تتيح المنصة للمدرسين والإداريين إدارة الدروس، المستخدمين، الملازم، الامتحانات والاجتماعات، مع إمكانية التحكم الكامل في المحتوى والعمليات من خلال واجهة ويب متجاوبة تعتمد على Bootstrap.

---

## المميزات الرئيسية

- **إدارة الدروس:** إضافة، تعديل، حذف وعرض الدروس.
- **إدارة المستخدمين:** تعديل بيانات المستخدمين وحذفهم.
- **إدارة الملازم:** رفع وتعديل وحذف الملازم التعليمية.
- **إدارة الامتحانات:** إنشاء وتعديل وحذف الامتحانات وعرض النتائج.
- **إدارة الاجتماعات:** جدولة الاجتماعات وعرض تفاصيلها.
- **تسجيل المستخدمين:** دعم تسجيل مستخدمين جدد من خلال لوحة التحكم.
- **لوحة تحكم متكاملة:** كل العمليات تتم من خلال لوحة تحكم واحدة.

---

## المتطلبات

- PHP >= 8.0
- Composer
- قاعدة بيانات MySQL أو SQLite
- Node.js و npm (لإدارة الموارد الأمامية)

---

## خطوات التشغيل

1. **استنساخ المشروع:**
   ```sh
   git clone <رابط المشروع>
   cd TeachingPlatform
   ```

2. **تثبيت الاعتمادات:**
   ```sh
   composer install
   npm install && npm run dev
   ```

3. **إعداد ملف البيئة:**
   ```sh
   cp .env.example .env
   ```
   ثم عدّل إعدادات قاعدة البيانات في ملف `.env`.

4. **تشغيل الترحيلات:**
   ```sh
   php artisan migrate
   ```

5. **تشغيل السيرفر:**
   ```sh
   php artisan serve
   ```

---

## هيكل المشروع

- `app/Http/Controllers` : جميع الكنترولرز الخاصة بالعمليات (الدروس، المستخدمين، الاجتماعات، الامتحانات، الملازم)
- `resources/views` : ملفات الواجهات (Blade)
- `routes/web.php` : تعريف جميع المسارات الخاصة بالمنصة
- `database/migrations` : ملفات إنشاء الجداول
- `public/` : ملفات الدخول والصور والستايلات

---

## المساهمة

للمساهمة يرجى فتح طلب سحب (Pull Request) أو التواصل عبر البريد الإلكتروني.

---

## الرخصة

المشروع مرخص تحت رخصة MIT.
