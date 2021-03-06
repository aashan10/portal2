@extends('layouts.main')

@section('content')
    <div class="card">
        <h4 class="mx-2 mt-3">Add Subject</h4>
        <div class="row">
            <div class="card-body">
                <div class="col-md-12">
                    <form action="{{route('admin.subject.store')}}" method="post" class="from">
                        @csrf()
                        <div class="form-group">
                            <label for="name">Subject Name</label>
                            <input type="text" name="name" class="form-control">
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Subject Code</label>
                                    <input type="text" name="sub_code" placeholder="CSC 302" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Total Credit Hours</label>
                                    <input type="number" name="credit_hour"  class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <small>The fields below are for representing the FULL marks of each aspect of the subject.</small>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name">Theory Marks</label>
                                    <input type="number" name="theory_marks"  class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name">Practical Marks</label>
                                    <input type="number" name="practical_marks"  class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name">Assessment Marks</label>
                                    <input type="number" name="assessment"  class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name">Subject Description</label>
                            <textarea name="description" class="form-control editor"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="name">Syllabus</label>
                            <textarea name="syllabus" id=""class="form-control editor"></textarea>
                        </div>
                        <button class="btn btn-success float-right">Add Subject</button>
                    </form>
                </div>
            </div>
        </div>

    </div>

@endsection()
@push('scripts')
    <script src="{{ asset('js/tinymce/tinymce.min.js') }}"></script>
    <script>
        tinymce.init({
            menubar:false,
            selector: '.editor',
            plugins: 'anchor advlist lists',
            toolbar: 'bold italic underline | numlist ',
        });
    </script>
@endpush()