<div class="card mb-3">
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                    {!! $post->user()->getAvatarAndName() !!}
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
            <div class="col-md-2 py-3">
                <div class="btn-group-vertical float-left" data-id="{{ $post->id }}" role="group" >
                    <button type="button" class="btn btn-outline-primary upvoteButton btn-sm px-0">
                        <i class="fa fa-arrow-up"></i>
                    </button>
                    <button type="button" class="btn btn-outline-primary downvoteButton btn-sm px-0">
                        <i class="fa fa-arrow-down"></i>
                    </button>
                    <button class="votesCount px-2 py-2 btn bg-primary text-white btn-sm px-0">{{ $post->countVotes() }} Votes</button>
                </div>
            </div>
            <div class="col-md-10 pt-2">
                <h4>{{$post->post_title}}</h4>
                @if($post->post_content === null)
                    <p style="color:gray">This Post has no any Content</p>
                @else
                    {!! $post->post_content !!}  
                @endif    
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
            <label for="Comment" class="mx-2 mt-2">Comments</label>
            @foreach($comments as $comment)
            @include('post.components.comment',['$comment' => $comment])
            @endforeach
        </div>
    </div>
</div>
