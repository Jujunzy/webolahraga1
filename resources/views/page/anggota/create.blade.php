@extends('template')
@section('content')
<br><br><br>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-0">Tambah Anggota</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('anggota.store') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="anggota" class="form-label">Nama Anggota</label>
                            <input type="text" id="anggota" value="{{ old('anggota') }}"  name="anggota" class="form-control"  required>
                        </div>
                        <div class="mb-3">
                            <label>
                                <input type="radio" name="jk" value="Laki-laki" {{ old('jk') == 'Laki-laki' ? 'checked' : '' }}> Laki-laki
                            </label>
                            <label>
                                <input type="radio" name="jk" value="Perempuan" {{ old('jk') == 'Perempuan' ? 'checked' : '' }}> Perempuan
                            </label>
                        </div>

                        <div class="mb-3">
                            <label for="usia" class="form-label">Usia</label>
                            <input type="text" id="usia" value="{{old( 'usia' )}}" name="usia" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="kontak" class="form-label">Kontak</label>
                            <input type="text" id="kontak" value="{{ old('kontak') }}" name="kontak" class="form-control" required>
                        </div>
                        <div class="d-flex">
                            <button type="submit" class="btn btn-primary me-2">
                                <i class="fas fa-save"></i> Simpan
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
