@extends('template')
@section('content')
<br><br><br>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-0">Edit Pemenang Event</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('pemenang.update', $pemenang->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="event_id" class="form-label">Nama Event</label>
                            <select name="event_id" id="event_id" class="form-control">
                                @foreach ($event as $isi)
                                <option value="{{ $isi->id }}" {{ $isi->id == $pemenang->event_id ? 'selected' : '' }}>
                                    {{ $isi->event }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="anggota_id" class="form-label">Nama Anggota</label>
                            <select name="anggota_id" id="anggota_id" class="form-control">
                                @foreach ($anggota as $isi)
                                <option value="{{ $isi->id }}" {{ $isi->id == $pemenang->anggota_id ? 'selected' : '' }}>
                                    {{ $isi->anggota }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="posisi" class="form-label">Posisi</label>
                            <input type="text" id="posisi" name="posisi" class="form-control" value="{{ old('posisi', $pemenang->posisi) }}" required>
                        </div>
                        <div class="d-flex">
                            <button type="submit" class="btn btn-primary me-2">
                                <i class="fas fa-save"></i> Update
                            </button>
                            <a href="{{ route('pemenang.index') }}" class="btn btn-danger">
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
