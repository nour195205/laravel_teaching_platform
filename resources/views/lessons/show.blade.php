@extends('layouts.naa')

@section('title', $lesson->title)

@section('content')
    <div class="container py-5">
        <h2 class="mb-4">{{ $lesson->title }}</h2>

        <div class="mb-4">
            <div class="ratio ratio-16x9">
                <video controls class="w-100" style="max-height: 500px;">
                    <source src="{{ $lesson->video_url }}" type="video/mp4">
                    متصفحك لا يدعم تشغيل الفيديو.
                </video>

            </div>
        </div>

        <div class="mb-3">
            <h5 class="fw-bold">وصف الدرس:</h5>
            <p>{{ $lesson->description }}</p>
        </div>

        @if ($lesson->attachment)
            <div class="mt-4">
                <h5 class="fw-bold">ملف مرفق:</h5>
                <a href="{{ asset('storage/' . $lesson->attachment) }}" class="btn btn-outline-primary" target="_blank">
                    تحميل الملف
                </a>
            </div>
        @endif
    </div>
@endsection