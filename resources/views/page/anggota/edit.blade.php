@extends('template')
@section('content')
<br><br><br>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-0">Edit Anggota</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('anggota.update', $anggota->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="anggota" class="form-label">Nama Anggota</label>
                            <input type="text" id="anggota" name="anggota" class="form-control" value="{{ old('anggota', $anggota->anggota) }}" required>
                        </div>
                        <div class="mb-3">
                            <label>
                                <input type="radio" name="jk" value="Laki-laki" {{ old('jk', $anggota->jk) == 'Laki-laki' ? 'checked' : '' }}> Laki-laki
                            </label>
                            <label>
                                <input type="radio" name="jk" value="Perempuan" {{ old('jk', $anggota->jk) == 'Perempuan' ? 'checked' : '' }}> Perempuan
                            </label>
                        </div>
                        <div class="mb-3">
                            <label for="usia" class="form-label">Usia</label>
                            <input type="text" id="usia" name="usia" class="form-control" value="{{ old('usia', $anggota->usia) }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="kontak" class="form-label">Kontak</label>
                            <input type="text" id="kontak" name="kontak" class="form-control" value="{{ old('kontak', $anggota->kontak) }}" required>
                        </div>
                        <div class="d-flex">
                            <button type="submit" class="btn btn-primary me-2">
                                <i class="fas fa-save"></i> Update
                            </button>
                            <a href="{{ route('anggota.index') }}" class="btn btn-danger">
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
