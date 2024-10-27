<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemenang;
use App\Models\Event;
use App\Models\Anggota;
use RealRashid\SweetAlert\Facades\Alert;

class PagePemenangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Pemenang::with('event','anggota')->get();
        return view('page/pemenang/index', ['pemenang'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $event = Event::all();
        $anggota = Anggota::all();
        return view('page.pemenang.create', compact('event','anggota'));
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
        'anggota_id' => 'required',
        'event_id' => 'required',
        'posisi' => 'required|string',
    ], [
        'anggota_id.required' => 'anggota harus dipilih.',
        'event_id.required' => 'event harus dipilih.',
        'posisi.required' => 'posisi harus diisi.'
    ]);

    // Cek keunikan anggota_id yang tidak boleh sama yaitu anggotanya.
    $existsAnggota = Pemenang::where('anggota_id', $request->anggota_id)
        ->exists();

    if ($existsAnggota) {
        Alert::error('Gagal', 'Pemenang untuk anggota ini sudah ada.');
        return redirect()->back()->withInput();
    }

    try {
        // Simpan data jika validasi lolos
        Pemenang::create($request->all());
        Alert::success('Berhasil', 'Pemenang berhasil ditambahkan!');
    } catch (\Exception $e) {
        Alert::error('Gagal', 'Terjadi kesalahan saat menambah data.');
    }

    return redirect()->route('pemenang.index');

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
        $pemenang =Pemenang::find($id);
        $event= Event::all();
        $anggota = Anggota::all();


        return view('page.pemenang.edit', compact('pemenang','event','anggota'));
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
        $pemenang = Pemenang::find($id);

    // Validasi data
    $request->validate([
        'anggota_id' => 'required',
        'event_id' => 'required',
        'posisi' => 'required|string',
    ], [
        'anggota_id.required' => 'anggota harus dipilih.',
        'event_id.required' => 'event harus dipilih.',
        'posisi.required' => 'posisi harus diisi.'
    ]);

    // Cek keunikan anggota_id, selain yang sedang diupdate
    $existsAnggota = Pemenang::where('anggota_id', $request->anggota_id)
        ->where('id', '!=', $pemenang->id)
        ->exists();

    if ($existsAnggota) {
        Alert::error('Gagal', 'Pemenang untuk anggota ini sudah ada.');
        return redirect()->back()->withInput();
    }

    // // Cek keunikan event_id, selain yang sedang diupdate
    // $existsEvent = Pemenang::where('event_id', $request->event_id)
    //     ->where('id', '!=', $pemenang->id)
    //     ->exists();

    // if ($existsEvent) {
    //     Alert::error('Gagal', 'Pemenang dengan event ini sudah ada.');
    //     return redirect()->back()->withInput();
    // }

    try {
        // Update data jika validasi lolos
        $pemenang->update($request->all());
        Alert::success('Berhasil', 'Data Pemenang berhasil diupdate!');
    } catch (\Exception $e) {
        Alert::error('Gagal', 'Terjadi kesalahan saat mengupdate data.');
    }

    return redirect()->route('pemenang.index');

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
            $pemenang = Pemenang::find($id);
            $pemenang->delete();
            Alert::success('Berhasil', 'Pemenang berhasil dihapus!');
        } catch (\Exception $e) {
            Alert::error('Gagal', 'Terjadi kesalahan saat menghapus pemenang.');
        }
        return redirect()->route('pemenang.index');
    }
}
