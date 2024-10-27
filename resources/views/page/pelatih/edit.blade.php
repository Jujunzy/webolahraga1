@extends('template')
@section('content')
<br><br><br>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-0">Edit Pelatih</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('pelatih.update', $pelatih->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="pelatih" class="form-label">Nama Pelatih</label>
                            <input type="text" id="pelatih" name="pelatih" class="form-control" value="{{ old('pelatih', $pelatih->pelatih) }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="pengalaman" class="form-label">Pengalaman</label>
                            <input type="text" id="pengalaman" name="pengalaman" class="form-control" value="{{ old('pengalaman', $pelatih->pengalaman) }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="kontak" class="form-label">Kontak</label>
                            <input type="text" id="kontak" name="kontak" class="form-control" value="{{ old('kontak', $pelatih->kontak) }}" required>
                        </div>
                        <div class="d-flex">
                            <button type="submit" class="btn btn-primary me-2">
                                <i class="fas fa-save"></i> Update
                            </button>
                            <a href="{{ route('pelatih.index') }}" class="btn btn-danger">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
