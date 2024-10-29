<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jenis;
use RealRashid\SweetAlert\Facades\Alert;

class PageJenisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Jenis::all();
        return view('page.jenisolahraga.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('page.jenisolahraga.create');

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
                'jenis' => 'required|unique:jenis,jenis',
                'deskripsi' => 'required',
                'gambar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048' // Validasi gambar
            ]);

            // Upload gambar
            $fileName = null;
            if ($request->hasFile('gambar')) {
                $fileName = time() . '.' . $request->gambar->extension();
                $request->gambar->move(public_path('images'), $fileName);
            }

            // Simpan data ke database
            Jenis::create([
                'jenis' => $request->jenis,
                'deskripsi' => $request->deskripsi,
                'gambar' => $fileName // Simpan nama file gambar
            ]);

            Alert::success('Berhasil', 'Jenis Olahraga berhasil ditambahkan!');
            return redirect()->route('jenisolahraga.index');
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Menampilkan alert jika data sudah ada
            Alert::error('Data sudah ada', 'Jenis Olahraga dengan nama yang sama sudah ada!');
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
        $jenis = Jenis::findOrFail($id);
        return view('page.jenisolahraga.edit', compact('jenis'));
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
                'jenis' => 'required|unique:jenis,jenis,' . $id,
                'deskripsi' => 'required',
                'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048' // Validasi gambar jika diunggah
            ]);

            $jenis = Jenis::findOrFail($id);

            // Upload gambar jika ada file baru
            if ($request->hasFile('gambar')) {
                $fileName = time() . '.' . $request->gambar->extension();
                $request->gambar->move(public_path('images'), $fileName);

                // Hapus gambar lama jika ada
                if ($jenis->gambar && file_exists(public_path('images/' . $jenis->gambar))) {
                    unlink(public_path('images/' . $jenis->gambar));
                }

                $jenis->gambar = $fileName; // Simpan nama file gambar baru
            }

            // Update data di database
            $jenis->update([
                'jenis' => $request->jenis,
                'deskripsi' => $request->deskripsi,
                'gambar' => $jenis->gambar // Tetap simpan gambar jika tidak diubah
            ]);

            Alert::success('Berhasil', 'Data jenis berhasil diupdate!');
            return redirect()->route('jenisolahraga.index');
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Menampilkan alert jika data sudah ada
            Alert::error('Data sudah ada', 'Jenis dengan nama yang sama sudah ada!');
            return redirect()->back()->withInput();
        } catch (\Exception $e) {
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
            $jenis = Jenis::findOrFail($id);

            // Cek apakah jenis memiliki relasi yang terkait
            if ($jenis->latihan()->exists() || $jenis->jadwal()->exists()) {
                Alert::error('Gagal', 'Data tidak dapat dihapus karena masih digunakan.');
                return redirect()->route('jenisolahraga.index');
            }

            // Hapus gambar jika ada
            if ($jenis->gambar && file_exists(public_path('images/' . $jenis->gambar))) {
                unlink(public_path('images/' . $jenis->gambar));
            }

            $jenis->delete();
            Alert::success('Berhasil', 'Jenis berhasil dihapus!');
        } catch (\Exception $e) {
            Alert::error('Gagal', 'Terjadi kesalahan saat menghapus data.');
        }

        return redirect()->route('jenisolahraga.index');
    }
}
