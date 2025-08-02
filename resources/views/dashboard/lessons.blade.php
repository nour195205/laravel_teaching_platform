@extends('layouts.dashboard')


@section('content')
    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0">لوحة التحكم</h2>

            @auth
                @if(Auth::user()->role === 'admin')
                    <a href="{{ route('lessons.create') }}" class="btn btn-success">
                        <i class="bi bi-plus-circle">إضافة درس جديد</i>
                    </a>
                @endif
            @endauth
        </div>

        @foreach($lessonsByGrade as $grade => $lessons)
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-primary text-white">
                    دروس الصف: {{ ucfirst($grade) }}
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>العنوان</th>
                                <th>الوصف</th>
                                <th>رابط الفيديو</th>
                                <th>إجراءات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($lessons as $lesson)
                                <tr>
                                    <td>{{ $lesson->title }}</td>
                                    <td>{{ $lesson->description }}</td>
                                    <td><a href="{{ $lesson->video_url }}" target="_blank">عرض الفيديو</a></td>
                                    <td>
                                        <a href="{{ route('lessons.edit', $lesson->id) }}" class="btn btn-sm btn-warning">تعديل</a>

                                        <form action="{{ route('lessons.destroy', $lesson->id) }}" method="POST" class="d-inline-block"
                                              onsubmit="return confirm('هل أنت متأكد أنك تريد حذف هذا الدرس؟');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">حذف</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endforeach
    </div>
@endsection
