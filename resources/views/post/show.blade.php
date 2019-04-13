@foreach($posts as $post)
    @include('post.components.post', ['post' => $post, 'comments' => $post->comments()])
@endforeach()



