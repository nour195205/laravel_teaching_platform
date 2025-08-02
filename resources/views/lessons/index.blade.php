@extends('layouts.naa')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">الدروس المتاحة</h2>

    @if($message)
        <div class="alert alert-warning">{{ $message }}</div>
    @elseif($lessons->isEmpty())
        <div class="alert alert-info">لا يوجد دروس متاحة حالياً.</div>
    @else
        <div class="row">
            @foreach($lessons as $lesson)
            @if($lesson->grade === Auth::user()->grade)
                <div class="col-md-4">
                    <div class="card mb-4 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">{{ $lesson->title }}</h5>
                            <p class="card-text">{{ $lesson->description }}</p>
                            <a href="{{ route('lessons.show', $lesson->id) }}" class="btn btn-primary">مشاهدة</a>
                        </div>
                    </div>
                </div>
            @endif
            @endforeach
        </div>
    @endif
</div>
@endsection
