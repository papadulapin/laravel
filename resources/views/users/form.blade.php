<form method="POST" action="{{ $action }}">

  @csrf

  <input name="_method" type="hidden" value="{{ $method }}">
  
  <div class="form-group">

    <label for="first_name">First Name</label>
    <input value="{{ isset($user) ? $user->first_name : old('first_name') }}" type="text" name="first_name" class="form-control {{ ($errors->has('first_name')) ? 'is-invalid' : '' }}" id="first_name">

    @if($errors->has('first_name'))
    
      <div class="invalid-feedback">{{ $errors->first('first_name') }}</div>

    @endif

  </div>

  <div class="form-group">

    <label for="last_name">Last Name</label>
    <input value="{{ isset($user) ? $user->last_name : old('last_name') }}" type="text" name="last_name" class="form-control {{ ($errors->has('last_name')) ? 'is-invalid' : '' }}" id="last_name">

    @if($errors->has('last_name'))
    
      <div class="invalid-feedback">{{ $errors->first('last_name') }}</div>

    @endif

  </div>

  <div class="form-group">

    <label for="email">Email</label>
    <input value="{{ isset($user) ? $user->email : old('email') }}" type="email" name="email" class="form-control {{ ($errors->has('email')) ? 'is-invalid' : '' }}" id="email">

    @if($errors->has('email'))
    
      <div class="invalid-feedback">{{ $errors->first('email') }}</div>

    @endif

  </div>




  @if($method !== 'PUT')
  <div class="form-group">

    <label for="password">Password</label>
    <input value="{{ isset($user) ? $user->password : old('password') }}" type="password" name="password" class="form-control {{ ($errors->has('password')) ? 'is-invalid' : '' }}" id="password">

    @if($errors->has('password'))
    
      <div class="invalid-feedback">{{ $errors->first('password') }}</div>

    @endif

  </div>

    <div class="form-group">

    <label for="password_confirmation">Password Confirmation</label>
    <input value="{{ isset($user) ? $user->password : old('password') }}" type="password" name="password_confirmation" class="form-control {{ ($errors->has('password_confirmation')) ? 'is-invalid' : '' }}" id="password_confirmation">

    @if($errors->has('password_confirmation'))
    
      <div class="invalid-feedback">{{ $errors->first('password_confirmation') }}</div>

    @endif

  </div>
  @endif


  @if ($allRoles)

  <div class="form-group">

     <label for="roles" >Roles</label><br class="form-control" />

    @foreach($allRoles as $role)

        @php

          if ( old('roles') ) {

            if ( in_array($role->id, old('roles', [])) ) {

                  $bChecked = true;

                } else {

                  $bChecked = false;
              }

          } else {

              if ( isset($user) && $user->hasPrivilege(\App\Role::class, $role->slug) ) {

                  $bChecked = true;

                } else {
                  
                  $bChecked = false;
              }
          }

        @endphp

        <input type="checkbox" name="roles[]" value="{{ $role->id }}" {{ $bChecked ? ' checked' : '' }} /> {{ $role->name }}<br />
      
    @endforeach

  </div>

  @endif




  @if ($allPermissions)

  <div class="form-group">

     <label for="permissions" >Permissions</label><br class="form-control" />

    @foreach($allPermissions as $permission)

        @php

          if ( old('permissions') ) {

            if ( in_array($permission->id, old('permissions', [])) ) {

                  $bChecked = true;

                } else {

                  $bChecked = false;
              }

          } else {

              if ( isset($user) && $user->hasPrivilege(\App\Permission::class, $permission->slug) ) {

                  $bChecked = true;

                } else {
                  
                  $bChecked = false;
              }
          }

        @endphp

        <input type="checkbox" name="permissions[]" value="{{ $permission->id }}" {{ $bChecked ? ' checked' : '' }} /> {{ $permission->name }}<br />
      
    @endforeach

  </div>

  @endif






  <div class="form-group float-right">

	 <ul class="list-inline">
	  
	      <li class="list-inline-item">

	        <button type="submit" class="btn btn-primary">{{ $submitButton }}</button>

	      </li> 
	      <li class="list-inline-item">

	        @if($method == 'PUT')
	        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal">Delete</button>
	        @endif
	      </li>
	  </ul>

    </div>

</form>


@if($method == 'PUT')
<div class="modal fade" id="myModal">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
    
      <div class="modal-header">
        <button type="button" class="close " data-dismiss="modal">&times;</button>
      </div>
      
      <div class="modal-slug mx-auto">
        <p>
        Are you sure you want to delete this?
        </p>
    </div>

        <ul class="list-inline mx-auto">
          <li class="list-inline-item">

            @include('users.delete', [
            'method' => 'DELETE', 
            'action' => action('UserController@destroy', $user->id),
            'submitButton' => 'Yes'
         ])

          </li>
          <li class="list-inline-item"><button type="button" class="btn btn-primary" data-dismiss="modal">No</button></li>
        </ul>
      
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
      
    </div>
  </div>
</div>
@endif



