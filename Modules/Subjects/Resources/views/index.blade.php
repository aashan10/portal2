@extends('layouts.main')

@section('content')
    <div class="card">
        <div class="card-body">
            <h3>Subjects</h3>
            <input type="text" class="form-control mb-3" placeholder="Search Courses..." id="searchCourse"/>
            @foreach($subjects as $subject)
                <div class="card mb-3 course" data-course="{{ json_encode($subject) }}">
                    <a href="{{ route('admin.subject.show', $subject->id) }}" style="text-decoration: none">
                        <div class="card-body">
                            {{ $subject->name  }}
                            <small class="float-right">{{ $subject->description }}</small>
                        </div>
                    </a>
                </div>
            @endforeach()
        </div>
    </div>
@stop

@push('scripts')
    <script>
        $('#searchCourse').keyup(function(){
            var courses = $('.course');
            var query = $('#searchCourse').val().toUpperCase();
            courses.map(function(index, course){
                var coursedata = $(course).data('course');
                if(!coursedata.name.includes(query)){
                    $(course).hide();
                }else{
                    $(course).show();
                }
            });
        });
    </script>
@endpush()
