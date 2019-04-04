@role('admin')
    <div class="card">
        <div class="card-body">
            <div class="list-group">
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
            </div>
        </div>
    </div>            
@endrole()