@extends('layouts.main')


@prepend('sidebar-left')
    <ul class="list-group">
        <a href="" class="list-group-item">
            View notes for this subject
        </a>
    </ul>
@endprepend()

@section('content')
    <div class="card">
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