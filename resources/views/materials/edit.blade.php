@extends('layouts.naa')

@section('title', 'تعديل الملازم')

@section('content')
<div class="container py-5">
    <h2 class="mb-4">تعديل الملازم</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('materials.update', $material->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="title" class="form-label">عنوان الملازم</label>
            <input type="text" name="title" id="title" class="form-control"
                value="{{ old('title', $material->title) }}" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">وصف الملازم</label>
            <textarea name="description" id="description" class="form-control" rows="4" required>{{ old('description', $material->description) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="grade" class="form-label">الصف الدراسي</label>
            <select name="grade" id="grade" class="form-select" required>
                <option disabled>اختر الصف</option>
                <option value="first" {{ $material->grade === 'first' ? 'selected' : '' }}>أولى</option>
                <option value="second" {{ $material->grade === 'second' ? 'selected' : '' }}>ثانية</option>
                <option value="third" {{ $material->grade === 'third' ? 'selected' : '' }}>ثالثة</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="file" class="form-label">الملف (اختياري)</label>
            <input type="file" name="file" id="file" class="form-control">
            @if ($material->file)
                <small class="text-muted">حالياً: 
                    <a href="{{ asset('storage/' . $material->file) }}" target="_blank">تحميل الملف الحالي</a>
                </small>
            @endif
        </div>

        <button type="submit" class="btn btn-primary">حفظ التعديلات</button>
    </form>
</div>
@endsection
