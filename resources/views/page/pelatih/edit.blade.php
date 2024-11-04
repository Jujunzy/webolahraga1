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
                    <h3 class="mb-0">Edit Pelatih</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('pelatih.update', $pelatih->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="pelatih" class="form-label">Nama Pelatih</label>
                            <input type="text" id="pelatih" name="pelatih" class="form-control" value="{{ old('pelatih', $pelatih->pelatih) }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="pengalaman" class="form-label">Pengalaman</label>
                            <input type="text" id="pengalaman" name="pengalaman" class="form-control" value="{{ old('pengalaman', $pelatih->pengalaman) }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="kontak" class="form-label">Kontak</label>
                            <input type="text" id="kontak" name="kontak" class="form-control" value="{{ old('kontak', $pelatih->kontak) }}" required>
                        </div>
                        <div class="d-flex">
                            <button type="submit" class="btn btn-primary me-2">
                                <i class="fas fa-save"></i> Update
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
