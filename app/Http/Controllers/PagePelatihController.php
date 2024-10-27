<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelatih;
use RealRashid\SweetAlert\Facades\Alert;

class PagePelatihController extends Controller
{
    public function index()
    {
        $data = Pelatih::all();
        return view('page.pelatih.index', compact('data'));
    }

    public function create()
    {
        return view('page.pelatih.create');
    }

    public function store(Request $request)
    {
        // Validasi data agar tidak ada duplikat
       try {
        // Validasi data agar tidak ada duplikat
        $request->validate([
            'pelatih' => 'required|unique:pelatihs,pelatih',
            'pengalaman' => 'required',
            'kontak' => 'required'
        ]);

        Pelatih::create($request->all());
        Alert::success('Berhasil', 'Pelatih berhasil ditambahkan!');
        return redirect()->route('pelatih.index');
    } catch (\Illuminate\Validation\ValidationException $e) {
        // Menampilkan alert jika data sudah ada
        Alert::error('Data sudah ada', 'Pelatih dengan nama yang sama sudah ada!');
        return redirect()->back()->withInput();
    } catch (\Exception $e) {
        Alert::error('Gagal', 'Terjadi kesalahan saat menambah data.');
        return redirect()->back()->withInput();
    }
    }

    public function edit($id)
    {
        $pelatih = Pelatih::findOrFail($id);
        return view('page.pelatih.edit', compact('pelatih'));
    }

    public function update(Request $request, $id)
    {
       // Validasi data agar tidak ada duplikat (selain data yang sedang di-update)
       try {
        // Validasi data agar tidak ada duplikat (selain data yang sedang di-update)
        $request->validate([
            'pelatih' => 'required|unique:pelatihs,pelatih,' . $id,
            'pengalaman' => 'required',
            'kontak' => 'required'
        ]);

        $pelatih = Pelatih::findOrFail($id);
        $pelatih->update($request->all());
        Alert::success('Berhasil', 'Data pelatih berhasil diupdate!');
        return redirect()->route('pelatih.index');
    } catch (\Illuminate\Validation\ValidationException $e) {
        // Menampilkan alert jika data sudah ada
        Alert::error('Data sudah ada', 'Pelatih dengan nama yang sama sudah ada!');
        return redirect()->back()->withInput();
    } catch (\Exception $e) {
        Alert::error('Gagal', 'Terjadi kesalahan saat mengupdate data.');
        return redirect()->back()->withInput();
    }
    }

    public function destroy($id)
    {
        try {
            $pelatih = Pelatih::findOrFail($id);
            $pelatih->delete();
            Alert::success('Berhasil', 'Pelatih berhasil dihapus!');
        } catch (\Exception $e) {
            Alert::error('Gagal', 'Terjadi kesalahan saat menghapus pelatih.');
        }

        return redirect()->route('pelatih.index');
    }
}
