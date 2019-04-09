@role('admin')
    <div class="card mb-3">
        <div class="card-body px-0">
            <b class="px-3">
                Useful Admin Links
            </b>
            <div class="list-group">
                @if($pendingUsers > 0)
                    <a class="list-group-item" href="#">
                        <i class="fa fa-user"></i> Inactive Users
                        <span class="badge badge-danger float-right">
                            {{ $pendingUsers }}
                        </span>
                    </a>
                @endif()
                @if($suspendedStudents > 0)
                    <a class="list-group-item" href="#">
                        <i class="fa fa-user"></i> Suspended Users
                        <span class="badge badge-danger float-right">
                            {{ $pendingUsers }}
                        </span>
                    </a>
                @endif()
            </div>
        </div>
    </div>            
@endrole()