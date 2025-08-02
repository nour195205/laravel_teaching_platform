@extends('layouts.dashboard') {{-- أو naa لو دي الصفحة الرئيسية للوحة التحكم --}}

@section('title', 'تعديل امتحان')

@section('content')
    <div class="container py-5">
        <h2 class="mb-4">تعديل الامتحان</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('exams.update', $exam->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="title" class="form-label">عنوان الامتحان</label>
                <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $exam->title) }}"
                    required>
            </div>

            <div class="mb-3">
                <label for="grade" class="form-label">الصف الدراسي</label>
                <select name="grade" id="grade" class="form-select" required>
                    <option disabled selected>اختر الصف</option>
                    <option value="first" {{ old('grade', $exam->grade) === 'first' ? 'selected' : '' }}>أولى</option>
                    <option value="second" {{ old('grade', $exam->grade) === 'second' ? 'selected' : '' }}>ثانية</option>
                    <option value="third" {{ old('grade', $exam->grade) === 'third' ? 'selected' : '' }}>ثالثة</option>>
                </select>
            </div>

            <div class="mb-3">
                <label for="embed_code" class="form-label">كود تضمين Google Form</label>
                <textarea name="embed_code" id="embed_code" class="form-control" rows="5"
                    required>{{ old('embed_code', $exam->embed_code) }}</textarea>
            </div>



            <div class="mb-3">
                <label for="is_active" class="form-label">حالة الاختبار</label>
                <select name="is_active" id="is_active" class="form-select" required>
                    <option value="1" {{ old('is_active', $exam->is_active ?? 1) == 1 ? 'selected' : '' }}>نشط</option>
                    <option value="0" {{ old('is_active', $exam->is_active ?? 1) == 0 ? 'selected' : '' }}>غير نشط</option>
                </select>
            </div>


            <div class="mb-3">
                <label for="start_time" class="form-label">بداية إتاحة الامتحان</label>
                <input type="datetime-local" name="start_time" id="start_time" class="form-control"
                    value="{{ old('start_time', str_replace(' ', 'T', $exam->start_time)) }}">



                >
            </div>

            <div class="mb-3">
                <label for="end_time" class="form-label">نهاية إتاحة الامتحان</label>
                <input type="datetime-local" name="end_time" id="end_time" class="form-control"
                    value="{{ old('end_time', str_replace(' ', 'T', $exam->end_time)) }}">
                >
            </div>

            <button type="submit" class="btn btn-primary">تحديث الامتحان</button>
        </form>
    </div>
@endsection