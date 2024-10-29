<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelatih;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Validation\ValidationException;

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
        try {
            // Validasi agar nama dan kontak tidak duplikat serta kontak tidak boleh negatif
            $request->validate([
                'pelatih' => 'required|unique:pelatihs,pelatih',
                'pengalaman' => 'required',
                'kontak' => 'required|numeric|min:1|unique:pelatihs,kontak',
            ], [
                'pelatih.unique' => 'Nama pelatih sudah ada!',
                'kontak.unique' => 'Kontak sudah ada!',
                'kontak.min' => 'Kontak tidak boleh minus.',
            ]);

            Pelatih::create($request->all());
            Alert::success('Berhasil', 'Pelatih berhasil ditambahkan!');
            return redirect()->route('pelatih.index');
        } catch (ValidationException $e) {
            foreach ($e->validator->errors()->all() as $error) {
                Alert::error('Gagal', $error);
            }
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
        try {
            // Validasi agar nama dan kontak tidak duplikat (kecuali pada data yang sedang di-update) serta kontak tidak boleh negatif
            $request->validate([
                'pelatih' => 'required|unique:pelatihs,pelatih,' . $id,
                'pengalaman' => 'required',
                'kontak' => 'required|numeric|min:1|unique:pelatihs,kontak,' . $id,
            ], [
                'pelatih.unique' => 'Nama pelatih sudah ada!',
                'kontak.unique' => 'Kontak sudah ada!',
                'kontak.min' => 'Kontak tidak boleh minus.',
            ]);

            $pelatih = Pelatih::findOrFail($id);
            $pelatih->update($request->all());
            Alert::success('Berhasil', 'Data pelatih berhasil diupdate!');
            return redirect()->route('pelatih.index');
        } catch (ValidationException $e) {
            foreach ($e->validator->errors()->all() as $error) {
                Alert::error('Gagal', $error);
            }
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

            // Cek apakah pelatih memiliki relasi dengan jadwal
            if ($pelatih->jadwal()->exists()) {
                Alert::error('Gagal', 'Data tidak dapat dihapus karena masih digunakan.');
                return redirect()->route('pelatih.index');
            }

            $pelatih->delete();
            Alert::success('Berhasil', 'Pelatih berhasil dihapus!');
        } catch (\Exception $e) {
            Alert::error('Gagal', 'Terjadi kesalahan saat menghapus pelatih.');
        }

        return redirect()->route('pelatih.index');
    }
}
