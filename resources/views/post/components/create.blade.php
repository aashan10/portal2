<div class="card mb-3">
    
    <div class="card-body ">
            <button class="btn btn-sm btn-primary float-right" data-target="#createPostForm" data-toggle="collapse">Create Post</button>
        <h5>Add study material or Ask a question</h5>
        <form id="createPostForm" class="collapse" method="POST" enctype="multipart/form-data"><br>
            @method('PATCH')
            @csrf()
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="course">Course</label>
                        <select id="course" name="course" class="form-control" required="true">
                            <option value="">--Select A Course--</option>
                            @foreach($courses as $course)
                                <option value="{{ $course->id }}" > {{ $course->title }} </option>
                            @endforeach()
                        </select>
                    </div>
                </div>
                <div class="col-md-6" style="display:none">
                    <div class="form-group">
                        <label for="subject">Subject</label>
                        <select id="subject" name="subject" class="form-control" required="true">
                            
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label>Title</label>
                <input id="postTitle" name="post_title" class="form-control" placeholder="Post title..."/>
            </div>
            <div class="form-group">
                <label>Description</label>
                <textarea class="form-control" name="post_content" id="postContent" placeholder="Content..."></textarea>
            </div>
            <input type="file" id="attachmentInput" name="attachments[]" style="display:none" multiple="true">
            <div class="row" id="attachmentPreview" style="overflow:hidden;">
            </div>
            <div class="form-group">
                <button disabled class="btn btn-primary float-right mx-2 disabled" id="publishButton">Publish</button>
                <a href="#" class="btn btn-secondary float-right mx-2" id="attachmentsButton"><i class="fa fa-cloud-upload"></i> Attach Media</a>
                <a href="#" class="btn btn-danger float-right" id="clearAttachhmentsButton" style="display:none;"><i class="fa fa-trash"></i> Clear Media Selection</a>
            </div>
        </form>
    </div>
</div>
@push('scripts')
    <script type="text/javascript" src="{{ asset('js/notifjs.js') }}"></script>
    <script src="{{ asset('js/tinymce/tinymce.min.js') }}"></script>
    <script>
        $('#course').change(function(event){
            var id = $(this).val();
            var url = '{{ route("subject.from-course", ":id") }}';
            url = url.replace(':id', id);
            var subjects = $('#subject');
            $.ajax({
                url : url,
                method : 'POST',
                data : {
                    _token : "{{ csrf_token() }}"
                },
                beforeSend : function(){
                    subjects.html('<option value="">-- Select a Subject -- </option>');
                },
                success : function(response){
                    subjects.parent().parent().show();
                    subjects.append(response.data);
                },
                error : function(response, statusCode){
                    AjaxNotifier(response.responseJSON, statusCode);
                }
            });
        });
    </script>
    <script>
        tinymce.init({
            menubar:false,
            selector: '#postContent',
            plugins: 'fullpage autolink fullscreen link media template codesample anchor  insertdatetime advlist lists wordcount',
            toolbar: 'bold italic underline permanentpen formatpainter | link codesample | numlist ',
        });
        $('#postTitle').change(function(event){
            event.preventDefault();
            $.ajax({
                url : '{{ route("post.createFromTitle") }}',
                method : 'POST',
                data : {
                    _token : '{{ csrf_token() }}',
                    title : $('#postTitle').val()
                },
                beforeSend : function(){
                    $('#publishButton').addClass('disabled');
                },
                success : function(response){
                    $('#publishButton').removeClass('btn-danger');
                    $('#publishButton').addClass('btn-success');
                    $('#publishButton').removeClass('disabled');
                    $('#publishButton').html("Publish");
                    $('#publishButton').attr('disabled', false);

                    $('#createPostForm').attr('action', response.data.update_url);
                    $('#publishButton').removeClass('disabled');
                },
                error : function(response){
                    $('#publishButton').removeClass('disabled');
                    $('#publishButton').removeClass('btn-primary');
                    $('#publishButton').addClass('btn-danger');
                    $('#publishButton').html("There was an error!");
                }
            });
        });
        $('#attachmentsButton').click(function(event){
            event.preventDefault();
            $('#attachmentInput').click();
        });
        $('#attachmentInput').change(function(event){
            if(this.files && this.files[0]){
                $('#clearAttachhmentsButton').show();
                var length = this.files.length;
                for(var i = 0; i < length; i++){
                    var reader = new FileReader();
                    
                    reader.onload = (function(file){  // The (file) recieves whatever is sent over closure
                        var extension = file.type.split('/')[1];
                        var images = ['jpg','jpeg','png','bmp', 'gif','svg'];
                        return function(e){ 
                            var image = $(document.createElement('img'));
                            var div = $(document.createElement('div'));

                            div.addClass('col-md-4 col-xs-12 col-sm-6 mb-3');
                            div.css('float', 'left');
                            image.addClass("img-fluid");
                            image.css('position', 'relative');
                            image.css('min-width', '100%');
                            image.css('overflow', 'hidden');
                            image.css('border', '1px solid #ccc');
                            if(images.includes(extension)){
                                image.attr('src', e.target.result);
                            }else{
                                image.attr('src','{{ url("/") }}/filetype_thumbs/'+extension+'.svg');
                                image.css('border' , '0');
                            }
                            div.append(image);

                            $('#attachmentPreview').append(div);
                        }
                    })(this.files[i]);
                    
                    reader.readAsDataURL(this.files[i]);
                    
                };
            }else{
                $('#clearAttachhmentsButton').hide();
                $('#attachmentPreview').html('');
            }
        });

        $('#clearAttachhmentsButton').click(function(event){
            event.preventDefault();
            $('#attachmentInput').val('');
            $('#attachmentInput').trigger('change');
        });
    </script>

@endpush()

