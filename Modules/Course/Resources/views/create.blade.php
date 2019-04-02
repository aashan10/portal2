@extends('layouts.main')
@section('content')
    <div class="card">
        <div class="card-body">
            <h4>Add Course</h4>
        </div>
        <div class="col-md-12">
            <form action="{{ !isset($course) ? route('admin.course.store') : route('admin.course.update', $course->id) }}" method="POST">
                @csrf()
                <div class="form-group">
                    <label for="collegeName">Name</label>
                    <input type="text" class="form-control" value="{{ (isset($course)) ? $course->name : ''  }}" id="courseName" name="courseName" />
                </div>
                <div class="form-group">
                    <label for="college">College</label>
                    <select name="college_id" id="" class="form-control">
                        @foreach($colleges as $college)
                            <option value="">Please Select Respective College</option>
                            <option value="{{$college->id}}">{{$college->name}}</option>
                         @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="collegeDescription">Description</label>
                    <textarea class="form-control" id="collegeDescription" name="description" >{{ (isset($course)) ? $course->description : ''  }}</textarea>
                </div>
                <div class="form-group">
                    <button type="submit" id="createCollege" class="btn btn-primary float-right">Add Course</button>
                    <br/>
                    <br/>
                </div>
            </form>
        </div>
    </div>


@endsection()