<div class="card">
    <div class="card-body">
        <h5>
            Create User
        </h5>
        <div class="col-md-12">
            <form action="{{ route('users.store') }}" method="POST" >
                @csrf()
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control {{ ($errors->has('name')) ? 'is-invalid' : '' }}" />
                    @if($errors->has('name'))
                        <span class="invalid-feedback">
                            {{ $errors->first('name') }}
                        </span>
                    @endif()
                </div>
                <div class="form-group">
                    <label for="name">Email</label>
                    <input type="text" name="email" class="form-control {{ ($errors->has('email')) ? 'is-invalid' : '' }}" />
                    @if($errors->has('email'))
                        <span class="invalid-feedback">
                            {{ $errors->first('email') }}
                        </span>
                    @endif()
                </div>

                <div class="form-group">
                    <label for="name">Password</label>
                    <input type="password" name="password" class="form-control {{ ($errors->has('password')) ? 'is-invalid' : '' }}"/>
                    @if($errors->has('password'))
                        <span class="invalid-feedback">
                        {{ $errors->first('password') }}
                    </span>
                    @endif()
                </div>
                <div class="form-group">
                    <label for="name">Confirm Password</label>
                    <input type="password" name="password_confirmation" class="form-control {{ ($errors->has('password_confirmation')) ? 'is-invalid' : '' }}"/>
                    @if($errors->has('password_confirmation'))
                        <span class="invalid-feedback">
                        {{ $errors->first('password_confirmation') }}
                    </span>
                    @endif()
                </div>

                <div class="row">
                    @if(Auth::user())
                        @if(Auth::user()->hasPermissionTo('assign_role','web'))
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="role">Role</label>
                                    <select class="form-control" name="role">
                                        <option value=""> -- Select Role -- </option>
                                        @foreach(\Spatie\Permission\Models\Role::all() as $role)
                                            <option value="{{ $role->id }}" {{ ((isset($user)) && $user->hasRole($role)) ? 'selected' : '' }}>{{ ucfirst($role->name) }}</option>
                                        @endforeach()
                                    </select>
                                    @if($errors->has('role'))
                                        <span class="invalid-feedback">
                                            {{ $errors->first('role') }}
                                        </span>
                                    @endif()
                                </div>
                            </div>
                        @endif()

                        @if(Auth::user()->hasPermissionTo('assign_status'))
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="role">Status</label>
                                    <select class="form-control" name="status">
                                        <option value="" {{ ((isset($user)) && $user->status == null) ? 'selected' : '' }}> -- Select Status -- </option>
                                        <option value="active" {{ ((isset($user)) && $user->status == 'active') ? 'selected' : '' }}>Active</option>
                                        <option value="suspended" {{ ((isset($user)) && $user->status == 'suspended') ? 'selected' : '' }}>Suspended</option>
                                        <option value="pending" {{ ((isset($user)) && $user->status == null) ? 'pending' : '' }}>Pending</option>
                                    </select>
                                    @if($errors->has('status'))
                                        <span class="invalid-feedback">
                                            {{ $errors->first('status') }}
                                        </span>
                                    @endif()
                                </div>
                            </div>
                        @endif()
                    @endif()
                </div>

                <div class="form-group">
                    <button class="btn float-right btn-primary">Register User</button>
                </div>
            </form>
        </div>
    </div>
</div>