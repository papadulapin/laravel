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
		        <th><input id="check-all" type="checkbox" /></th>
		        <th>#</th>
		        <th>Name</th>
		        <th>Slug</th>
		        <th>Actions</th>
		      </tr>

		      <tr><td>
		      	
				

		      </td></tr>				


			  @foreach($permissions as $permission)
			    @include('permissions.permission')
			  @endforeach 			

  		</table>

  		 <button id="bulk-action" type="button" class="btn btn-danger" data-toggle="modal" data-target="">Bulk Delete</button>
		




			<div class="modal fade" id="modal">
				<div class="modal-dialog modal-dialog-centered">
					<div class="modal-content">

					  <div class="modal-header">
					    <button type="button" class="close " data-dismiss="modal">&times;</button>
					  </div>
					  
					  <div class="modal-slug mx-auto">
					   <p>Are you sure you want to delete this?</p>
					  </div>

					    <ul class="list-inline mx-auto">
					      <li class="list-inline-item">

					       <form method="POST" action="{{ action('PermissionController@bulkDelete') }}">
							  @csrf
						  	<input name="_method" type="hidden" value="DELETE">
						  	<input id="ids" name="permissions" type="hidden" value="">

					  		<button type="submit" class="btn btn-danger">Yes</button>
							</form>

					      </li>
					      <li class="list-inline-item"><button type="button" class="btn btn-primary" data-dismiss="modal">No</button></li>
					    </ul>
					  
					  <div class="modal-footer">
					    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					  </div>
					  
					</div>
				</div>
			</div>



	@else 

		No permission has been created yet.

	@endif




            </div>
        </div>
    </div>
</div>



@endsection
