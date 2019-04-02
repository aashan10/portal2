@extends('layouts.main')

@section('content')
<div class="card">
    <div class="row">
        <div class="col-md-12">
            <h4 class="mt-3 mx-1    ">Please Tell Us More About Yourself!!</h4>
            <form action="" method="post" class="form mx-2">
                    @csrf()
                    @method('PATCH')
                <label for="Name">Name</label>
                <input type="text" class="form-control"  value="{{\Illuminate\Support\Facades\Auth::user()->name}}">
                <label for="Email">Email</label>
                <input type="email" class="form-control"  value="{{\Illuminate\Support\Facades\Auth::user()->email}}">

                <div class="form-group">
                    <label for="name">Bio</label>
                    <textarea type="text" name="bio" class="form-control" >{{\Illuminate\Support\Facades\Auth::user()->getMeta('bio') ? \Illuminate\Support\Facades\Auth::user()->getMeta('bio')->value: ''}}</textarea>
                </div>
                <div class="form-group">
                    <label for="name">College</label>
                    <select name="college" id="" class="form-control"  >
                        @if(\Illuminate\Support\Facades\Auth::user()->getMeta('college'))
                            <option value="">{{\Illuminate\Support\Facades\Auth::user()->getMeta('college')->value}}</option>
                        @else
                            @foreach($colleges as $college)
                                <option value="">Please Select Your College</option>
                                <option value="{{$college->name}}">{{$college->name}}</option>

                            @endforeach
                        @endif
                    </select>
{{--                    <input type="text" name="College" class="form-control" value="{{\Illuminate\Support\Facades\Auth::user()->getMeta('College') ? \Illuminate\Support\Facades\Auth::user()->getMeta('College')->value : ''}}" required>--}}
                </div>
                <div class="form-group">
                    <label for="name">Year</label>
                    <input type="text" class="form-control" name="Year" value="{{\Illuminate\Support\Facades\Auth::user()->getMeta('Year') ? \Illuminate\Support\Facades\Auth::user()->getMeta('Year')->value : ''}}"  required>
                </div>
                <div class="form-group">
                    @if(\Illuminate\Support\Facades\Auth::user()->hasRole('student'))
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Faculty</label>
                                    <input type="text" name="faculty" class="form-control" placeholder="BIT, Bsc.Csit" required  value="{{\Illuminate\Support\Facades\Auth::user()->getMeta('faculty') ? \Illuminate\Support\Facades\Auth::user()->getMeta('faculty')->value : ''}}" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Semester</label>
                                    <input type="text" name="Semester" placeholder="First" class="form-control" value="{{\Illuminate\Support\Facades\Auth::user()->getMeta('sem_Year') ? \Illuminate\Support\Facades\Auth::user()->getMeta('sem_Year')->value : ''}}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Facebook Url:</label>
                                    <input type="text" class="form-control" name="facebook" value="{{\Illuminate\Support\Facades\Auth::user()->getMeta('facebook') ? \Illuminate\Support\Facades\Auth::user()->getMeta('facebook')->value : ''}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Twitter Url:</label>
                                    <input type="text" class="form-control" name="twitter" value="{{\Illuminate\Support\Facades\Auth::user()->getMeta('twitter') ? \Illuminate\Support\Facades\Auth::user()->getMeta('twitter')->value : ''}}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name">Phone</label>
                            <input type="number" class="form-control" name="phone" value="{{\Illuminate\Support\Facades\Auth::user()->getMeta('phone') ? \Illuminate\Support\Facades\Auth::user()->getMeta('phone')->value : ''}}">
                        </div>
                        <div class="form-group">
                            <label for="name">Website</label>
                            <input type="text" class="form-control" name="website" value="{{\Illuminate\Support\Facades\Auth::user()->getMeta('website') ? \Illuminate\Support\Facades\Auth::user()->getMeta('website')->value : ''}}">
                        </div>

                    @endif
                </div>
                <button class="btn btn-success mt-3 float-right mb-2">Update Info</button>
            </form>
        </div>
    </div>
</div>

    @endsection