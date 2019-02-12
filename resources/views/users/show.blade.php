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
            <li class="list-group-item">
                {!! ($user->getMeta('facebook') !== null  ) ? '<a href="'.$user->getMeta('facebook')->value.'"><i class="fa fa-facebook-square fa-2x"></i></a>' : '<a href="'.route('users.edit', $user->id).'">Set Facebook Profile</a>'  !!}
            </li>

            @foreach($user->getMeta() as $meta)
                <li class="list-group-item">

                </li>
            @endforeach()

        </ul>
    </div>
@endpush()