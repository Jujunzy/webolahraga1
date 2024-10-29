<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use RealRashid\SweetAlert\Facades\Alert;

class PageEventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Event::all();
        return view('page.event.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('page.event.create');
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
            'event' => 'required|unique:events,event',
            'tanggal' => 'required|date',
            'lokasi' => 'required',
            'kategori' => 'required'
        ]);

        Event::create($request->all());
        Alert::success('Berhasil', 'Event berhasil ditambahkan!');
        return redirect()->route('event.index');
    } catch (\Illuminate\Validation\ValidationException $e) {
        // Menampilkan alert jika data sudah ada
        Alert::error('Data sudah ada', 'Event dengan nama yang sama sudah ada!');
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
        $event = Event::findOrFail($id);
        return view('page.event.edit', compact('event'));
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
                'event' => 'required|unique:events,event,' . $id,
                'tanggal' => 'required|date',
                'lokasi' => 'required',
                'kategori' => 'required'
            ]);

            $event = Event::findOrFail($id);
            $event->update($request->all());
            Alert::success('Berhasil', 'Data event berhasil diupdate!');
            return redirect()->route('event.index');
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Menampilkan alert jika data sudah ada
            Alert::error('Data sudah ada', 'Event dengan nama yang sama sudah ada!');
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
            $event = Event::findOrFail($id);

            // Cek apakah event memiliki relasi dengan pemenang
            if ($event->pemenang()->exists()) {
                Alert::error('Gagal', 'Data tidak dapat dihapus karena masih digunakan.');
                return redirect()->route('event.index');
            }

            $event->delete();
            Alert::success('Berhasil', 'Event berhasil dihapus!');
        } catch (\Exception $e) {
            Alert::error('Gagal', 'Terjadi kesalahan saat menghapus event.');
        }

        return redirect()->route('event.index');
    }
}
