@extends('layouts.main')

@prepend('sidebar-left')
    <div class="list-group">
        <a class="list-group-item" href="">
            View Colleges that teach this course.
        </a>
    </div>
@endprepend()

@section('content')
    <div class="card">
        <div class="card-body">
            {{ $course->title }}

            @if($course->description !== null)
                <p>{{ $course->description }}</p>
            @else()
                <p> There is no description for this course.</p>
            @endif()
        </div>
    </div>
@endsection()