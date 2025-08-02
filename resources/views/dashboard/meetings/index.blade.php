@extends('layouts.dashboard')

@section('title', 'إدارة الاجتماعات')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>قائمة الاجتماعات</h2>
        <a href="{{ route('meetings.create') }}" class="btn btn-success">إضافة اجتماع جديد</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($meetings->isEmpty())
        <p>لا يوجد اجتماعات حالياً.</p>
    @else
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>العنوان</th>
                    <th>الصف</th>
                    <th>وقت البدء</th>
                    <th>رابط الاجتماع</th>
                    <th>التحكم</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($meetings as $meeting)
                    <tr>
                        <td>{{ $meeting->title }}</td>
                        <td>{{ __('grades.' . $meeting->grade) }}</td>
                        <td>
                            @if ($meeting->start_time)
                                {{ \Carbon\Carbon::parse($meeting->start_time)->format('Y-m-d H:i') }}
                            @else
                                — 
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('meetings.show', $meeting->id) }}" class="btn btn-outline-primary btn-sm" target="_blank">
                                فتح الاجتماع
                            </a>
                        </td>
                        <td>
                            <a href="{{ route('meetings.edit', $meeting->id) }}" class="btn btn-warning btn-sm">تعديل</a>

                            <form action="{{ route('meetings.destroy', $meeting->id) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('هل أنت متأكد من الحذف؟')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">حذف</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
