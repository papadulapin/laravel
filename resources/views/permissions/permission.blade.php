<tr>
	<td><input class="ids" name="ids[]" value="{{ $permission->id }}" type="checkbox" /></td>
	<td>{{ $permission->id }}</td>
	<td class="td-label">{{ $permission->name }}</td>
	<td>{{ $permission->slug }}</td>
	<td>

		<a href="/admin/permissions/{{ $permission->id }}/edit"><button type="button" class="btn btn-primary" data-dismiss="modal">Edit</button></a>

		 <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-{{$permission->id }}">Delete</button></td>
</tr>

<tr>
<td colspan="5" style="padding:0;border-top:0;">

@include('permissions.modal', [
 	'permission_id' => $permission->id,
    'method' => 'DELETE', 
    'action' => action('PermissionController@destroy', $permission),
    'submitButton' => 'Yes',
    'modalDefaultMsg' => 'Are you sure you want to delete this?',
 ])

</td>	
</tr>



