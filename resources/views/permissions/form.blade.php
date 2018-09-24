<form method="POST" action="{{ $action }}">

  @csrf

  <input name="_method" type="hidden" value="{{ $method }}">
  
  <div class="form-group">

    <label for="name">Name</label>
    <input value="{{ isset($permission) ? $permission->name : old('name') }}" type="text" name="name" class="form-control {{ ($errors->has('name')) ? 'is-invalid' : '' }}" id="name">

    @if($errors->has('name'))
    
      <div class="invalid-feedback">{{ $errors->first('name') }}</div>

    @endif

  </div>

   <input type="hidden" name="slug" id="slug" class="form-control {{ ($errors->has('slug')) ? 'is-invalid' : '' }}" value="{{ isset($permission) ? $permission->slug : old('slug') }}" />

{{-- 
  <div class="form-group">

    
    <label for="slug">Slug</label>
    <input type="text" name="slug" id="slug" class="form-control {{ ($errors->has('slug')) ? 'is-invalid' : '' }}" value="{{ isset($permission) ? $permission->slug : old('slug') }}" />

     @if($errors->has('slug'))
    
      <div class="invalid-feedback">{{ $errors->first('slug') }}</div>

    @endif

  </div> --}}

  <div class="form-group float-right">

	 <ul class="list-inline">
	  
	      <li class="list-inline-item">

	        <button type="submit" class="btn btn-primary">{{ $submitButton }}</button>

	      </li> 
	      <li class="list-inline-item">

	        @if($method == 'PUT')
	        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal{{ isset($permission->id) ? '-' . $permission->id : '' }}">Delete</button>
	        @endif
	      </li>
	  </ul>

    </div>

</form>


@if($method == 'PUT')

  @include('permissions.modal', [
      'method' => 'DELETE', 
      'action' => action('PermissionController@destroy', $permission),
      'submitButton' => 'Yes',
      'modalDefaultMsg' => 'Are you sure you want to delete this?',
   ])

@endif



