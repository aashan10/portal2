@extends('layouts.main')

@push('sidebar-left')
    @include('users.components.profile-card')
@endpush()

@section('content')
    
    @forelse($user->posts() as $post)
        @include('post.components.post', ['post' => $post])
    @empty
        <div class="card">
            <div class="card-body">
                <h3>
                    Oops!
                </h3>
                <p>
                    {{ $user->name }} hasn't posted anything yet!
                </p>
            </div>
        </div>
    @endforelse()
@endsection()