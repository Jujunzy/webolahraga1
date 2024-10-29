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
        try {
            $request->validate([
                'anggota' => 'required|unique:anggotas,anggota',
                'jk' => 'required',
                'usia' => 'required|numeric|min:1',
                'kontak' => 'required|numeric|min:0|unique:anggotas,kontak'
            ], [
                'anggota.unique' => 'Nama sudah ada!',
                'jk.required' => 'Jenis kelamin harus diisi.',
                'usia.min' => 'Usia tidak boleh minus.',
                'kontak.unique' => 'Kontak sudah ada!',
                'kontak.min' => 'Kontak tidak boleh minus.'
            ]);

            Anggota::create($request->all());
            Alert::success('Berhasil', 'Anggota berhasil ditambahkan!');
            return redirect()->route('anggota.index');
        } catch (ValidationException $e) {
            // Menangkap pesan error dari validasi dan menampilkan pesan yang sesuai
            $errorMessages = $e->validator->errors()->all();
            foreach ($errorMessages as $errorMessage) {
                Alert::error('Gagal', $errorMessage);
            }
            return redirect()->back()->withInput();
        } catch (Exception $e) {
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
        try {
            $request->validate([
                'anggota' => 'required|unique:anggotas,anggota,' . $id, // Mengecualikan ID saat ini
                'jk' => 'required',
                'usia' => 'required|numeric|min:1',
                'kontak' => 'required|numeric|min:1|unique:anggotas,kontak,' . $id, // Mengecualikan ID saat ini
            ], [
                'anggota.unique' => 'Nama sudah ada!',
                'jk.required' => 'Jenis kelamin harus diisi.',
                'usia.min' => 'Usia tidak boleh minus.',
                'kontak.unique' => 'Kontak sudah ada!',
                'kontak.min' => 'Kontak tidak boleh minus.'
            ]);

            $anggota = Anggota::findOrFail($id);
            $anggota->update($request->all());
            Alert::success('Berhasil', 'Data anggota berhasil diupdate!');
            return redirect()->route('anggota.index');
        } catch (ValidationException $e) {
            // Menangkap pesan error dari validasi dan menampilkan pesan yang sesuai
            $errorMessages = $e->validator->errors()->all();
            foreach ($errorMessages as $errorMessage) {
                Alert::error('Gagal', $errorMessage);
            }
            return redirect()->back()->withInput();
        } catch (Exception $e) {
            Alert::error('Gagal', 'Terjadi kesalahan saat mengupdate data.');
            return redirect()->back()->withInput();
        }
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

            // Cek apakah anggota memiliki relasi yang terkait
            if ($anggota->latihan()->exists() || $anggota->pemenang()->exists()) {
                Alert::error('Gagal', 'Data tidak dapat dihapus karena masih digunakan.');
                return redirect()->route('anggota.index');
            }

            $anggota->delete();
            Alert::success('Berhasil', 'Anggota berhasil dihapus!');
        } catch (Exception $e) {
            Alert::error('Gagal', 'Terjadi kesalahan saat menghapus data.');
        }

        return redirect()->route('anggota.index');
    }
}
