<div class="card">
    <div class="card-body">
        <h5>
            Edit User
        </h5>
        <div class="col-md-12">
            <form action="{{ route('users.update', $user->id) }}" method="POST" >
                @csrf()
                @method('PUT')
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control {{ ($errors->has('name')) ? 'is-invalid' : '' }}" value="{{ $user->name }}" />
                    @if($errors->has('name'))
                        <span class="invalid-feedback">
                            {{ $errors->first('name') }}
                        </span>
                    @endif()
                </div>
                <div class="form-group">
                    <label for="name">Email</label>
                    <input type="text" name="email" class="form-control {{ ($errors->has('email')) ? 'is-invalid' : '' }}" value="{{ $user->email }}" />
                    @if($errors->has('email'))
                        <span class="invalid-feedback">
                            {{ $errors->first('email') }}
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
                    <button class="btn float-right btn-primary">Update Details</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="card" style="margin-top:20px; margin-bottom: 20px;">
    <div class="card-body">
        <h5>
            User Info
        </h5>
        <div class="col-md-12">
            <form action="{{ route('user-meta.update') }}" method="POST" >
                <div id="userMetaForm">
                    @csrf()
                    @method('PATCH')
                    <div class="form-group">
                        <label for="name">Bio</label>
                        <textarea type="text" name="bio" class="form-control {{ ($errors->has('bio')) ? 'is-invalid' : '' }}" >{{ ($user->getMeta('bio')) ? $user->getMeta('bio')->value : '' }}</textarea>
                        @if($errors->has('bio'))
                            <span class="invalid-feedback">
                                {{ $errors->first('bio') }}
                            </span>
                        @endif()
                    </div>
                    <div class="form-group">
                        @if($user->hasRole('student'))
                            <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Faculty</label>
                                    <input type="text" name="faculty" class="form-control"  value="{{ ($user->getMeta('faculty')) ? $user->getMeta('faculty')->value : '' }}" class="{{ ($errors->has('faculty')) ? 'is-invalid' : '' }}" />
                                    @if($errors->has('faculty'))
                                        <span class="invalid-feedback">
                                            {{ $errors->first('faculty') }}
                                        </span>
                                    @endif()
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Batch</label>
                                    <input type="number" name="batch"  value="{{ ($user->getMeta('batch')) ? $user->getMeta('batch')->value : '' }}" class="form-control {{ ($errors->has('batch')) ? 'is-invalid' : '' }}" />
                                    @if($errors->has('batch'))
                                        <span class="invalid-feedback">
                                            {{ $errors->first('batch') }}
                                        </span>
                                    @endif()
                                </div>
                            </div>
                        </div>
                        @endif()
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Facebook URL</label>
                                    <input type="text" name="facebook" class="form-control {{ ($errors->has('facebook')) ? 'is-invalid' : '' }}" value="{{ ($user->getMeta('facebook')) ? $user->getMeta('facebook')->value : '' }}" placeholder="https://fb.com/{your-user-name}" />
                                    @if($errors->has('facebook'))
                                        <span class="invalid-feedback">
                                            {{ $errors->first('facebook') }}
                                        </span>
                                    @endif()
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Twitter URL</label>
                                    <input type="text" name="twitter" class="form-control {{ ($errors->has('twitter')) ? 'is-invalid' : '' }}"  value="{{ ($user->getMeta('twitter')) ? $user->getMeta('twitter')->value : '' }}" placeholder="https://twitter.com/{your-user-name}" />
                                    @if($errors->has('twitter'))
                                        <span class="invalid-feedback">
                                            {{ $errors->first('twitter') }}
                                        </span>
                                    @endif()
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="name">Phone</label>
                                    <input type="text" name="phone" value="{{ ($user->getMeta('phone')) ? $user->getMeta('phone')->value : '' }}" class="form-control {{ ($errors->has('phone')) ? 'is-invalid' : '' }}" />
                                    @if($errors->has('phone'))
                                        <span class="invalid-feedback">
                                            {{ $errors->first('phone') }}
                                        </span>
                                    @endif()
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name">Website</label>
                        <input type="text" name="website" value="{{ ($user->getMeta('website')) ? $user->getMeta('website')->value : '' }}" class="form-control {{ ($errors->has('website')) ? 'is-invalid' : '' }}" />
                        @if($errors->has('website'))
                            <span class="invalid-feedback">
                                {{ $errors->first('website  ') }}
                            </span>
                        @endif()
                    </div>

                    @if($user->hasCustomMeta())
                        @foreach($user->getCustomMeta() as $meta)
                            <div class="form-group" data-custom-field="{{ json_encode($meta) }}" >
                                <button class="btn btn-sm float-right btn-outline-danger deleteMeta" data-id="{{$meta->id}}"> <i class="fa fa-trash"></i> </button>
                                <button class="btn btn-sm float-right btn-outline-primary editMeta mx-1" data-id="{{$meta->id}}"> <i class="fa fa-edit"></i> </button>
                                <label for="{{ $meta->key }}">{{ ucfirst($meta->key) }}</label>
                                <input type="text" name="{{ $meta->key }}" value="{{ $user->getMeta($meta->key)->value }}" class="form-control {{ ($errors->has($meta->key)) ? 'is-invalid' : '' }}" />
                                @if($errors->has($meta->key))
                                    <span class="invalid-feedback">
                                        {{ $errors->first($meta->key) }}
                                    </span>
                                @endif()
                            </div>
                        @endforeach()
                    @endif()

                </div>
                <div class="form-group">
                    <button class="btn float-right btn-primary" >Update Meta</button>
                    <a href="#bottom" class="btn btn-success" data-toggle="modal" data-target="#createCustomFieldModal">Add Custom Field</a>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="card">
    <div class="card-body">
        <h5>
            Change Password
        </h5>
        <div class="col-md-12">
            <form action="{{ route('change-password') }}" method="POST" >
                @csrf()
                @if($user->password !== null)
                    <div class="form-group">
                    <label for="name">Current Password</label>
                    <input type="password" name="current_password" autocomplete="false" class="form-control {{ ($errors->has('current_password')) ? 'is-invalid' : '' }}"/>
                    @if($errors->has('current_password'))
                        <span class="invalid-feedback">
                            {{ $errors->first('current_password') }}
                        </span>
                    @endif()
                </div>
                @endif()
                <div class="form-group">
                    <label for="name">New Password</label>
                    <input type="password" name="password" autocomplete="false" class="form-control {{ ($errors->has('password')) ? 'is-invalid' : '' }}" />
                @if($errors->has('password'))
                    <span class="invalid-feedback">
                            {{ $errors->first('password') }}
                        </span>
                    @endif()
                </div>
                <div class="form-group">
                    <label for="name">Confirm Password </label>
                    <input type="password" name="password_confirmation" autocomplete="false" class="form-control {{ ($errors->has('password_confirmation')) ? 'is-invalid' : '' }}" />
                    @if($errors->has('password_confirmation'))
                        <span class="invalid-feedback">
                            {{ $errors->first('password_confirmation') }}
                        </span>
                    @endif()
                </div>


                <div class="form-group">
                    <button class="btn float-right btn-primary">Update Password</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" id="createCustomFieldModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Custom Field</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Title</label>
                    <input type="text" id="customFieldKey" class="form-control">
                </div>
                <div class="form-group">
                    <label>Type</label>
                    <select id="customFieldType" class="form-control" onchange="changeCustomPostType()">
                        <option value="text">Text</option>
                        <option value="number">Number</option>
                        <option value="date">Date</option>
                        <option value="time">Time</option>
                        <option value="url">URL</option>
                        <option value="email">Email</option>
                        <option value="tel">Phone</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Value</label>
                    <input type="text" id="customFieldValue" class="form-control">
                </div>
                <div class="form-group">
                    <label>Icon</label>
                    <input type="text" id="customFieldIcon" class="form-control">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="appendCustomField()" data-dismiss="modal">Add Field</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editCustomFieldModal" tabindex="-1" role="dialog" aria-hidden="true">
    <form data-action="{{ route('user-meta.update', ':id') }}" id="updateCustomMetaForm">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Custom Field</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" name="key" id="customFieldKeyUpdate" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Type</label>
                        <select id="customFieldTypeUpdate" name="type" class="form-control" onchange="changeCustomPostType()">
                            <option value="text">Text</option>
                            <option value="number">Number</option>
                            <option value="date">Date</option>
                            <option value="time">Time</option>
                            <option value="url">URL</option>
                            <option value="email">Email</option>
                            <option value="tel">Phone</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Value</label>
                        <input type="text" id="customFieldValueUpdate" name="value" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Icon</label>
                        <input type="text" id="customFieldIconUpdate" name="icon" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </form>
