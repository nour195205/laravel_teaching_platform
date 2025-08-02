@extends('layouts.dashboard')

@section('title', 'تعديل اجتماع')

@section('content')
    <div class="container py-5">
        <h2 class="mb-4">تعديل الاجتماع</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('meetings.update', $meeting->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="title" class="form-label">عنوان الاجتماع</label>
                <input type="text" name="title" class="form-control" value="{{ old('title', $meeting->title) }}" required>
            </div>

            <div class="mb-3">
                <label for="grade" class="form-label">السنة الدراسية</label>
                <select name="grade" class="form-select" required>
                    <option disabled selected>اختر السنة</option>
                    @foreach (['first' => 'أولى', 'second' => 'ثانية', 'third' => 'ثالثة'] as $key => $label)
                        <option value="{{ $key }}" {{ old('grade', $meeting->grade) === $key ? 'selected' : '' }}>
                            {{ $label }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="embed_code" class="form-label">كود التضمين (Embed Code)</label>
                <textarea name="embed_code" class="form-control" rows="5"
                    required>{{ old('embed_code', $meeting->embed_code) }}</textarea>
            </div>

            <div class="mb-3">
                <label for="start_time" class="form-label">وقت البدء</label>
                <input type="datetime-local" name="start_time" class="form-control"
                    value="{{ old('start_time', $meeting->start_time ? \Carbon\Carbon::parse($meeting->start_time)->format('Y-m-d\TH:i') : '') }}">
            </div>

            <div class="mb-3">
                <label for="is_active" class="form-label">حالة الاختبار</label>
                <select name="is_active" id="is_active" class="form-select" required>
                    <option value="1" {{ old('is_active', $exam->is_active ?? 1) == 1 ? 'selected' : '' }}>نشط</option>
                    <option value="0" {{ old('is_active', $exam->is_active ?? 1) == 0 ? 'selected' : '' }}>غير نشط</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">حفظ التعديلات</button>
            <a href="{{ route('dashboard.meetings.index') }}" class="btn btn-secondary">رجوع</a>
        </form>
    </div>
@endsection