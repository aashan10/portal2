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