</div>
<script>
    function appendCustomField(){
        var customFieldKey = document.getElementById('customFieldKey').value;
        var customFieldValue = document.getElementById('customFieldValue').value;
        var customFieldType = document.getElementById('customFieldType').value;
        var customFieldIcon = document.getElementById('customFieldIcon').value;

        if(customFieldKey == ''){
            alert('The custom field name can\'t be empty!');
        }else{
            var parent = document.getElementById('userMetaForm');


            var formGroup = document.createElement('div');
            formGroup.classList.add('form-group');

            var label = document.createElement('label');
            label.innerText = customFieldKey;

            var customFielTypeForm = document.createElement('input');
            var customFielIconForm = document.createElement('input');

            var input = document.createElement('input');
            input.setAttribute('type','text');
            input.setAttribute('name',customFieldKey+'[value]');
            input.setAttribute('class','form-control');
            input.setAttribute('value',customFieldValue);
            customFielTypeForm.setAttribute('type', 'text');
            customFielIconForm.setAttribute('type', 'text');
            customFielTypeForm.setAttribute('name', customFieldKey+'[type]');
            customFielIconForm.setAttribute('name', customFieldKey+'[icon]');
            customFielTypeForm.setAttribute('value', customFieldType);
            customFielIconForm.setAttribute('value', customFieldIcon);
            customFielTypeForm.setAttribute('hidden', true);
            customFielIconForm.setAttribute('hidden', true);

            formGroup.appendChild(customFielTypeForm);
            formGroup.appendChild(customFielIconForm);
            formGroup.appendChild(label);
            formGroup.appendChild(input);
            parent.appendChild(formGroup);
        }
    }

    function changeCustomPostType(){
        var customFieldValue = document.getElementById('customFieldValue');
        var customFieldType = document.getElementById('customFieldType').value;
        customFieldValue.setAttribute('type', customFieldType);
    }
