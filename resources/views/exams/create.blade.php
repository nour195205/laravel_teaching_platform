@extends('layouts.dashboard') {{-- الناف بار بتاع لوحة التحكم --}}

@section('title', 'إضافة اختبار جديد')

@section('content')
    <div class="container py-5">
        <h2 class="mb-4">إضافة اختبار جديد</h2>

        {{-- رسائل الخطأ --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- النموذج --}}
        <form method="POST" action="{{ route('exams.store') }}">
            @csrf

            <div class="mb-3">
                <label for="title" class="form-label">عنوان الاختبار</label>
                <input type="text" name="title" class="form-control" required value="{{ old('title') }}">
            </div>

            <div class="mb-3">
                <label for="grade" class="form-label">السنة الدراسية</label>
                <select name="grade" class="form-select" required>
                    <option value="" disabled selected>اختر السنة</option>
                    <option value="first" {{ old('grade') == 'first' ? 'selected' : '' }}>أولى</option>
                    <option value="second" {{ old('grade') == 'second' ? 'selected' : '' }}>ثانية</option>
                    <option value="third" {{ old('grade') == 'third' ? 'selected' : '' }}>ثالثة</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="embed_code" class="form-label">كود التضمين (Embed Code)</label>
                <textarea name="embed_code" class="form-control" rows="6" required>{{ old('embed_code') }}</textarea>
                <small class="text-muted">الصق هنا كود Google Form المضمن (iframe).</small>
            </div>

            <div class="mb-3">
                <label for="start_time" class="form-label">تاريخ البداية (اختياري)</label>
                <input type="datetime-local" name="start_time" class="form-control" value="{{ old('start_time') }}">
            </div>

            <div class="mb-3">
                <label for="end_time" class="form-label">تاريخ النهاية (اختياري)</label>
                <input type="datetime-local" name="end_time" class="form-control" value="{{ old('end_time') }}">
            </div>

            <div class="mb-3">
                <label for="is_active" class="form-label">حالة الاختبار</label>
                <select name="is_active" id="is_active" class="form-select" required>
                    <option value="1" {{ old('is_active', $exam->is_active ?? 1) == 1 ? 'selected' : '' }}>نشط</option>
                    <option value="0" {{ old('is_active', $exam->is_active ?? 1) == 0 ? 'selected' : '' }}>غير نشط</option>
                </select>
            </div>




            <button type="submit" class="btn btn-success">إضافة</button>
        </form>
    </div>
@endsection