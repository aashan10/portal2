@foreach($posts as $post)
    @include('post.components.post', ['post' => $post, 'comments' => $post->comments()])
@endforeach()
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
                    $(self).siblings('.votesCount').html(response.data.votes_count+" Votes");
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
                    $(self).siblings('.votesCount').html(response.data.votes_count+" Votes");
                },
                error : function(response){

                }
            });
        });
    </script>
@endpush()