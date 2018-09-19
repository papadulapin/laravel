@extends('layouts.admin.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="">
                
                <h1>Edit a Role</h1>
                <hr>

                @include('roles.form', [
                  'method' => 'PUT', 
                  'action' => action('RoleController@update', $role->id),
                  'submitButton' => 'Update'
                ])

            </div>
        </div>
    </div>
</div>
@endsection
