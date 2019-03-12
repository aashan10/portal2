@extends('layouts.main')

@section('content')
    @include('users.components.edit')
@endsection()

@push('sidebar-left')
    @include('users.components.profile-card')
@endpush()
@push('sidebar-right')
    @include('users.components.change-avatar')
@endpush()