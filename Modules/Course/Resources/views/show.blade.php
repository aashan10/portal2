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
            <div class="list-group">
                    @forelse ($course->subjects() as $subject)
                        <a href="{{ route('subject.show', $subject->id) }}" class="list-group-item">
                            {{ $subject->name }}({{ $subject->sub_code }}) 
                        </a>
                    @empty
                        <li class="list-group-item">
                            There are no subjects in this course!
                        </li>
                    @endforelse
            </div>
        </div>
    </div>
@endsection()