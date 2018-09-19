@extends('layouts.admin.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="">


                <h1>Edit a User</h1>

                  <hr>

                  @include('users.form', [
                    'method' => 'PUT', 
                    'action' => action('UserController@update', $user->id),
                    'submitButton' => 'Update'
                  ])

                  

            </div>
        </div>
    </div>
</div>
@endsection
