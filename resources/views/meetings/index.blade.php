@extends('layouts.naa') {{-- القالب العام للموقع --}}

@section('title', 'الاجتماعات المتاحة')

@section('content')
    <div class="container py-5">
        <h2 class="mb-4">الاجتماعات المتاحة لصفك الدراسي</h2>

        @if($meetings->isEmpty())
            <div class="alert alert-info">لا توجد اجتماعات متاحة حالياً لصفك الدراسي.</div>
        @else
            @if ($IsActive)


                <div class="row">
                    @foreach($meetings as $meeting)
                        <div class="col-md-6 mb-4">
                            <div class="card shadow-sm">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $meeting->title }}</h5>

                                    @if($meeting->start_time)
                                        <p class="card-text">
                                            <strong>الوقت:</strong>
                                            {{ \Carbon\Carbon::parse($meeting->start_time)->format('Y-m-d h:i A') }}
                                        </p>
                                    @endif

                                    <a href="{{ route('meetings.show', $meeting->id) }}" class="btn btn-primary">
                                        انضم الآن
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        @endif
    </div>
@endsection