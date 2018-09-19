@extends('layouts.admin.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="">
                

                    @if(count($users))
                    <h1>Users</h1>
                    <div class="table-responsive">          
                        <table class="table">
                             <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Actions</th>
                              </tr>

                              @foreach($users as $user)

                                @include('users.user')

                              @endforeach 

                        </table>

                    @else 

                        No user has been created yet.

                    @endif


            </div>
        </div>
    </div>
</div>
@endsection
