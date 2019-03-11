@extends('layouts.main')


@push('sidebar-left')

    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <div class="card">
        <img src="{{ $user->getAvatarUrl() }}" class="img-fluid">
        <div class="card-body">
            <h4 align="center"> {{ $user->name }}</h4>
        </div>
        <ul class="list-group">
            <li class="list-group-item">
                {!! ($user->getMeta('bio') !== null ) ? $user->getMeta('bio')->value : 'Bio<br/><a href="'.route('users.edit', $user->id).'">Set your bio</a>'  !!}
            </li>
            <li class="list-group-item" style="display:flex;flex-direction: row;justify-content: space-around">
                @foreach($user->getLinks() as $meta)
                    {!!
                        '<a href="'
                        .$meta->value
                        .'"><i class="'.$meta->icon.' fa-2x"></i></a>'
                    !!}
                @endforeach()
            </li>

            @foreach($user->getMeta() as $meta)
                <li class="list-group-item">
                    <b style="float:left"> {{ ucwords($meta->key) }} </b>
                    <pre style="float:right"> {{ $meta->value }} </pre>
                </li>
            @endforeach()

        </ul>
    </div>
@endpush()