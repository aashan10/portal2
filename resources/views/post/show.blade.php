@foreach($posts as $post)
    @include('post.components.post', ['post' => $post])
@endforeach()

@foreach($comments as $comment)
    @include('post.components.comment',['comment' => $comment])
@endforeach
@push('styles')
    <style>
        .dropdown-toggle::after {
            display: none;
        }
    </style>
@endpush()
