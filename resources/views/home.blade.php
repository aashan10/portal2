@extends('layouts.main')

@push('styles')
    <style>
        .text-decoration-none:hover { 
            text-decoration : none;
        }
        .attachments{
            line-height: 0;
            -webkit-column-count: 5;
            -webkit-column-gap:   0px;
            -moz-column-count:    5;
            -moz-column-gap:      0px;
            column-count:         5;
            column-gap:           0px;
        }
        .attachments img {
            width: 100% !important;
            height: auto !important;
        }
        @media (max-width: 1200px) {
            .attachments {
            -moz-column-count:    4;
            -webkit-column-count: 4;
            column-count:         4;
            }
        }
        @media (max-width: 1000px) {
            .attachments {
            -moz-column-count:    3;
            -webkit-column-count: 3;
            column-count:         3;
            }
        }
        @media (max-width: 800px) {
            .attachments {
            -moz-column-count:    2;
            -webkit-column-count: 2;
            column-count:         2;
            }
        }
        @media (max-width: 400px) {
            .attachments {
            -moz-column-count:    1;
            -webkit-column-count: 1;
            column-count:         1;
            }
        }
    </style>
@endpush()
@section('content')
    @include('post.components.create')
    @include('post.show')
    <div id="attachmentsModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title float-left" id="modalFileName"></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <iframe style="position:relative;height:500px;width:100%; border:0;" id="attachmentPreview"></iframe>
            </div>
            <div class="modal-footer">
                <div id="attachmentDetails">

                </div>
                <a href="#" class="btn btn-primary" id="downloadButton">Download File</a>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
    </div>
@endsection()

@push('sidebar-left')

    @include('components.sidebars.admin-sidebar-left')

    <ul class="list-group">
        

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
        $('.attachment').click(function(event){
            event.preventDefault();
            var attachment = $(this).data('url');
            var attachment_meta = $(this).data('attachment-meta');
            $('#attachmentPreview').attr('src', attachment);
            $('#downloadButton').attr('href', attachment);
            $('#modalFileName').text($(this).data('name'));
            attachment_meta.map(function(element){
                $('#attachmentDetails').append("<span class='badge badge-primary'>"+element.value+"</span>");
            });
            $('#attachmentsModal').modal();
        });
    </script>
@endpush()