@extends('layouts.naa')

@section('content')
<div class="container py-5">
    <h2 class="mb-4">{{ $exam->title }}</h2>

    <p><strong>الصف الدراسي:</strong> {{ $exam->grade }}</p>

    @if ($exam->start_time && $exam->end_time)
        @if (now()->between($exam->start_time, $exam->end_time))
            <div class="alert alert-success">هذا الامتحان متاح الآن.</div>
        @else
            <div class="alert alert-warning">
                الامتحان غير متاح حالياً.
                <br>
                <strong>من:</strong> {{ $exam->start_time->format('Y-m-d H:i') }}
                <br>
                <strong>إلى:</strong> {{ $exam->end_time->format('Y-m-d H:i') }}
            </div>
        @endif
    @else
        <div class="alert alert-info">موعد الامتحان غير محدد.</div>
    @endif

    @if ($exam->embed_code)
        <div class="mt-4">
            {!! $exam->embed_code !!}
        </div>
    @endif
</div>
@endsection
