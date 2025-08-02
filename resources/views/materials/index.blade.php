@extends('layouts.naa')

@section('title', 'الملازم والكتب')

@section('content')
<div class="container py-5">
    <h2 class="mb-4">الملازم والكتب الدراسية</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @php
        $grouped = $materials->groupBy('grade');
        $grades = [
            'first' => 'الصف الأول الثانوي',
            'second' => 'الصف الثاني الثانوي',
            'third' => 'الصف الثالث الثانوي',
        ];
    @endphp

    @forelse($grouped as $grade => $group)
        <div class="mb-5">
            <h4 class="text-primary border-bottom pb-2">{{ $grades[$grade] ?? $grade }}</h4>
            <div class="row">
                @foreach($group as $material)
                    <div class="col-md-6 mb-4">
                        <div class="card shadow-sm h-100">
                            <div class="card-body">
                                <h5 class="card-title">{{ $material->title }}</h5>
                                <p class="card-text text-muted">{{ $material->description }}</p>
                                <a href="{{ asset('storage/' . $material->file) }}" class="btn btn-outline-primary" target="_blank">
                                    تحميل الملف
                                </a>
                                @auth
                                    @if(auth()->user()->role === 'admin')
                                        <form action="{{ route('materials.destroy', $material->id) }}" method="POST" class="d-inline"
                                            onsubmit="return confirm('هل أنت متأكد من الحذف؟')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger ms-2">حذف</button>
                                        </form>
                                    @endif
                                @endauth
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @empty
        <div class="alert alert-info">لا توجد ملازم مضافة بعد.</div>
    @endforelse
</div>
@endsection
