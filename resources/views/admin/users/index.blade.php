<h1>Users</h1>

<table>
    <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Role</th>
        <th>Pas Role Aan</th>
    </tr>

    @foreach($users as $user)
        <tr>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->role }}</td>
            <td>
                <form method="POST" action="{{ route('users.changeRole', $user) }}">
                    @csrf
                    @method('PATCH')

                    <button type="submit">
                        Verander
                    </button>
                </form>
            </td>
        </tr>
    @endforeach
</table>
