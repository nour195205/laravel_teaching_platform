@extends('layouts.dashboard')

@section('title', 'تعديل الدرس')

@section('content')
<div class="container py-5">
    <h2 class="mb-4">تعديل الدرس</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('lessons.update', $lesson->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="title" class="form-label">عنوان الدرس</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $lesson->title) }}" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">الوصف</label>
            <textarea name="description" id="description" class="form-control" rows="4" required>{{ old('description', $lesson->description) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="grade" class="form-label">الصف الدراسي</label>
            <select name="grade" id="grade" class="form-select" required>
                <option value="first" {{ $lesson->grade == 'first' ? 'selected' : '' }}>أولى</option>
                <option value="second" {{ $lesson->grade == 'second' ? 'selected' : '' }}>ثانية</option>
                <option value="third" {{ $lesson->grade == 'third' ? 'selected' : '' }}>ثالثة</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="video_url" class="form-label">رابط الفيديو</label>
            <input type="url" name="video_url" id="video_url" class="form-control" value="{{ old('video_url', $lesson->video_url) }}" required>
        </div>

        <div class="mb-3">
            <label for="attachment" class="form-label">ملف مرفق (اختياري)</label>
            <input type="file" name="attachment" id="attachment" class="form-control">
            @if ($lesson->attachment)
                <small class="text-muted d-block mt-2">
                    الملف الحالي:
                    <a href="{{ asset('storage/' . $lesson->attachment) }}" target="_blank">عرض / تحميل</a>
                </small>
            @endif
        </div>

        <button type="submit" class="btn btn-primary">تحديث الدرس</button>
    </form>
</div>
@endsection
