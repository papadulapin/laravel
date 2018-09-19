@extends('layouts.admin.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="">
                

                    @if(count($roles))
                    <h1>Roles</h1>
                    <div class="table-responsive">          
                        <table class="table">
                             <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Actions</th>
                              </tr>

                              @foreach($roles as $role)

                                @include('roles.role')

                              @endforeach 

                        </table>

                    @else 

                        No role has been created yet.

                    @endif


            </div>
        </div>
    </div>
</div>
@endsection
