
@section('content')
    <div class="container">
        <h2>Edit Data Rak</h2>

        <!-- Display validation errors -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('rak.update', $rak->id_rak) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
    <label for="id_rak">ID Rak</label>
    <input type="text" class="form-control" id="id_rak" name="id_rak" value="{{ old('id_rak', $rak->id_rak) }}" readonly required>
</div>


            <div class="form-group">
                <label for="nama_rak">Nama Rak</label>
                <input type="text" class="form-control" id="nama_rak" name="nama_rak" value="{{ old('nama_rak', $rak->nama_rak) }}" required>
            </div>

            <div class="form-group">
                <label for="id_lokasi">Lokasi Rak</label>
                <select class="form-control" id="id_lokasi" name="id_lokasi" required>
                    <option value="1" {{ $rak->id_lokasi == 1 ? 'selected' : '' }}>Tata Usaha</option>
                    <option value="2" {{ $rak->id_lokasi == 2 ? 'selected' : '' }}>Perencanaan dan Evaluasi DAS</option>
                    <option value="3" {{ $rak->id_lokasi == 3 ? 'selected' : '' }}>RHL</option>
                    <option value="4" {{ $rak->id_lokasi == 4 ? 'selected' : '' }}>Penguatan Kelembagaan DAS</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Update Rak</button>
        </form>
    </div>

