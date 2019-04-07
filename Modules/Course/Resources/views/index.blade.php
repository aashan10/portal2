@extends('layouts.main')

@section('content')
    <div class="card">
        <div class="card-body">
            <h3>Courses</h3>
            <input type="text" class="form-control mb-3" placeholder="Search Courses..." id="searchCourse"/>
            @foreach($courses as $course)
                <div class="card mb-3 course" data-course="{{ json_encode($course) }}">
                    <a href="">
                        <div class="card-body">
                            {{ $course->title  }}
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
                if(!coursedata.title.includes(query)){
                    $(course).hide();
                }else{
                    $(course).show();
                }
            });
        });
    </script>
@endpush()
