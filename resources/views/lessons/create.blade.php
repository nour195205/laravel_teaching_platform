@extends('layouts.naa')

@section('content')
    <div class="container py-5">
        <h2 class="mb-4">إضافة درس جديد</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('lessons.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="title" class="form-label">عنوان الدرس</label>
                <input type="text" name="title" id="title" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">وصف الدرس</label>
                <textarea name="description" id="description" class="form-control" rows="4" required></textarea>
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
                <label for="video_url" class="form-label">رابط الفيديو</label>
                <input type="url" name="video_url" id="video_url" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="attachment" class="form-label">ملف مرفق (اختياري)</label>
                <input type="file" name="attachment" id="attachment" class="form-control" accept=".pdf,.doc,.docx,.zip">
            </div>

            <button type="submit" class="btn btn-primary">حفظ الدرس</button>
        </form>
    </div>
@endsection