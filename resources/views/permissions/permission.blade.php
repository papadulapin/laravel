<tr>
	<td>{{ $permission->id }}</td>
	<td>{{ $permission->name }}</td>
	<td>{{ $permission->slug }}</td>
	<td><a href="/admin/permissions/{{ $permission->id }}/edit">Edit</a></td>
</tr>