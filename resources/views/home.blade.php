@extends('layouts.main')

@section('content')
    <div class="card">
        <div class="card-body">
            <h5>Welcome, {{ $user->name }}</h5>
        </div>
    </div>
    @foreach($posts as $post)
        <div class="card mt-2">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <a href="{{ route('users.show', $post->user()->id) }}">
                            <img src="{{ $post->user()->getAvatarUrl() }}" width="30" height="30" style="border-radius:30px;"/><b>{{ $post->user()->name }}</b>
                        </a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        {!! $post->description !!}
                    </div>
                </div>
            </div>
        </div>
    @endforeach()
@endsection()

@push('sidebar-left')
    <ul class="list-group">
        @role('admin')
            <b class="list-group-item">
                Useful Admin Links
            </b>
            @if($pendingUsers > 0)
                <a class="list-group-item" href="#">
                    <i class="fa fa-user"></i> Inactive Users
                    <span class="badge badge-danger float-right">
                        {{ $pendingUsers }}
                    </span>
                </a>
            @endif()
        @endrole()

        @role('staff')
            <b class="list-group-item">
                Staff
            </b>
        @endrole()

        @role('student')
            <b class="list-group-item">
                Useful Student Links
            </b>
            @if($user->getMeta('semester'))
                <a class="list-group-item" href="{{ route('users.edit', Auth::id()) }}">
                    <i class="fa fa-book"> </i> My Semester
                </a>
            @endif()
            @if($user->getMeta(''))
                <a class="list-group-item">
                    <i class="fa fa-"></i>
                </a>
            @endif()
        @endrole()

        <a class="list-group-item" href="{{ route('users.show', Auth::id()) }}">
            <i class="fa fa-user"> </i> Profile
        </a>
        <a class="list-group-item" href="{{ route('users.edit', Auth::id()) }}">
            <i class="fa fa-gear"> </i> Profile Settings
        </a>
        <a class="list-group-item logout" href="{{ route('logout') }}">
            <i class="fa fa-share"> </i> Logout
        </a>
    </ul>
@endpush()

@push('sidebar-right')
    <div class="list-group">
        <div class="list-group-item">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Search" aria-label="Recipient's username" aria-describedby="basic-addon2">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="button"><i class="fa fa-search"></i></button>
                </div>
            </div>
        </div>
        <div id="searchResults"></div>
        @role('admin')
            <div class="list-group-item">
                <b>Student Info</b>
            </div>
            <div class="list-group-item">
                <span>Total Students</span>
                <span class="badge badge-primary float-right">
                    {{ $totalStudents }}
                </span>
            </div>
            <div class="list-group-item">
                <span>Active Students</span>
                <span class="badge badge-success float-right">
                    {{ $activeStudents }}
                </span>
            </div>
            <div class="list-group-item">
                <span>Pending Students</span>
                <span class="badge badge-warning float-right">
                    {{ $pendingStudents }}
                </span>
            </div>
            <div class="list-group-item">
                <span>Suspended Students</span>
                <span class="badge badge-danger float-right">
                    {{ $suspendedStudents }}
                </span>
            </div>
            <div class="list-group-item">
                <b>Staff Info</b>
            </div>
            <div class="list-group-item">
                <span>Total Staffs</span>
                <span class="badge badge-primary float-right">
                    {{ $totalStaffs }}
                </span>
            </div>
            <div class="list-group-item">
                <span>Active Staffs</span>
                <span class="badge badge-success float-right">
                    {{ $activeStaffs }}
                </span>
            </div>
            <div class="list-group-item">
                <span>Pending Staffs</span>
                <span class="badge badge-warning float-right">
                    {{ $pendingStaffs }}
                </span>
            </div>
            <div class="list-group-item">
                <span>Suspended Staffs</span>
                <span class="badge badge-danger float-right">
                    {{ $suspendedStaffs }}
                </span>
            </div>
            
        @endrole()
        @role('student')
        @endrole()
        <div class="list-group-item">
            <b>User Info</b>
        </div>
        <div class="list-group-item">
            <span> Posts </span>
            <span class="badge badge-primary float-right">
                {{ $postsCount }}
            </span>
        </div>
        <div class="list-group-item">
            <span> Attachments </span>
            <span class="badge badge-success float-right">
                {{ $filesCount }}
            </span>
        </div>
    </div>
@endpush()

@push('scripts')
    <script>
        $('.logout').click(function(event){
            event.preventDefault();
            $.ajax({
                url : '{{ route("logout") }}',
                method : 'POST',
                data : {
                    _token : '{{ csrf_token() }}'
                },
                success : function(response){
                    location.reload();
                },
                error : function (response){

                }
            })
        });
    </script>
@endpush()