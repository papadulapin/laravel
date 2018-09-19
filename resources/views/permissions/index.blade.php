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
		        <th>#</th>
		        <th>Name</th>
		        <th>Slug</th>
		        <th>Actions</th>
		      </tr>

			  @foreach($permissions as $permission)

			    @include('permissions.permission')

			  @endforeach 


  		</table>


	@else 

		No permission has been created yet.

	@endif




            </div>
        </div>
    </div>
</div>
@endsection
