@extends('template')
@section('content')
<br><br><br>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-0">Tambah Jadwal Latihan</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('jadwal.store') }}" method="post">
                        @csrf
                        Nama Pelatih : <select name="pelatih_id" id="pelatih_id">
                            @foreach ($pelatih as $isi )
                            <option value="{{ $isi->id }}">{{ $isi->pelatih }}</option>
                            @endforeach
                        </select><br>

                        Jenis Olahraga : <select name="jenis_id" id="jenis_id">
                            @foreach ($jenis as $isi )
                            <option value="{{ $isi->id }}">{{ $isi->jenis }}</option>
                            @endforeach
                        </select><br>

                        <div class="mb-3">
                            <label for="tanggal" class="form-label">Tanggal</label>
                            <input type="date" id="tanggal" name="tanggal" class="form-control" required>
                        </div>
                        <div class="d-flex">
                            <button type="submit" class="btn btn-primary me-2">
                                <i class="fas fa-save"></i> Simpan
                            </button>
                            <a href="{{ route('jadwal.index') }}" class="btn btn-danger">
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
