@extends('layouts.main')

@section('content')
    <div class="card">
        <h4 class="mx-2 mt-3">Add Subjects</h4>
        <div class="row">
            <div class="card-body">
                <div class="col-md-12">
                    <form action="{{route('admin.subject.store')}}" method="post" class="from">
                        @csrf()
                        <div class="form-group">
                            <label for="name">Subject Name</label>
                            <input type="text" name="name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="name">Subject Code</label>
                            <input type="text" name="sub_code" placeholder="CSC 302" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="name">Practical Marks</label>
                            <input type="number" name="practical_marks"  class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="name">Theory Marks</label>
                            <input type="number" name="theory_marks"  class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="name">Assessment Marks</label>
                            <input type="number" name="assessment"  class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="name">Total Credit Hours</label>
                            <input type="number" name="credit_hour"  class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="name">Subject Description</label>
                            <input type="text" name="description"  class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="name">Syllabus</label>
                            <textarea name="syllabus" id=""class="form-control"></textarea>
                        </div>
                        <button class="btn btn-success float-right">Add Subject</button>
                    </form>
                </div>
            </div>
        </div>

    </div>

@endsection()