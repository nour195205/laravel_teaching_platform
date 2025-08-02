@extends('layouts.dashboard')

@section('title', 'إضافة اجتماع جديد')

@section('content')
    <div class="container py-5">
        <h2 class="mb-4">إضافة اجتماع جديد</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('meetings.store') }}">
            @csrf

            <div class="mb-3">
                <label for="title" class="form-label">عنوان الاجتماع</label>
                <input type="text" name="title" id="title" class="form-control" required value="{{ old('title') }}">
            </div>

            <div class="mb-3">
                <label for="grade" class="form-label">الصف الدراسي</label>
                <select name="grade" id="grade" class="form-select" required>
                    <option disabled selected>اختر الصف</option>
                    <option value="first">الصف الأول</option>
                    <option value="second">الصف الثاني</option>
                    <option value="third">الصف الثالث</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="embed_code" class="form-label">كود التضمين (Embed Code)</label>
                <textarea name="embed_code" id="embed_code" class="form-control" rows="5"
                    required>{{ old('embed_code') }}</textarea>
                <small class="text-muted">قم بلصق كود iframe الخاص بـ Jitsi هنا.</small>
            </div>

            <div class="mb-3">
                <label for="start_time" class="form-label">وقت بدء الاجتماع (اختياري)</label>
                <input type="datetime-local" name="start_time" id="start_time" class="form-control"
                    value="{{ old('start_time') }}">
            </div>

            <div class="mb-3">
                <label for="is_active" class="form-label">حالة الاختبار</label>
                <select name="is_active" id="is_active" class="form-select" required>
                    <option value="1" {{ old('is_active', $exam->is_active ?? 1) == 1 ? 'selected' : '' }}>نشط</option>
                    <option value="0" {{ old('is_active', $exam->is_active ?? 1) == 0 ? 'selected' : '' }}>غير نشط</option>
                </select>
            </div>

            <button type="submit" class="btn btn-success">إنشاء الاجتماع</button>
        </form>
    </div>
@endsection