@extends('template')
@section('content')
<br><br><br>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-0">Edit Latihan</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('latihan.update', $latihan->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        <!-- Dropdown Nama Anggota dengan Select2 -->
                        <div class="mb-3">
                            <label for="anggota_id" class="form-label">Nama Anggota</label>
                            <select name="anggota_id" id="anggota_id" class="form-control select2">
                                @foreach ($anggota as $isi)
                                    <option value="{{ $isi->id }}" {{ $isi->id == $latihan->anggota_id ? 'selected' : '' }}>{{ $isi->anggota }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Dropdown Nama Olahraga dengan Select2 -->
                        <div class="mb-3">
                            <label for="jenis_id" class="form-label">Nama Olahraga</label>
                            <select name="jenis_id" id="jenis_id" class="form-control select2">
                                @foreach ($jenis as $isi)
                                    <option value="{{ $isi->id }}" {{ $isi->id == $latihan->jenis_id ? 'selected' : '' }}>{{ $isi->jenis }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="tanggal" class="form-label">Tanggal</label>
                            <input type="date" id="tanggal" name="tanggal" class="form-control" value="{{ old('tanggal', now()->toDateString()) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="durasi" class="form-label">Durasi</label>
                            <input type="text" id="durasi" name="durasi" class="form-control" value="{{ old('durasi', $latihan->durasi) }}" required>
                        </div>
                        <div class="d-flex">
                            <button type="submit" class="btn btn-primary me-2">
                                <i class="fas fa-save"></i> Update
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
