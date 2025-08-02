<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'منصة الفيزياء')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ url('/') }}">منصة الفيزياء</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="mainNavbar">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link" href="{{ route('lessons.index') }}">الحصص</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('materials.index') }}">الملازم</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('exams.index') }}">الامتحانات</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('meetings.index') }}">الاجتماعات</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">تواصل معنا</a></li>

                    @auth
                        @if(Auth::user()->type === 'admin')
                            <li class="nav-item"><a class="nav-link text-danger fw-bold" href="{{ route('dashboard') }}">لوحة
                                    التحكم</a></li>
                        @endif
                        <li class="nav-item"><a class="nav-link" href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">تسجيل
                                الخروج</a></li>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
                    @else
                        <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">تسجيل الدخول</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">إنشاء حساب</a></li>
                    @endauth
                    @auth
                        @if(Auth::user()->role === 'admin')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('dashboard') }}">لوحة التحكم</a>
                            </li>
                        @endif
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- Page Content -->
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