@extends('layouts.main')


@push('sidebar-left')

    <div class="card" style="padding:0; text-align: center">
        <img src="{{ $user->getAvatarUrl() }}" class="img-fluid">
        <div class="card-body">
            <h4> {{ $user->name }}</h4>
        </div>
    </div>

@endpush()