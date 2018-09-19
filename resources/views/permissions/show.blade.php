@extends('layouts.admin')

@section('content')

<h1>{{ $permission->name }}</h1>
<p>{{ $permission->slug }}</p>
<p>{{ $permission->description }}</p>

<br /><br />
<p><a class="float-right" href="/admin/permissions/{{ $permission->id }}/edit"><button class="btn btn-primary">Edit</button></a></p>
 <br class="clearfix" />

 @endsection
