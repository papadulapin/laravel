<form method="POST" action="{{ $action }}">

  @csrf

  <input name="_method" type="hidden" value="{{ $method }}">
  
  <div class="form-group">

    <label for="name">Name</label>
    <input value="{{ isset($role) ? $role->name : old('name') }}" type="text" name="name" class="form-control {{ ($errors->has('name')) ? 'is-invalid' : '' }}" id="name">

    @if($errors->has('name'))
    
      <div class="invalid-feedback">{{ $errors->first('name') }}</div>

    @endif

  </div>

   <input type="hidden" name="slug" id="slug" class="form-control {{ ($errors->has('slug')) ? 'is-invalid' : '' }}" value="{{ isset($role) ? $role->slug : old('slug') }}" />




<div class="form-group">

     <label for="permission" >Permissions</label><br class="form-control {{ ($errors->has('permissions')) ? 'is-invalid' : '' }}" />
    
    @foreach( \App\Permission::all() as $perm)
      
      @php

        if (old('permissions')) {

            if (in_array($perm->id, old('permissions', []))) {
              $bChecked = true;
            } else {
              $bChecked = false;
            }

        } else {

            if ( isset($role) && $role->hasPrivilege(\App\Permission::class, $perm->slug) ) {
              $bChecked = true;
            } else {
              $bChecked = false;
            }

        }

      @endphp

      <input type="checkbox" name="permissions[]" value="{{ $perm->id }}" {{ $bChecked ? ' checked ' : '' }} /> {{ $perm->slug }}<br />
    
    @endforeach

    @if($errors->has('permissions'))
    
      <div class="invalid-feedback">{{ $errors->first('permissions') }}</div>

    @endif


  </div>

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

            @include('roles.delete', [
            'method' => 'DELETE', 
            'action' => action('RoleController@destroy', $role->id),
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



