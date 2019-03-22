<div class="card mb-3">
    <div class="card-body">
        <h5>Create Post</h5>
        <form>
            <div class="form-group">
                <input id="postTitle" name="post_title" class="form-control" placeholder="Post title..."/>
            </div>
            <div class="form-group">
                <textarea class="form-control" name="post_content" id="postContent" placeholder="Content..."></textarea>
            </div>
            <div class="form-group">
                <button class="btn btn-primary float-right">Publish</button>
            </div>
        </form>
    </div>
</div>
@push('scripts')
    <script src="{{ asset('js/tinymce/tinymce.min.js') }}"></script>
    <script>
        tinymce.init({
            selector: '#postContent',
            plugins: 'print preview fullpage searchreplace autolink directionality visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern help',
            toolbar: 'formatselect | bold italic strikethrough forecolor backcolor permanentpen formatpainter | link image media pageembed | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent | removeformat | addcomment',
            image_advtab: true,
            content_css: [
                '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
                '//www.tiny.cloud/css/codepen.min.css'
            ],
            link_list: [
                { title: 'My page 1', value: 'http://www.tinymce.com' },
                { title: 'My page 2', value: 'http://www.moxiecode.com' }
            ],
            image_list: [
                { title: 'My page 1', value: 'http://www.tinymce.com' },
                { title: 'My page 2', value: 'http://www.moxiecode.com' }
            ],
            image_class_list: [
                { title: 'None', value: '' },
                { title: 'Some class', value: 'class-name' }
            ],
            importcss_append: true,
            height: 400,
            file_picker_callback: function (callback, value, meta) {
                /* Provide file and text for the link dialog */
                if (meta.filetype === 'file') {
                callback('https://www.google.com/logos/google.jpg', { text: 'My text' });
                }

                /* Provide image and alt text for the image dialog */
                if (meta.filetype === 'image') {
                callback('https://www.google.com/logos/google.jpg', { alt: 'My alt text' });
                }

                /* Provide alternative source and posted for the media dialog */
                if (meta.filetype === 'media') {
                callback('movie.mp4', { source2: 'alt.ogg', poster: 'https://www.google.com/logos/google.jpg' });
                }
            },
            templates: [
                { title: 'Some title 1', description: 'Some desc 1', content: 'My content' },
                { title: 'Some title 2', description: 'Some desc 2', content: '<div class="mceTmpl"><span class="cdate">cdate</span><span class="mdate">mdate</span>My content2</div>' }
            ],
            template_cdate_format: '[CDATE: %m/%d/%Y : %H:%M:%S]',
            template_mdate_format: '[MDATE: %m/%d/%Y : %H:%M:%S]',
            image_caption: true,
            spellchecker_dialog: true,
            spellchecker_whitelist: ['Ephox', 'Moxiecode'],
            tinycomments_mode: 'embedded',
            content_style: '.mce-annotation { background: #fff0b7; } .tc-active-annotation {background: #ffe168; color: black; }'
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
                success : function(response){
                    console.log(response);
                },
                error : function(response){
                    console.log(response);
                }
            });
        });

    </script>

@endpush()