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
                    <label for="collegeName">Course Title</label>
                    <input type="text" class="form-control" value="{{ (isset($course)) ? $course->name : ''  }}" id="courseName" name="courseName" />
                </div>
                <div class="form-group">
                    <label for="yesrs">Total Years</label>
                    <input type="number" name="totalYears" class="form-control">
                </div>
                <div class="form-group">
                    <label for="yesrs">Semester Based?</label>
                    <input type="radio" name="is_semester_based" class="form-group mx-2" id="Semyes" value="Yes">Yes
                    <input type="radio" name="is_semester_based" class="form-group mx-2" id="Semno" value="No">No
                </div>
                <div class="form-group d-none" id="totalSem">
                    <label for="semester">Total Semester</label>
                    <input type="text" name="total_semesters" class="form-control">
                </div>
                <div class="form-group">
                    <label for="semester">University</label>
                    <input type="text" name="university" value="{{ (isset($course)) ? $course->university : '' }}" class="form-control">
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
@push('scripts')
    <script type="application/javascript">
        $(document).ready(function () {
            $('#Semyes').click(function () {
               if($('#Semyes').is(':checked')) {
                   $('#totalSem').removeClass('d-none');
               }
            });
            $('#Semno').click(function () {
                if ($('#Semno').is(':checked')) {
                    $('#totalSem').addClass('d-none');
                }
            });
        });






    </script>

@endpush()