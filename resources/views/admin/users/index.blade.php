<h1>Users</h1>

<table>
    <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Role</th>
    </tr>

    @foreach($users as $user)
        <tr>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->role }}</td>
        </tr>
    @endforeach
</table>
