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
