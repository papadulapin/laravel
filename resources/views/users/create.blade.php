@extends('layouts.admin.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="">
                


                <h1>Create a User</h1>

                  <hr>

                  @include('users.form', [
                    'method' => 'POST', 
                    'action' => action('UserController@store'),
                    'submitButton' => 'Create'
                  ])

                  

            </div>
        </div>
    </div>
</div>
@endsection
