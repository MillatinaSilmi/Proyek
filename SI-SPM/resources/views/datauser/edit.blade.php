<form action="{{ route('datauser.update', $user->NIP) }}" method="POST">
    @csrf
    @method('PUT')

       
    
    <div>
        <label for="NIP">NIP</label>
        <!-- Tampilkan NIP sebagai readonly -->
        <input type="text" name="NIP" value="{{ $user->NIP }}" readonly>
    </div>

    <div>
        <label for="nama">Nama</label>
        <input type="text" name="nama" value="{{ $user->nama }}" required>
    </div>

    <div>
        <label for="role">Role</label>
        <select name="id_role" required>
            @foreach($role as $role)
                <option value="{{ $role->id_role }}" {{ $user->id_role == $role->id_role ? 'selected' : '' }}>
                    @if($role->id_role == 1)
                        Admin
                    @elseif($role->id_role == 2)
                        Pegawai
                    @else
                        {{ $role->name }}
                    @endif
                </option>
            @endforeach
        </select>
    </div>

    <div>
        <label for="password">Password</label>
        <input type="password" name="password">
    </div>

    
    <button type="submit">Update User</button>
    @if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
</form>
