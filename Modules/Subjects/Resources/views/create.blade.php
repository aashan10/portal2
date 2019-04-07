@extends('layouts.main')

@section('content')
    <div class="card">
        <h4 class="mx-2 mt-3">Add Subjects</h4>
        <div class="row">
            <div class="card-body">
                <div class="col-md-12">
                    <form action="#" method="post" class="from">
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
                            <label for="name">Total Credit Hours</label>
                            <input type="number" name="credit_hour"  class="form-control">
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

@endsection()