@extends('layouts.main')
@prepend('sidebar-left')
    <ul class="list-group">
        <a href="" class="list-group-item">
            View notes for this subject
        </a>
    </ul>
@endprepend()

@prepend('sidebar-right')
    <div class="card mb-3">
        <div class="card-body">
            Courses containing "{{ $subject->name }} ({{ $subject->sub_code }})"
            @forelse($subject->courses() as $course)
                <br/><a href="">{{$course->title}}</a>
            @empty
                There are no courses that include this subject.
            @endforelse()
        </div>
    </div>
    @role('admin')
        <div class="card">
            <div class="card-header">
                Add Subject to Course
            </div>
            <div class="card-body">

                <form action="">
                    <div class="form-group">
                        <label for="courses">Courses</label><br/>
                        <small style="line-height: 0.2"> Ctrl + Click the course names to select multiple courses. </small>
                        <select multiple name="courses" class="form-control" id="courses">
                            @foreach($courses as $course)
                                <option value="{{ $course->id }}"> {{ $course->title }} </option>
                            @endforeach()
                        </select>
                    </div>
                </form>
            </div>
        </div>
    @endrole()
@endprepend()
@section('content')
    <div class="card mb-3">
        <div class="card-body">
            <h4>{{ $subject->name }} ({{ $subject->sub_code }})</h4>
            <p class="float-right">
                Credit Hours : {{ $subject->credit_hours }} <br>
                Total Marks : {{ $subject->theory_marks + $subject->practical_marks + $subject->assessment }} <br>
                Theory : {{ $subject->theory_marks }} <br>
                Practical : {{ $subject->practical_marks }} <br>
                Assessment : {{ $subject->assessment }} <br>
            </p>
            <p>
                <b class="font-weight-bold">Description</b><br/>
                {!! ($subject->description !== null) ? $subject->description : '<small>There is no description for this subject.</small><br/>' !!}
            </p>
            <p>
                <b class="font-weight-bold">Syllabus</b><br/>
                {!! ($subject->syllabus !== null) ? $subject->syllabus : '<small>There is no syllabus for this subject.</small><br/>' !!}
            </p>
        </div>
    </div>
@endsection()