<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Anggota;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Validation\ValidationException;
// use Illuminate\Validation\ValidationException;

class PageAnggotaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Anggota::all();
        return view('page.anggota.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('page.anggota.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       // Validasi data agar tidak ada duplikat
       try {
        // Validasi data agar tidak ada duplikat
        $request->validate([
            'anggota' => 'required|unique:anggotas,anggota',
            'jk' => 'required',
            'usia' => 'required|integer|min:1',
            'kontak' => 'required'
        ]);

        Anggota::create($request->all());
        Alert::success('Berhasil', 'Anggota berhasil ditambahkan!');
        return redirect()->route('anggota.index');
    } catch (\Illuminate\Validation\ValidationException $e) {
        // Menampilkan alert jika data sudah ada
        Alert::error('Data sudah ada', 'Anggota dengan nama yang sama sudah ada!');
        return redirect()->back()->withInput();
    } catch (\Exception $e) {
        Alert::error('Gagal', 'Terjadi kesalahan saat menambah data.');
        return redirect()->back()->withInput();
    }
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
        $anggota = Anggota::findOrFail($id);
        return view('page.anggota.edit', compact('anggota'));
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
        // Validasi data agar tidak ada duplikat (selain data yang sedang di-update)
        try {
            // Validasi data agar tidak ada duplikat (selain data yang sedang di-update)
            $request->validate([
                'anggota' => 'required|unique:anggotas,anggota,' . $id,
                'jk' => 'required',
                'usia' => 'required|integer|min:1',
                'kontak' => 'required'
            ],[
                'usia.min' => 'usia tidak boleh minus'
            ]);

            $anggota = Anggota::findOrFail($id);
            $anggota->update($request->all());
            Alert::success('Berhasil', 'Data anggota berhasil diupdate!');
            return redirect()->route('anggota.index');
        } catch (ValidationException $e) {
            // Menampilkan alert jika data sudah ada
            Alert::error(json_encode($e->errors()));
            return redirect()->back()->withInput();
        } catch (Exception $e) {
            Alert::error('Gagal', $e ->getMessage());
            return redirect()->back()->withInput();
        };
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
            $anggota = Anggota::findOrFail($id);
            $anggota->delete();
            Alert::success('Berhasil', 'Anggota berhasil dihapus!');
        } catch (\Exception $e) {
            Alert::error('Gagal', 'Terjadi kesalahan saat menghapus data.');
        }

        return redirect()->route('anggota.index');
    }
}
