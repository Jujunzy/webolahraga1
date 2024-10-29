<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Latihan;
use App\Models\Anggota;
use App\Models\Jenis;
use RealRashid\SweetAlert\Facades\Alert;

class PageLatihanController extends Controller
{
    public function index()
    {
        $data = Latihan::with('anggota', 'jenis')->get();
        return view('page/latihan/index', ['latihan' => $data]);
    }

    public function create()
    {
        $anggota = Anggota::all();
        $jenis = Jenis::all();
        return view('page.latihan.create', compact('anggota', 'jenis'));
    }

    public function store(Request $request)
    {
         // Validasi data
    $request->validate([
        'anggota_id' => 'required',
        'jenis_id' => 'required',
        'tanggal' => 'nullable|date|after_or_equal:today',
        'durasi' => 'required|string',
    ], [
        'anggota_id.required' => 'Anggota harus dipilih.',
        'jenis_id.required' => 'Jenis harus dipilih.',
        'tanggal.date' => 'Format tanggal tidak valid.',
        'tanggal.after_or_equal' => 'Tanggal tidak boleh kurang dari hari ini.',
        'durasi.required' => 'Durasi latihan harus diisi.'
    ]);

    // Set tanggal menjadi hari ini jika tidak diisi
    $data = $request->all();
    $data['tanggal'] = $data['tanggal'] ?? now()->toDateString();

    // Cek keunikan anggota_id
    $existsAnggota = Latihan::where('anggota_id', $request->anggota_id)->exists();
    if ($existsAnggota) {
        Alert::error('Gagal', 'Latihan untuk anggota ini sudah ada.');
        return redirect()->back()->withInput();
    }

    try {
        // Simpan data jika validasi lolos
        Latihan::create($data);
        Alert::success('Berhasil', 'Latihan berhasil ditambahkan!');
    } catch (\Exception $e) {
        Alert::error('Gagal', 'Terjadi kesalahan saat menambah data.');
    }

    return redirect()->route('latihan.index');
    }



    public function edit($id)
    {
        $latihan = Latihan::find($id);
        $anggota = Anggota::all();
        $jenis = Jenis::all();

        return view('page.latihan.edit', compact('latihan', 'anggota', 'jenis'));
    }

    public function update(Request $request, $id)
{
    $latihan = Latihan::findOrFail($id);

    // Validasi data
    $request->validate([
        'anggota_id' => 'required',
        'jenis_id' => 'required',
        'tanggal' => 'nullable|date|after_or_equal:today',
        'durasi' => 'required|string',
    ], [
        'anggota_id.required' => 'Anggota harus dipilih.',
        'jenis_id.required' => 'Jenis harus dipilih.',
        'tanggal.date' => 'Format tanggal tidak valid.',
        'tanggal.after_or_equal' => 'Tanggal tidak boleh kurang dari hari ini.',
        'durasi.required' => 'Durasi latihan harus diisi.'
    ]);

    // Set tanggal menjadi hari ini jika tidak diisi
    $data = $request->all();
    $data['tanggal'] = $data['tanggal'] ?? now()->toDateString();

    // Cek keunikan anggota_id, selain yang sedang diupdate
    $existsAnggota = Latihan::where('anggota_id', $request->anggota_id)
        ->where('id', '!=', $latihan->id)
        ->exists();

    if ($existsAnggota) {
        Alert::error('Gagal', 'Latihan untuk anggota ini sudah ada.');
        return redirect()->back()->withInput();
    }

    try {
        // Update data jika validasi lolos
        $latihan->update($data);
        Alert::success('Berhasil', 'Data Latihan berhasil diupdate!');
    } catch (\Exception $e) {
        Alert::error('Gagal', 'Terjadi kesalahan saat mengupdate data.');
    }

    return redirect()->route('latihan.index');
}


    public function destroy($id)
    {
        try {
            $latihan = Latihan::find($id);
            $latihan->delete();
            Alert::success('Berhasil', 'Latihan berhasil dihapus!');
        } catch (\Exception $e) {
            Alert::error('Gagal', 'Terjadi kesalahan saat menghapus data.');
        }

        return redirect()->route('latihan.index');
    }
}
