@extends('layouts.admin.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="">

<h1>Edit a Permission</h1>
  <hr>

	@include('permissions.form', [
    'method' => 'PUT', 
    'action' => action('PermissionController@update', $permission->id),
    'submitButton' => 'Update'
  ])

            </div>
        </div>
    </div>
</div>
@endsection
