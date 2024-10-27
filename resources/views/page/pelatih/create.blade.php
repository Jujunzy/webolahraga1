@extends('template')
@section('content')
    <br><br><br>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="mb-0">Tambah Pelatih</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('pelatih.store') }}" method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="pelatih" class="form-label">Nama Pelatih</label>
                                <input type="text" id="pelatih" name="pelatih" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="pengalaman" class="form-label">Pengalaman</label>
                                <input type="text" id="pengalaman" name="pengalaman" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="kontak" class="form-label">Kontak</label>
                                <input type="text" id="kontak" name="kontak" class="form-control" required>
                            </div>
                            @error('kontak')
                                <small style="color: red">{{ $message }}</small>
                            @enderror
                            <div class="d-flex">
                                <button type="submit" class="btn btn-primary me-2">
                                    <i class="fas fa-save"></i> Simpan
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
