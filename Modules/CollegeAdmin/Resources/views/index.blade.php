@extends('layouts.main')
@section('content')

        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col">

                    </div>
                    <table class="table .table-responsive ">
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>College</th>
                            <th>Course</th>
                            <th>Status</th>
                        </tr>
                        @foreach($pendingStudent as $student)
                            <tr>
                                <td>{{$student->name}}</td>
                                <td>{{$student->email}}</td>
                                <td>{{$student->getCollege()->title}}</td>
                                <td>{{$student->getCourse()->title}}</td>
                                <td>

                                    <select name="post-status-{{ $student->id }}" class="form-control" data-student-id="{{ $student->id }}" id="action">
                                        <option value="approve"{{$student->status==='active' ? 'selected' : ''}} >Approved</option>
                                        <option value="pending" {{$student->status ==='pending' ? 'selected' : ''}} >Pending</option>
                                        <option value="suspended" {{$student->status === 'suspended' ? 'selected' : ''}} >Suspended</option>
                                    </select>


                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>

@endsection()

@push('scripts')
    <script type="application/ecmascript">
        $(document).on('change','#action',function () {
           let $this = $(this);
           let studentId = $this.data('student-id');
           let actions = $this.val();
           switch (actions) {
               case 'approve':
               let approveurl = window.location.origin + '/admin/collegeAdmin/' + studentId + '/approve';
               let approveData = new Promise((resolve, reject) => {
                       axios.post(approveurl,{})
                           .then(response => resolve(response.data))
                           .catch(err => reject(err.response))
               });
               console.log(approveData);
               break;
               case 'suspended':
                   let suspendUrl = window.location.origin + '/admin/collegeAdmin/' + studentId + '/suspend';
                   let suspendData = new Promise((resolve, reject) => {
                            axios.post(suspendUrl,{})
                                .then(response => resolve(response.data))
                                .catch(err => reject(err.response))
                   });
                   console.log(suspendData);
               }

        });

    </script>


@endpush