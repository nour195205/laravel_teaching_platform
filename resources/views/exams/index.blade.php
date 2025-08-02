@extends('layouts.naa')

@section('title', 'الامتحانات المتاحة')

@section('content')
    <div class="container py-5">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-4">الامتحانات المتاحة</h2>
            <a href="{{ route('exams.create') }}" class="btn btn-primary">إضافة امتحان جديد</a>
        </div>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if ($exams->isEmpty())
            <div class="alert alert-info">
                لا يوجد امتحانات متاحة حالياً لصفك الدراسي.
            </div>
        @else
            <div class="row row-cols-1 row-cols-md-2 g-4">
                @foreach ($exams as $exam)
                    <div class="col">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title">{{ $exam->title }}</h5>
                                <p class="card-text">
                                    <strong>متاح من:</strong>
                                    {{ $exam->start_time ? $exam->start_time : 'غير محدد' }}<br>
                                    <strong>إلى:</strong>
                                    {{ $exam->end_time ? $exam->end_time : 'غير محدد' }}
                                </p>

                                @if ($exam->is_active && $exam->start_time && $exam->end_time && now()->between($exam->start_time, $exam->end_time))
                                    <a href="{{ route('exams.show', $exam->id) }}" class="btn btn-primary">ابدأ الامتحان</a>
                                @else
                                    <button class="btn btn-secondary" disabled>غير متاح حالياً</button>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection