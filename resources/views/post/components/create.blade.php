<div class="card mb-3">
    
    <div class="card-body ">
            <button class="btn btn-sm btn-primary float-right" data-target="#createPostForm" data-toggle="collapse">Create Post</button>
        <h5>Create Post</h5>
        <form id="createPostForm" class="collapse" method="POST"><br>
            @method('PATCH')
            @csrf()
            <div class="form-group">
                <input id="postTitle" name="post_title" class="form-control" placeholder="Post title..."/>
            </div>
            <div class="form-group">
                <textarea class="form-control" name="post_content" id="postContent" placeholder="Content..."></textarea>
            </div>
            <div class="form-group">
                <button disabled class="btn btn-primary float-right disabled" id="publishButton">Publish</button>
            </div>
        </form>
    </div>
</div>
@push('scripts')
    <script src="{{ asset('js/tinymce/tinymce.min.js') }}"></script>
    <script>
        tinymce.init({
            menubar:false,
            selector: '#postContent',
            plugins: 'print preview fullpage searchreplace autolink directionality visualblocks visualchars mediapicker fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern help',
            toolbar: 'bold italic underline permanentpen formatpainter | link codesample image | mediapicker | numlist '
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

    </script>

@endpush()
@push('styles')
    <style>
        .tox-statusbar{
            display : none !important;
        }
    </style>
@endpush()
