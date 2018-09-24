@extends('layouts.admin.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="">

	@if(count($permissions))
	<h1>Permissions</h1>

	
	<div class="table-responsive">          
  		<table class="table">
		     <tr>
		        <th><input id="check-all" type="checkbox" /> Check All</th>
		        <th>#</th>
		        <th>Name</th>
		        <th>Slug</th>
		        <th>Actions</th>
		      </tr>

			  @foreach($permissions as $permission)
			    @include('permissions.permission')
			  @endforeach 			

  		</table>

  		 <button id="bulk-action" type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal">Bulk Delete</button>
		
		@include('permissions.modal', [
			'bulkAction' => true,
	        'method' => 'DELETE', 
	        'action' => action('PermissionController@bulkDelete'),
	        'submitButton' => 'Yes',
	        'modalDefaultMsg' => 'Are you sure you want to delete this?',
	     ])

	@else 

		No permission has been created yet.

	@endif




            </div>
        </div>
    </div>
</div>



@endsection
