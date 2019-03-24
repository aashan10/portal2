@foreach($posts as $post)
    @include('post.components.post', ['post' => $post])
@endforeach()
@push('styles')
    <style>
        .dropdown-toggle::after {
            display: none;
        }
    </style>
@endpush()

@push('scripts')
    <script>
        $('.upvoteButton').click(function(){
            var id = $(this).parent().data('id');
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
                    $(self).siblings('.votesCount').html(response.data.votes_count+" Votes");
                },
                error : function(response){

                }
            });
        });
    </script>
@endpush()