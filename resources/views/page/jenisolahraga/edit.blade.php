@extends('template')
@section('content')
<br><br><br>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-0">Edit Jenis Olahraga</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('jenisolahraga.update', $jenis->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="jenis" class="form-label">Nama Olahraga</label>
                            <input type="text" id="jenis" name="jenis" class="form-control" value="{{ old('jenis', $jenis->jenis) }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <input type="text" id="deskripsi" name="deskripsi" class="form-control" value="{{ old('deskripsi', $jenis->deskripsi) }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="gambar" class="form-label">Gambar</label>
                            <input type="file" id="gambar" name="gambar" class="form-control">
                            @if($jenis->gambar)
                                <div class="mt-2">
                                    <p>Gambar saat ini:</p>
                                    <img src="{{ asset('images/' . $jenis->gambar) }}" alt="Gambar" width="150">
                                </div>
                            @endif
                        </div>
                        <div class="d-flex">
                            <button type="submit" class="btn btn-primary me-2">
                                <i class="fas fa-save"></i> Update
                            </button>
                            <a href="{{ route('jenisolahraga.index') }}" class="btn btn-danger">
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
