<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل حساب جديد</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #3498db;
            --secondary-color: #2c3e50;
            --error-color: #e74c3c;
        }

        body {
            background: linear-gradient(135deg, #f5f5f5 0%, #e0e0e0 100%);
            font-family: 'Tajawal', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            padding: 20px;
        }

        .auth-box {
            background: white;
            padding: 2.5rem;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            width: 100%;
            max-width: 500px;
            transition: transform 0.3s ease;
        }

        .auth-box:hover {
            transform: translateY(-5px);
        }

        h2 {
            color: var(--secondary-color);
            font-weight: 700;
            margin-bottom: 1.5rem;
            font-size: 1.8rem;
        }

        .form-label {
            font-weight: 500;
            margin-bottom: 0.5rem;
            color: var(--secondary-color);
        }

        .form-control {
            padding: 0.75rem 1rem;
            border-radius: 8px;
            border: 1px solid #ddd;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(52, 152, 219, 0.25);
        }

        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            padding: 0.75rem;
            font-weight: 500;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #2980b9;
            border-color: #2980b9;
            transform: translateY(-2px);
        }

        .text-danger {
            color: var(--error-color) !important;
            font-size: 0.85rem;
            margin-top: 0.25rem;
            display: block;
        }

        a {
            color: var(--primary-color);
            text-decoration: none;
            transition: color 0.2s ease;
        }

        a:hover {
            color: #2980b9;
            text-decoration: underline;
        }

        small {
            color: #666;
        }

        @media (max-width: 576px) {
            .auth-box {
                padding: 1.5rem;
            }

            h2 {
                font-size: 1.5rem;
            }
        }
    </style>
</head>

<body>

    <div class="auth-box">
        <h2 class="text-center mb-4">تسجيل حساب جديد</h2>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- الاسم الكامل -->
            <div class="mb-3">
                <label for="name" class="form-label">اسم الطالب</label>
                <input type="text" name="name" id="name" class="form-control" required value="{{ old('name') }}">
            </div>

            <!-- البريد الإلكتروني -->
            <div class="mb-3">
                <label for="email" class="form-label">البريد الإلكتروني</label>
                <input type="email" name="email" id="email" class="form-control" required value="{{ old('email') }}">
            </div>

            <!-- رقم الموبايل -->
            <div class="mb-3">
                <label for="phone" class="form-label">رقم الطالب</label>
                <input type="text" name="phone" id="phone" class="form-control" required value="{{ old('phone') }}">
            </div>

            <!-- اسم ولي الأمر -->
            <div class="mb-3">
                <label for="guardian_name" class="form-label">اسم ولي الأمر</label>
                <input type="text" name="guardian_name" id="guardian_name" class="form-control" required
                    value="{{ old('guardian_name') }}">
            </div>

            <!-- رقم ولي الأمر -->
            <div class="mb-3">
                <label for="guardian_phone" class="form-label">رقم ولي الأمر</label>
                <input type="text" name="guardian_phone" id="guardian_phone" class="form-control" required
                    value="{{ old('guardian_phone') }}">
            </div>

            <!-- الصف الدراسي -->
            <div class="mb-3">
                <label for="grade" class="form-label">السنة الدراسية</label>
                <select name="grade" id="grade" class="form-select" required>
                    <option value="">اختر السنة الدراسية</option>
                    <option value="first">أولى ثانوي</option>
                    <option value="second">ثانية ثانوي</option>
                    <option value="third">ثالثة ثانوي</option>
                </select>
            </div>

            <!-- كلمة المرور -->
            <div class="mb-3">
                <label for="password" class="form-label">كلمة المرور</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>

            <!-- تأكيد كلمة المرور -->
            <div class="mb-3">
                <label for="password_confirmation" class="form-label">تأكيد كلمة المرور</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control"
                    required>
            </div>

            <button type="submit" class="btn btn-primary w-100 mb-3">إنشاء حساب</button>

            <div class="text-center mt-3">
                <small>لديك حساب بالفعل؟ <a href="{{ route('login') }}">سجل الدخول الآن</a></small>
            </div>
        </form>
    </div>

</body>

</html>