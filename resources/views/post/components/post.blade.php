<div class="card mb-3">
    <div class="card-body">
        <div class="row">
            <div class="col">
            <h4>{{$post->post_title}}</h4>
            </div>
            <div class="col-md-6">
                    <div class="dropdown">
                        <button class="btn px-0 py-0 dropdown-toggle float-right" id="postActions" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-ellipsis-h"></i>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="postActions" style="padding:0; margin-top:-10px;">
                            @if($post->user()->id == auth()->id())
                                <small>
                                    <a class="dropdown-item text-danger" href="{{ route('post.destroy', $post->id) }}">
                                        <i class="fa fa-trash"></i> Delete Post
                                    </a>
                                </small>

                            @endif()
                            @if($user->can('block_post') || $user->id == $post->user()->id)
                                <small>
                                    <a class="dropdown-item text-danger" href="{{ route('post.destroy', $post->id) }}">
                                        <i class="fa fa-ban"></i> Block Post
                                    </a>
                                </small>
                            @endif()
                        </div>
                    </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                @if($post->post_content === null)
                    <p style="color:gray">This Post has no any Content</p>
                @else
                    {!! $post->post_content !!}  
                @endif    
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                {!! $post->user()->getAvatarAndName() !!}
            </div>
            <div class="col-md-6">
                <div class="btn-group float-right" role="group" >
                    <button type="button" class="btn btn-primary px-2 py-0">Upvote</button>
                    <button type="button" class="btn btn-outline-primary px-2 py-0">Downvote</button>
                </div>
            </div>
        </div>
        <div class="row mt-3" id="commentBox">
            <div class="col-md-12">
            <form action="{{route('post.comment',['post_id' => $post->id])}}" method="POST">
                @csrf()
                <label for="Comment">Comments</label>
                <input type="text" class="form-control" name="comment_status">
                <button class="btn btn-sm btn-primary float-right mt-3">Post</button>
            </form>
            </div>
        </div>
    </div>
</div>