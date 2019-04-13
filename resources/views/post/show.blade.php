@foreach($posts as $post)
    @include('post.components.post', ['post' => $post, 'comments' => $post->comments()])
@endforeach()
<div class="modal fade" id="previewModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" >
            <div class="col-md-12 mt-3">
                <h4 id="fileName"></h4>
            </div>
            <div class="container bg-secondary">
                <iframe src="" id="attachmentPreviewIframe" width="100%" height="100%" style="width:100%;min-height:500px" frameborder="0"></iframe>
            </div>
            <div class="col-md-12 mb-3 mt-3">
                <button class="btn btn-outline-primary">
                    <i class="fa fa-download"></i> Download
                </button>
            </div>
        </div>
    </div>
</div>
@push('styles')
    <style>
        .dropdown-toggle::after {
            display: none;
        }
        @media only screen and (max-width : 767px){
            .votes{
                width : 80px !important;
                margin : 0;
                float:left;
            }
            .post-content {
                float: left;
                overflow: auto;
                max-width:calc(100% - 82px);
                padding-left: 10px !important;
            }
            .post-options-button{
                background-color: #fff !important;
            }
            .post-options{
                margin-left:-130px !important;
                margin-top:5px !important;
            }
            
        }
    </style>
@endpush()

@push('scripts')
    <script>
        $('.attachmentPreview').click(function(event){
            event.preventDefault();
            $('#attachmentPreviewIframe').html('');
            $('#attachmentPreviewIframe').attr('src',$(this).data('attachment').url);
            $('#fileName').html($(this).data('attachment').original_name);
            $('#previewModal').modal();
        });
        $('.upvoteButton').click(function(){
            var id = $(this).parent().data('id');
            var downvotebutton = $(this).siblings('.downvoteButton');
            var url = '{{ route("post.upvote", ":id") }}';
            url = url.replace(":id", id);
            var self = this;
            $.ajax({
                url : url,
                method : 'POST',
                data : {
                    _token : '{{ csrf_token() }}',
                },
                beforeSend : function(){
                    $(self).addClass('disabled');
                    $(self).attr('disabled', true);
                },
                success : function(response){
                    $(self).addClass('btn-primary');
                    $(self).removeClass('btn-outline-primary');
                    $(self).removeClass('disabled');
                    $(self).attr('disabled',false);
                    downvotebutton.removeClass('btn-primary');
                    downvotebutton.addClass('btn-outline-primary');
                    $(self).siblings('.votesCount').html(response.data.votes_count+"<br/> Votes");
                },
                error : function(response){

                }
            });
        });

        $('.downvoteButton').click(function(){
            var id = $(this).parent().data('id');
            var upvoteButton = $(this).siblings('.upvoteButton');
            var url = '{{ route("post.downvote", ":id") }}';
            url = url.replace(":id", id);
            console.log(url);
            var self = this;
            $.ajax({
                url : url,
                method : 'POST',
                data : {
                    _token : '{{ csrf_token() }}',
                },
                beforeSend : function(){
                    $(self).addClass('disabled');
                    $(self).attr('disabled', true);
                },
                success : function(response){
                    $(self).addClass('btn-primary');
                    $(self).removeClass('btn-outline-primary');
                    $(self).removeClass('disabled');
                    $(self).attr('disabled',false);
                    upvoteButton.removeClass('btn-primary');
                    upvoteButton.addClass('btn-outline-primary');
                    $(self).siblings('.votesCount').html(response.data.votes_count+"<br/> Votes");
                },
                error : function(response){

                }
            });
        });
    </script>
@endpush()