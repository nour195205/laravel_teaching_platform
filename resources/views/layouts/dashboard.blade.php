<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'لوحة التحكم')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
</head>
<body>

    <!-- Navbar خاص بالداشبورد -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold text-white" href="{{ route('dashboard') }}">لوحة التحكم</a>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link text-white" href="{{ route('dashboard') }}">الدروس</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="{{ route('dashboard.users.index') }}">المستخدمين</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="{{ route('materials.dashboard') }}">الملازم</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="{{ route('exams.dashboard') }}">الامتحانات</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="{{ route('dashboard.meetings.index') }}">الاجتماعات</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="{{ route('lessons.index') }}">كل الدروس</a></li>
                    <li class="nav-item">
                        <a class="nav-link text-danger" href="{{ route('logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">تسجيل الخروج</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- محتوى الصفحة -->
    <main class="py-4">
        <div class="container">
            @yield('content')
        </div>
    </main>

    <footer class="bg-dark text-white text-center py-3 mt-5">
    <div class="container">
        <small>
            تم التصميم بواسطة
            <a href="https://nour-ashour-portfolio.netlify.app/" class="text-warning text-decoration-none" target="_blank">
                NAA
            </a>
        </small>
    </div>
</footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
