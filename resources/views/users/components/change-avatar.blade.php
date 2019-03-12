

<div class="card">
    <div class="card-body">
        <h5> Change Avatar</h5>
        <form action="{{ route('change-avatar') }}" id="changeUserAvatarForm" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            <input type="file" id="profileAvatar" name="avatar" style="display:none"/>
            <img src="{{ $user->avatar }}" class="img-responsive" id="avatarImage" />
            <button class="btn btn-block btn-primary" id="changeProfileImageButton">Change Profile Image </button>
        </form>
    </div>
</div>


