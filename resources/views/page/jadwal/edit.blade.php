@extends('template')
@section('content')
<br><br><br>
<style>
/* Gaya Container dan Card */
.container {
    max-width: 700px;
    margin-top: 20px;
}

.card {
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    overflow: hidden;
}

.card-header {
    background-color: #007bff;
    color: rgb(0, 0, 0);
    text-align: center;
    padding: 15px;
}

.card-header h3 {
    font-size: 1.5rem;
    margin: 0;
}

/* Form Label dan Input */
.form-label {
    font-weight: bold;
    color: #333;
}

.form-control {
    border-radius: 5px;
    border: 1px solid #ced4da;
    padding: 10px;
    transition: box-shadow 0.3s ease;
}

.form-control:focus {
    box-shadow: 0 0 8px rgba(0, 123, 255, 0.6);
    outline: none;
}

/* Tombol */
.btn-primary, .btn-danger {
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.btn-primary {
    background-color: #007bff;
    border-color: #007bff;
}

.btn-primary:hover {
    background-color: #0056b3;
    transform: scale(1.05);
    box-shadow: 0 4px 8px rgba(0, 0, 255, 0.2);
}

.btn-danger {
    background-color: #dc3545;
    border-color: #dc3545;
}

.btn-danger:hover {
    background-color: #c82333;
    transform: scale(1.05);
    box-shadow: 0 4px 8px rgba(255, 0, 0, 0.2);
}

/* Layout D-flex Button */
.d-flex {
    gap: 10px;
}

/* Animasi Hover Input */
.form-control:hover {
    background-color: #f8f9fa;
}

/* Animasi untuk Tombol Save */
@keyframes buttonHover {
    0% { transform: scale(1); }
    50% { transform: scale(1.05); }
    100% { transform: scale(1); }
}

.btn-primary:hover, .btn-danger:hover {
    animation: buttonHover 0.3s ease-in-out;
}
</style>

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
