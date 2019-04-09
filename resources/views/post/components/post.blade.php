<div class="card mb-3">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <div class="dropdown float-right">
                    <button class="btn post-options-button px-0 py-0 dropdown-toggle float-right" id="postActions" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-ellipsis-h"></i>
                    </button>
                    <div class="dropdown-menu post-options" aria-labelledby="postActions" style="padding:0; margin-top:-10px;">
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
                {!! $post->user()->getAvatarAndName() !!}
            </div>
        </div>
        
        
        <div class="row pt-3">
            <div class="col-md-2 votes">
                <div class="my-auto btn-group-vertical float-left"  data-id="{{ $post->id }}" role="group" style="vertical-align:baseline !important;">
                    <button type="button" class="btn {{ (auth()->user()->hasUpvotedPost($post)) ? 'btn-primary' : 'btn-outline-primary' }} upvoteButton btn-sm px-0">
                        <i class="fa fa-arrow-up"></i>
                    </button>
                    <button type="button" class="btn {{ (auth()->user()->hasDownvotedPost($post)) ? 'btn-primary' : 'btn-outline-primary' }} downvoteButton btn-sm px-0">
                        <i class="fa fa-arrow-down"></i>
                    </button>
                    <button class="votesCount px-2 py-2 btn btn-outline-primary text-blue btn-sm px-0">{{ $post->countVotes() }} <br/>Votes</button>
                </div>
            </div>
            <div class="col-md-10 post-content" >
                <h5>{!! $post->post_title !!}</h5>
                {!! $post->post_content !!}

                @foreach($post->getMeta() as $attach)

                    @if($attach->key === 'attachment_image')
                        <div class="row">
                            <img src="data:image/png;base64,{{$attach->value}}" width="400px" height="200px">
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
        
        <div class="row mt-3" id="commentBox">
            <div class="col-md-12">
            <form action="{{route('post.comment',['post_id' => $post->id])}}" method="POST">
                @csrf()
                <input type="text" class="form-control" name="comment_status" placeholder="Write a Comment">
                {{--<button class="btn btn-sm btn-primary float-right mt-3">Post</button>--}}
            </form>
            </div>
        </div>
        <div class="row">
            <label for="Comment" class="col-md-12 pt-2">Comments</label>
            @foreach($post->comments() as $comment)
                @include('post.components.comment',['$comment' => $comment])
            @endforeach
        </div>
    </div>
</div>

