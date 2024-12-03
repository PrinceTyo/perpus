<h1>Welcome to dashboard admin</h1>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

<table>
    <thead>
        <tr>
            <th>Nama</th>
            <th>Email</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($pendingAuthors as $author)
        <tr>
            <td>{{ $author->name }}</td>
            <td>{{ $author->email }}</td>
            <td>
                <form action="{{ route('index.approve', $author->id) }}" method="POST">
                    @csrf
                    <button type="submit">Setujui</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
