@extends('layouts.main')

@section('content')
<div class="card">
    <div class="row">
        <div class="col-md-12">
            <h4 class="mt-3 mx-1    ">Please Tell Us More About Yourself!!</h4>
            <form action="" method="post" class="form mx-2">
                    @csrf()
                <label for="Name">Name</label>
                <input type="text" class="form-control" name="Name" value="{{\Illuminate\Support\Facades\Auth::user()->name}}">
                <label for="Email">Email</label>
                <input type="email" class="form-control" email="email" value="{{\Illuminate\Support\Facades\Auth::user()->email}}">

                <label for="College Enrolled">College Enrolled</label>
                <input type="text" class="form-control" name="college">
                <label for="Course">Course</label>
                <select name="Courses" id="" class="form-control">
                    <option value="bsc.csit">Bsc.CSIT</option>
                    <option value="bit">BIT</option>
                    <option value="bim">BIM</option>
                </select>
                <label for="Semster" class="mt-2">Current Semester / Year</label>
                <input type="text" name="semester" class="form-control"placeholder="Please Specify your Semester or Year">


                <button class="btn btn-primary mt-3 float-right mb-2">Submit</button>
            </form>
        </div>
    </div>
</div>

    @endsection