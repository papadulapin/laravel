<tr>
	<td><input class="ids" name="ids[]" value="{{ $permission->id }}" type="checkbox" /></td>
	<td>{{ $permission->id }}</td>
	<td>{{ $permission->name }}</td>
	<td>{{ $permission->slug }}</td>
	<td>

		<a href="/admin/permissions/{{ $permission->id }}/edit"><button type="button" class="btn btn-primary" data-dismiss="modal">Edit</button></a>

		 <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-{{$permission->id }}">Delete</button></td>
</tr>

<tr>
<td colspan="5" style="padding:0;border-top:0;">

	<div class="modal fade" id="modal-{{$permission->id }}">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">

			  <div class="modal-header">
			    <button type="button" class="close " data-dismiss="modal">&times;</button>
			  </div>
			  
			  <div class="modal-slug mx-auto">
			   <p>Are you sure you want to delete this?</p>
			  </div>

			    <ul class="list-inline mx-auto">
			      <li class="list-inline-item">

			        @include('permissions.delete', [
			        'id'     => 'del' . $permission->id,
			        'method' => 'DELETE', 
			        'action' => action('PermissionController@destroy', $permission->id),
			        'submitButton' => 'Yes'
			     ])

			      </li>
			      <li class="list-inline-item"><button type="button" class="btn btn-primary" data-dismiss="modal">No</button></li>
			    </ul>
			  
			  <div class="modal-footer">
			    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			  </div>
			  
			</div>
		</div>
	</div>

</td>	
</tr>



