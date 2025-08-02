@extends('layouts.naa')

@section('title', 'إضافة ملزمة جديدة')

@section('content')
<div class="container py-5">
    <h2 class="mb-4">إضافة ملزمة / كتاب</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('materials.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="title" class="form-label">عنوان الملزمة</label>
            <input type="text" name="title" id="title" class="form-control" required value="{{ old('title') }}">
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">وصف (اختياري)</label>
            <textarea name="description" id="description" class="form-control" rows="3">{{ old('description') }}</textarea>
        </div>

        <div class="mb-3">
            <label for="grade" class="form-label">الصف الدراسي</label>
            <select name="grade" id="grade" class="form-select" required>
                <option disabled selected>اختر الصف</option>
                <option value="first">أولى</option>
                <option value="second">ثانية</option>
                <option value="third">ثالثة</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="file" class="form-label">الملف (PDF أو ZIP أو DOCX)</label>
            <input type="file" name="file" id="file" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">رفع الملزمة</button>
    </form>
</div>
@endsection
