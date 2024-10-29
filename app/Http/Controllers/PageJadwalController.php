<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jadwal;
use App\Models\Pelatih;
use App\Models\Jenis;
use RealRashid\SweetAlert\Facades\Alert;

class PageJadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Jadwal::with('pelatih', 'jenis')->get();
        return view('page/jadwal/index', ['jadwal' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pelatih = Pelatih::all();
        $jenis = Jenis::all();
        return view('page.jadwal.create', compact('pelatih', 'jenis'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validasi data
        $request->validate([
            'pelatih_id' => 'required',
            'jenis_id' => 'required',
            'tanggal' => 'required|date',
        ], [
            'pelatih_id.required' => 'pelatih harus dipilih.',
            'jenis_id.required' => 'jenis harus dipilih.',
            'tanggal.required' => 'tanggal harus diisi.'
        ]);

        // Cek keunikan pelatih_id yang tidak boleh sama yaitu pelatihnya.
        $existsPelatih = Jadwal::where('pelatih_id', $request->pelatih_id)
            ->exists();

        if ($existsPelatih) {
            Alert::error('Gagal', 'Jadwal untuk pelatih ini sudah ada.');
            return redirect()->back()->withInput();
        }

        try {
            // Simpan data jika validasi lolos
            Jadwal::create($request->all());
            Alert::success('Berhasil', 'Jadwal berhasil ditambahkan!');
        } catch (\Exception $e) {
            Alert::error('Gagal', 'Terjadi kesalahan saat menambah data.');
        }

        return redirect()->route('jadwal.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $jadwal = Jadwal::find($id);
        $pelatih = Pelatih::all();
        $jenis = Jenis::all();

        return view('page.jadwal.edit', compact('jadwal', 'pelatih', 'jenis'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $jadwal = Jadwal::find($id);

        // Validasi data
        $request->validate([
            'pelatih_id' => 'required',
            'jenis_id' => 'required',
            'tanggal' => 'required|date',
        ], [
            'pelatih_id.required' => 'pelatih harus dipilih.',
            'jenis_id.required' => 'jenis harus dipilih.',
            'tanggal.required' => 'tanggal harus diisi.'
        ]);

        // Cek keunikan pelatih_id, selain yang sedang diupdate
        $existsPelatih = Jadwal::where('pelatih_id', $request->pelatih_id)
            ->where('id', '!=', $jadwal->id)
            ->exists();

        if ($existsPelatih) {
            Alert::error('Gagal', 'Jadwal untuk pelatih ini sudah ada.');
            return redirect()->back()->withInput();
        }

        // // Cek keunikan jenis_id, selain yang sedang diupdate
        // $existsEvent = Jadwal::where('jenis_id', $request->jenis_id)
        //     ->where('id', '!=', $jadwal->id)
        //     ->exists();

        // if ($existsEvent) {
        //     Alert::error('Gagal', 'Jadwal dengan jenis ini sudah ada.');
        //     return redirect()->back()->withInput();
        // }

        try {
            // Update data jika validasi lolos
            $jadwal->update($request->all());
            Alert::success('Berhasil', 'Data Jadwal berhasil diupdate!');
        } catch (\Exception $e) {
            Alert::error('Gagal', 'Terjadi kesalahan saat mengupdate data.');
        }

        return redirect()->route('jadwal.index');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $jadwal = Jadwal::find($id);
            $jadwal->delete();
            Alert::success('Berhasil', 'Jadwal berhasil dihapus!');
        } catch (\Exception $e) {
            Alert::error('Gagal', 'Terjadi kesalahan saat menghapus data.');
        }

        return redirect()->route('jadwal.index');
    }
}
