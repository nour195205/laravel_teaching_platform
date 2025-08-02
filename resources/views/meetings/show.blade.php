@extends('layouts.naa')

@section('title', $meeting->title)

@section('content')
<div class="container py-5">
    <h2 class="mb-4">{{ $meeting->title }}</h2>

    @if($meeting->start_time)
        <p><strong>موعد الاجتماع:</strong> 
            {{ \Carbon\Carbon::parse($meeting->start_time)->format('Y-m-d h:i A') }}
        </p>
    @endif

    <div class="ratio ratio-16x9">
        {!! $meeting->embed_code !!}
    </div>
</div>
@endsection
