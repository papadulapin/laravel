<tr>
	<td>{{ $user->id }}</td>
	<td>{{ $user->name }}</td>
	<td>{{ $user->email }}</td>
	<td><a href="/admin/users/{{ $user->id }}/edit">Edit</a></td>
</tr>