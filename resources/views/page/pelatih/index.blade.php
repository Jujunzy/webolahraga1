@extends('template')
@section('content')
<br><br><br>
<style>
/* Gaya Container dan Card */
.container {
    max-width: 900px;
    margin-top: 20px;
}

.card {
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}

.card-header {
    background-color: #007bff;
    color: rgb(0, 0, 0);
    border-top-left-radius: 10px;
    border-top-right-radius: 10px;
    padding: 15px;
    text-align: center;
}

.card-header h2 {
    font-size: 1.5rem;
    margin: 0;
}

/* Tombol Tambah Data */
.btn-primary {
    background-color: #007bff;
    border-color: #007bff;
    transition: transform 0.3s ease;
}

.btn-primary:hover {
    background-color: #0056b3;
    transform: scale(1.05);
}

/* Input Pencarian */
#searchInput {
    border-radius: 5px;
    border: 1px solid #ced4da;
    padding: 10px;
    transition: box-shadow 0.3s ease;
}

#searchInput:focus {
    outline: none;
    box-shadow: 0 0 8px rgba(0, 123, 255, 0.6);
}

/* Table Styles */
.table-responsive {
    border-radius: 5px;
    overflow: hidden;
}

.table {
    border-radius: 5px;
    overflow: hidden;
}

.table thead {
    background-color: #007bff;
    color: white;
}

.table thead th {
    text-align: center;
}

.table tbody tr {
    transition: background-color 0.2s;
}

.table tbody tr:hover {
    background-color: #f1f1f1;
}

/* Ikon Aksi (Edit dan Delete) */
.table tbody tr td a, .table tbody tr td button {
    color: #007bff;
    transition: transform 0.3s ease;
}

.table tbody tr td a:hover, .table tbody tr td button:hover {
    color: #0056b3;
    transform: scale(1.1);
}

/* Animasi Pencarian */
@keyframes searchHighlight {
    0% {
        background-color: #fff59d;
    }
    100% {
        background-color: transparent;
    }
}

/* Animasi pada Baris Tabel saat Pencarian */
.table tbody tr[style*="display: block;"] {
    animation: searchHighlight 0.5s ease-in-out;
}
</style>
<div class="container">
    <div class="card">
        <div class="card-header">
            <h2 class="mb-0">Data Pelatih</h2>
        </div>
        <div class="card-body">
            <!-- Tombol tambah data -->
            <a href="{{ route('pelatih.create') }}" class="btn btn-primary mb-3">
                <i class="fa fa-plus"></i> Tambah Data
            </a>
            <!-- Input pencarian -->
            <input type="text" id="searchInput" class="form-control mb-3" placeholder="Cari pelatih..." onkeyup="searchTable()">
            <!-- Table -->
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Pelatih</th>
                            <th>Pengalaman</th>
                            <th>Kontak</th>
                            <th colspan="2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $no = 1 @endphp
                        @foreach ($data as $isi )
                        <tr>
                            <td>{{$no++}}</td>
                            <td>{{$isi->pelatih}}</td>
                            <td>{{$isi->pengalaman}}</td>
                            <td>{{$isi->kontak}}</td>
                            <td>
                                <a href="{{ route('pelatih.edit', $isi->id) }}"><i class="fas fa-edit"></i></a> <!-- Edit -->
                                <form action="{{ route('pelatih.destroy', $isi->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" style="background: none; border: none; color: red; cursor: pointer;">
                                    <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript untuk pencarian tabel -->
<script>
    function searchTable() {
        // Ambil input pencarian
        var input = document.getElementById('searchInput');
        var filter = input.value.toLowerCase();
        var table = document.getElementById('dataTables-example');
        var tr = table.getElementsByTagName('tr');

        // Looping melalui semua baris tabel, dan sembunyikan yang tidak sesuai pencarian
        for (var i = 1; i < tr.length; i++) {
            var tdList = tr[i].getElementsByTagName('td');
            var match = false;

            // Cek setiap kolom dalam baris
            for (var j = 0; j < tdList.length; j++) {
                if (tdList[j]) {
                    if (tdList[j].innerHTML.toLowerCase().indexOf(filter) > -1) {
                        match = true;
                        break;
                    }
                }
            }

            // Tampilkan atau sembunyikan baris berdasarkan hasil pencarian
            tr[i].style.display = match ? '' : 'none';
        }
    }
</script>
@endsection
