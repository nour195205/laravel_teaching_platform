@extends('layouts.dashboard')

@section('title', 'إدارة الامتحانات')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">إدارة الامتحانات</h2>
        <a href="{{ route('exams.create') }}" class="btn btn-primary">إضافة امتحان جديد</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>العنوان</th>
                <th>الصف</th>
                <th>الحالة</th>
                <th>متاح من</th>
                <th>إلى</th>
                <th>تحكم</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($exams as $exam)
                <tr>
                    <td>{{ $exam->title }}</td>
                    <td>{{ __('classes.' . $exam->grade) }}</td>
                    <td>
                        @if (!$exam->is_active)
                            <span class="badge bg-secondary">غير مفعل</span>
                        @elseif ($exam->start_time && now()->lt($exam->start_time))
                            <span class="badge bg-info">لم يبدأ</span>
                        @elseif ($exam->end_time && now()->gt($exam->end_time))
                            <span class="badge bg-danger">انتهى</span>
                        @else
                            <span class="badge bg-success">مفتوح</span>
                        @endif
                    </td>
                    <td>{{ $exam->start_time ? $exam->start_time : '—' }}</td>
                    <td>{{ $exam->end_time ? $exam->end_time : '—' }}</td>
                    <td class="d-flex gap-2">
                        <a href="{{ route('exams.edit', $exam->id) }}" class="btn btn-sm btn-warning">تعديل</a>
                        <form method="POST" action="{{ route('exams.destroy', $exam->id) }}"
                              onsubmit="return confirm('هل أنت متأكد من الحذف؟')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">حذف</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6" class="text-center">لا توجد امتحانات حتى الآن.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
