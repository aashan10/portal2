@extends('layouts.main')

@push('sidebar-left')
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

@section('content')
    <div class="card">
        <div class="card-body">
            <h4>Add College</h4>
        </div>
        <div class="col-md-12">
            <form action="{{ !isset($college) ? route('admin.college.store') : route('admin.college.update', $college->id) }}" method="POST">
                @csrf()

                <div class="form-group">
                    <label for="collegeName">Name</label>
                    <input type="text" class="form-control" value="{{ (isset($college)) ? $college->title : ''  }}" id="collegeName" name="title" />
                </div>
                <div class="form-group">
                    <label for="collegeAddress">Address</label>
                    <input type="text" class="form-control" value="{{ (isset($college)) ? $college->address : ''  }}" id="collegeAddress" name="address" />
                </div>
                <div class="form-group">
                    <label for="collegeContact">Phone</label>
                    <input type="text" class="form-control" value="{{ (isset($college)) ? $college->contact : ''  }}" id="collegeContact" name="contact" />
                </div>
                <div class="form-group">
                    <label for="collegeEmail">Email</label>
                    <input type="text" class="form-control" value="{{ (isset($college)) ? $college->email : ''  }}" id="collegeEmail" name="email" />
                </div>
                <div class="form-group">
                    <label for="collegeEmailBanner">Banner Image</label>
                        <img src="{{ isset($college) ? $college->getBannerImage() : '' }}" id="collegeBannerImage" class="img-fluid"/>
                    <input type="file" class="form-control" id="collegeBanner" name="banner" />
                </div>
                <div class="form-group">
                    <label for="collegeDescription">Description</label>
                    <textarea class="form-control" id="collegeDescription" name="description" >{{ (isset($college)) ? $college->description : ''  }}</textarea>
                </div>
                <div class="form-group">
                    <button type="submit" id="createCollege" class="btn btn-primary float-right">Add College</button>
                    <br/>
                    <br/>
                </div>
            </form>
        </div>
    </div>
@endsection()