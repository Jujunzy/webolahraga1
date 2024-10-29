@extends('template')
@section('content')
{{-- <style>
    /* Tambahkan margin untuk seluruh card */
    .card {
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
    }

    /* Header card */
    .card-header {
        background-color: #007bff;
        color: rgb(0, 0, 0);
        text-align: center;
        padding: 1rem;
        border-top-left-radius: 8px;
        border-top-right-radius: 8px;
    }

    /* Container form */
    .form-control, select {
        border-radius: 5px;
        padding: 0.6rem;
        border: 1px solid #ced4da;
        font-size: 1rem;
    }

    /* Tambahkan ruang antara label dan input */
    label.form-label {
        font-weight: bold;
        margin-top: 10px;
        margin-bottom: 5px;
    }

    /* Tombol simpan dan kembali */
    .btn-primary, .btn-danger {
        font-weight: bold;
        padding: 0.5rem 1rem;
        border-radius: 5px;
        display: inline-flex;
        align-items: center;
    }

    .btn-primary i, .btn-danger i {
        margin-right: 5px;
    }

    /* Spacing dan styling */
    .mb-0 {
        margin-bottom: 0 !important;
    }

    .mb-3 {
        margin-bottom: 1rem;
    }

    /* Margins */
    .d-flex {
        gap: 1rem;
    }
</style> --}}

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
                        <div class="mb-3">
                            <label for="anggota_id" class="form-label">Nama Anggota</label>
                            <select name="anggota_id" id="anggota_id" class="form-control">
                                @foreach ($anggota as $isi )
                                <option class="dropdown" value="{{ $isi->id }}">{{ $isi->anggota }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="jenis_id" class="form-label">Nama Olahraga</label>
                            <select name="jenis_id" id="jenis_id" class="form-control">
                                @foreach ($jenis as $isi )
                                <option value="{{ $isi->id }}">{{ $isi->jenis }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="tanggal" class="form-label">Tanggal</label>
                            <input type="date" id="tanggal" name="tanggal" class="form-control" value="{{ old('tanggal', now()->toDateString()) }}" required>
                        </div>


                        <div class="mb-3">
                            <label for="durasi" class="form-label">Durasi</label>
                            <input type="text" id="durasi" name="durasi" class="form-control" required>
                        </div>
                        <div class="d-flex">
                            <button type="submit" class="btn btn-primary">
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

{{-- <script>
    // Mendapatkan elemen input tanggal
    const tanggal = document.getElementById('tanggal');

    // Mengatur nilai minimum tanggal menjadi hari ini
    const today = new Date().toISOString().split("T")[0];
    tanggal.setAttribute('min', today);
</script> --}}

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
