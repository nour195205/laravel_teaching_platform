@extends('layouts.dashboard')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-4">إدارة المستخدمين</h2>
        <a href="{{ route('register') }}" class="btn btn-primary">إضافة مستخدم جديد</a>
    </div>



    <table class="table table-bordered table-striped text-center align-middle">
        <thead class="table-dark">
            <tr>
                <th>الاسم</th>
                <th>البريد</th>
                <th>الدور</th>
                <th>الصف الدراسي</th>
                <th>رقم الهاتف</th>
                <th>اسم ولي الأمر</th>
                <th>هاتف ولي الأمر</th>
                <th>تحكم</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @switch($user->role)
                            @case('admin') <span class="badge bg-danger">أدمن</span> @break
                            @case('teacher') <span class="badge bg-primary">مدرس</span> @break
                            @default <span class="badge bg-success">طالب</span>
                        @endswitch
                    </td>
                    <td>{{ $user->grade ?? '—' }}</td>
                    <td>{{ $user->phone ?? '—' }}</td>
                    <td>{{ $user->guardian_name ?? '—' }}</td>
                    <td>{{ $user->guardian_phone ?? '—' }}</td>
                    <td class="d-flex justify-content-center gap-2">
                        <!-- زر التعديل -->
                        <a href="{{ route('dashboard.users.edit', $user->id) }}" class="btn btn-sm btn-warning">تعديل</a>

                        <!-- زر الحذف -->
                        <form method="POST" action="{{ route('dashboard.users.destroy', $user->id) }}" onsubmit="return confirm('هل أنت متأكد من الحذف؟')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">حذف</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
