@extends('layouts.dashboard')

@section('content')
<div class="container py-5">
    <h2 class="mb-4">تعديل بيانات المستخدم</h2>

    <form action="{{ route('dashboard.users.update', $user) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">الاسم</label>
            <input type="text" name="name" value="{{ old('name', $user->name) }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">البريد الإلكتروني</label>
            <input type="email" name="email" value="{{ old('email', $user->email) }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">رقم الهاتف</label>
            <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">اسم ولي الأمر</label>
            <input type="text" name="guardian_name" value="{{ old('guardian_name', $user->guardian_name) }}" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">هاتف ولي الأمر</label>
            <input type="text" name="guardian_phone" value="{{ old('guardian_phone', $user->guardian_phone) }}" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">الصف الدراسي</label>
            <select name="grade" class="form-select">
                <option value="">اختر الصف</option>
                <option value="first" {{ $user->grade == 'first' ? 'selected' : '' }}>أولى</option>
                <option value="second" {{ $user->grade == 'second' ? 'selected' : '' }}>ثانية</option>
                <option value="third" {{ $user->grade == 'third' ? 'selected' : '' }}>ثالثة</option>
                
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">الدور</label>
            <select name="role" class="form-select" required>
                <option value="student" {{ $user->role == 'student' ? 'selected' : '' }}>طالب</option>
                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>أدمن</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">تحديث</button>
    </form>
</div>
@endsection
