@extends('layouts.main')

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <h4 class="">Add Details</h4>
                <form action="" method="post" class="form mx-2">
                        @csrf()
                        @method('PATCH')
                    <div class="form-group">
                        <label for="name">College</label>
                        <select name="college" id="college" class="form-control" required>
                                <option value="">-- Select Your College --</option>
                            @foreach($colleges as $college)
                                <option value="{{ $college->id }}">{{ $college->title }}</option>
                            @endforeach()
                        </select>
                    </div>
                    <div id="additional-details" class="mb-3">
                        <div class="form-group" style="display:none">
                            <label>Course</label>
                            <select class="form-control" name="course" id="courses">
                                <option value="">--Select Your Course--</option>
                                @foreach($courses as $course)
                                    <option value="{{$course->id}}">{{$course->title}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group" id="current_year">

                    </div>
                    <div id="messages mb-3 hidden">

                    </div>
                    <div id="loading" class="text-center text-primary" style="display: none;">
                        <i class="fa fa-circle-o-notch fa-3x fa-spin"></i>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-success float-right" id="submit" disabled>Update Info</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection()

@push('scripts')
    <script>
         var loader = $('#loading');
         var body = $('#additional-details');
         var message = $('#message');
         message.addClass('alert');
        $('#college').change(function(event){
            event.preventDefault();
            var url = '{{ route("college.getcourses", ":id") }}';
            var id = $('#college').val();
            if(url.includes(':id')){
                url = url.replace(':id', id);
            }else{
                url = url.substr(0, url.lastIndexOf('/'));
                url += id;
            }
            $.ajax({
                url : url,
                method : 'GET',
                success : function(response){
                    loader.hide();
                    if(response.status === 'success'){
                        var select = $('#courses');
                        var objects = [];
                        var dummy = $(document.createElement('option')).attr('value', '');
                        dummy.html('--Pleae Select a Course--');
                        objects.push(dummy);
                        response.data.courses.map(function(element){
                            objects.push($(document.createElement('option')).attr('value', element.id).attr('data-course', JSON.stringify(element)).html(element.title));
                        });
                        select.html(objects);
                        select.parent().show();
                    }else{
                        message.addClass('alert-danger');
                        message.append(response.message);
                        message.show();
                    }
                },
                error : function(response){
                    loader.hide();
                    message.addClass('alert-danger');
                    message.innerHTML = response;
                    message.show();
                },
                beforeSend : function(){
                    loader.show();
                },
                timeout : function(){
                    loader.hide();
                }
            });
        });

        $('#courses').change(function(event){
            event.preventDefault();
            var selected = $(this).find('option:selected');

            var course = selected.data('course');
            var col = $(document.createElement('div'));
            var year = $(document.createElement('input')).attr('type','number').attr('name','year').attr('max', course.total_years).attr('min',0).attr('required', true);
            year.addClass('form-control');
            var container = $('#current_year');
            col.append("<label>Year</label>");
            col.append(year);
            var div = $(document.createElement('div'));
            if(course.is_semester_based == 'yes'){
                div.addClass('row px-0');
                var col2 = $(document.createElement('div'));
                col.addClass('col-md-6');
                col2.addClass('col-md-6');
                var semester = $(document.createElement('input')).attr('type','number').attr('name','semester').attr('max', course.total_semesters).attr('min',0).attr('required', true);

                semester.addClass('form-control');
                col2.append("<label>Semester</label>");
                col2.append(semester);
                div.append(col);
                div.append(col2);
            }else{
                col.addClass('col-md-12 px-0');
                div.append(col);
            }
            container.html(div);
            $('#submit').removeAttr('disabled');
        });
    </script>
@endpush()