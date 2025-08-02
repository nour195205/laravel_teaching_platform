@extends('layouts.dashboard')

@section('title', 'إدارة الملازم')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">إدارة الملازم</h2>
        <a href="{{ route('materials.create') }}" class="btn btn-success">إضافة ملزمة</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>العنوان</th>
                <th>الوصف</th>
                <th>الصف الدراسي</th>
                <th>الملف</th>
                <th>تحكم</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($materials as $material)
                <tr>
                    <td>{{ $material->title }}</td>
                    <td>{{ Str::limit($material->description, 50) }}</td>
                    <td>{{ $material->grade }}</td>
                    <td>
                        @if ($material->file)
                            <a href="{{ asset('storage/' . $material->file) }}" target="_blank">عرض الملف</a>
                        @else
                            —
                        @endif
                    </td>
                    <td class="d-flex gap-2">
                        <a href="{{ route('materials.edit', $material->id) }}" class="btn btn-warning btn-sm">تعديل</a>
                        <form action="{{ route('materials.destroy', $material->id) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من الحذف؟')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">حذف</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">لا توجد ملازم حالياً.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection

