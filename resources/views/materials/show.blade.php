@extends('layouts.naa')

@section('title', $material->title)

@section('content')
<div class="container py-5">
    <h2 class="mb-3">{{ $material->title }}</h2>

    <p class="text-muted">{{ $material->description }}</p>

    @if ($material->file)
        <div class="mt-4">
            <h5>الملف المرفق:</h5>
            <a href="{{ asset('storage/' . $material->file) }}" class="btn btn-outline-primary" target="_blank">
                تحميل الملف
            </a>
        </div>
    @else
        <div class="alert alert-warning mt-4">لا يوجد ملف مرفق.</div>
    @endif

    <div class="mt-5">
        <a href="{{ route('materials.index') }}" class="btn btn-secondary">رجوع للملازم</a>
    </div>
</div>
@endsection
