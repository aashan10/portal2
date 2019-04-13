<div class="card">
    <img src="{{ $user->getAvatarUrl() }}" class="img-fluid profile-avatar">
    <div class="card-body">
        <h4 align="center"> {{ $user->name }}</h4>
        <p align="center">
            {!! ($user->getMeta('bio') !== null ) ? $user->getMeta('bio')->value : (auth()->user()->id != $user->id) ? '' : 'Bio<br/><a href="'.route('users.edit', $user->id).'">Set your bio</a>'  !!}
        </p>
    </div>
    <ul class="list-group">
        @if(count($user->getLinks() ) > 0)
        <li class="list-group-item" style="display:flex;flex-direction: row;justify-content: space-around">
            @foreach($user->getLinks() as $meta)
                <a href=" {{ ($meta->type == 'email') ? 'mailto:' : '' }}{{ $meta->value }}"><i class="{{ $meta->icon}} fa-2x"></i></a>
            @endforeach()
        </li>
        @endif()
        @foreach($user->getMeta() as $meta)
            <li class="list-group-item">
                <b style="float:left"> {{ ucwords($meta->key) }} </b>
                <pre style="float:right"> {{ $meta->value }} </pre>
            </li>
        @endforeach()

    </ul>
</div>