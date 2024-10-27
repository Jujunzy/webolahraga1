@extends('template')
@section('content')
<br><br><br>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-0">Tambah Latihan</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('latihan.store') }}" method="post">
                        @csrf
                        Nama Anggota : <select name="anggota_id" id="anggota_id">
                            @foreach ($anggota as $isi )
                            <option value="{{ $isi->id }}">{{ $isi->anggota }}</option>
                            @endforeach
                        </select><br>

                        Nama Olahraga : <select name="jenis_id" id="jenis_id">
                            @foreach ($jenis as $isi )
                            <option value="{{ $isi->id }}">{{ $isi->jenis }}</option>
                            @endforeach
                        </select><br>

                        <div class="mb-3">
                            <label for="tanggal" class="form-label">Tanggal</label>
                            <input type="date" id="tanggal" name="tanggal" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="durasi" class="form-label">Durasi</label>
                            <input type="text" id="durasi" name="durasi" class="form-control" required>
                        </div>
                        <div class="d-flex">
                            <button type="submit" class="btn btn-primary me-2">
                                <i class="fas fa-save"></i> Simpan
                            </button>
                            <a href="{{ route('latihan.index') }}" class="btn btn-danger">
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
