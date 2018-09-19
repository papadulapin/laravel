@extends('layouts.admin.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="">
                


                <h1>Create a Role</h1>

                  <hr>

                  @include('roles.form', [
                    'method' => 'POST', 
                    'action' => action('RoleController@store'),
                    'submitButton' => 'Create'
                  ])

                  

            </div>
        </div>
    </div>
</div>
@endsection
