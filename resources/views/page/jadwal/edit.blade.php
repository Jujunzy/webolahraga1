@extends('template')
@section('content')
<br><br><br>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-0">Edit Jadwal Latihan</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('jadwal.update', $jadwal->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="pelatih_id" class="form-label">Nama Pelatih</label>
                            <select name="pelatih_id" id="pelatih_id" class="form-control">
                                @foreach ($pelatih as $isi)
                                <option value="{{ $isi->id }}" {{ $isi->id == $jadwal->pelatih_id ? 'selected' : '' }}>
                                    {{ $isi->pelatih }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="jenis_id" class="form-label">Jenis Olahraga</label>
                            <select name="jenis_id" id="jenis_id" class="form-control">
                                @foreach ($jenis as $isi)
                                <option value="{{ $isi->id }}" {{ $isi->id == $jadwal->jenis_id ? 'selected' : '' }}>
                                    {{ $isi->jenis }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="tanggal" class="form-label">Tanggal</label>
                            <input type="date" id="tanggal" name="tanggal" class="form-control" value="{{ old('tanggal', now()->toDateString()) }}" required>
                        </div>

                        <div class="d-flex">
                            <button type="submit" class="btn btn-primary me-2">
                                <i class="fas fa-save"></i> Update
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
<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        const tanggalInput = document.getElementById('tanggal');

        // Jika value kosong, set nilai menjadi hari ini
        if (!tanggalInput.value) {
            const today = new Date().toISOString().split("T")[0];
            tanggalInput.value = today;
        }
    });
</script>
@endsection
