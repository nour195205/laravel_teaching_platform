<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>منصة الفيزياء</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #3498db;
            --secondary-color: #2c3e50;
        }
        
        body {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            font-family: 'Tajawal', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            padding: 20px;
        }
        
        .hero-box {
            background: white;
            padding: 2.5rem;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            text-align: center;
            width: 100%;
            max-width: 500px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .hero-box:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.12);
        }
        
        h1 {
            font-weight: 700;
            color: var(--secondary-color);
            margin-bottom: 1.5rem;
            font-size: 2rem;
        }
        
        p {
            color: #555;
            font-size: 1.1rem;
            line-height: 1.6;
            margin-bottom: 2rem;
        }
        
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            padding: 0.6rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            background-color: #2980b9;
            border-color: #2980b9;
            transform: translateY(-2px);
        }
        
        .btn-outline-secondary {
            border-color: #ddd;
            color: var(--secondary-color);
            padding: 0.6rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .btn-outline-secondary:hover {
            background-color: #f8f9fa;
            border-color: #ccc;
            color: var(--secondary-color);
            transform: translateY(-2px);
        }
        
        @media (max-width: 576px) {
            .hero-box {
                padding: 1.5rem;
            }
            
            h1 {
                font-size: 1.7rem;
            }
            
            p {
                font-size: 1rem;
            }
        }
    </style>
</head>
<body>

    <div class="hero-box">
        <h1>مرحبًا بك في منصة الفيزياء</h1>
        <p class="mb-4">تعلم الفيزياء بطريقة بسيطة ومنظمة مع مدرسك المفضل</p>

        <a href="{{ route('login') }}" class="btn btn-primary w-100 mb-3">تسجيل الدخول</a>
    </div>

</body>
</html>