</script>

@push('scripts')
    <script src="{{ asset('/js/bootstrap-picker.min.js') }}"></script>
    <script src="{{ asset('/js/notifjs.js') }}"></script>
    <script src="{{ asset('/js/fontawesome-iconpicker.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('.deleteMeta').click(function(event){
                var deleteUrl  = '{{ route('user-meta.delete', ':id') }}';
                deleteUrl=  deleteUrl.replace(':id', $(this).data('id'));
                event.preventDefault();
                self = $(this);
                $.ajax({
                    url: deleteUrl,
                    method : 'DELETE',
                    data : {
                        '_token' : '{{ csrf_token() }}'
                    },
                    success : function(response){
                        AjaxNotifier(response,200);
                        self.parent().fadeOut(300);
                        $('html, body').animate({scrollTop:0}, '300');
                    },
                    error : function(response){
                        AjaxNotifier(response, response.status);
                        $('html, body').animate({scrollTop:0}, '300');
                    }
                })
            });
            $('.editMeta').click(function(event){
                event.preventDefault();
                var custom_field = ($(this).parent().data('custom-field'));
                $('#editCustomFieldModal').modal();

            });
            $('#customFieldIcon').focus(function(event){
                event.preventDefault();
                $(this).iconpicker();
            });
        });
    </script>
@endpush()

@push('styles')
    <link href="{{ asset('/css/bootstrap-picker.min.css') }}" />
    <link href="{{ asset('/css/fontawesome-iconpicker.min.css') }}" />
@endpush()