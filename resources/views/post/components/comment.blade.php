<div class="col-md-12">
<div class="card my-1">
    <div class="card-body mx-1">
        <div class="row">
            <div class="col">
                {!! $post->user()->getAvatarAndName() !!}<br>
                <p class="mx-5">{{$comment->post_content}}</p>
            </div>
        </div>
    </div>
</div>
</div>
