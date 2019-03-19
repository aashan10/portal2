

<div class="card">
    <div class="card-body">
        <h5> Change Avatar</h5>
        <form action="{{ route('change-avatar') }}" id="changeUserAvatarForm" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            <input type="file" id="profileAvatar" name="avatar" style="display:none"/>
            <img src="{{ $user->getAvatarUrl() }}" class="img-fluid" id="avatarImage" />
                <button class="btn btn-block btn-primary" style="border-top-left-radius:0;border-top-right-radius:0;border:0;z-index:9999;position:relative;top:0;opacity:0.75" id="changeProfileImageButton">Change Profile Image </button>
        </form>
    </div>
</div>
@push('scripts')
    <script>
        $('#changeProfileImageButton').slideUp(200);
        $('#avatarImage').parent().on('mouseenter',function(event){
            event.preventDefault();
            $('#changeProfileImageButton').slideDown(200);
        }).on('mouseleave', function(event){
            event.preventDefault();
            $('#changeProfileImageButton').slideUp(200);
        });
    </script>
@endpush()
