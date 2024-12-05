<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MataPelajaran;
use Flasher\Laravel\Facade\Flasher;

class MataPelajaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mapel = MataPelajaran::all();

        return view('kurikulum.mata-pelajaran.index', compact('mapel'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'nama_mapel' => 'required|string|max:255',
                'kode_mapel' => 'required|string|max:10|unique:mata_pelajarans,kode_mapel',
                'jenjang_kelas' => 'required|string|max:10',
                'jumlah_jam' => 'required|integer|min:1',
            ]);

            MataPelajaran::create($validated);
            Flasher::addSuccess('Berhasil membuat data mata pelajar.');

            return response()->json(['success' => true, 'message' => 'Data berhasil disimpan.']);
        } catch (\Exception $e) {
            \Log::error('Error saving data: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan pada server.'], 500);
        }


        return redirect()->route('data.user');
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama_mapel' => 'required|string|max:255',
            'kode_mapel' => 'required|string|max:10',
            'jenjang_kelas' => 'required|string|max:50',
            'jumlah_jam' => 'required|integer',
        ]);

        $mapel = MataPelajaran::findOrFail($id);
        $mapel->update($validated);

        Flasher::addSuccess('Berhasil membuat mengupdate mata pelajar.');

        return response()->json(['success' => true, 'message' => 'Mata Pelajaran berhasil diubah']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $mapel = MataPelajaran::find($id);


        if ($mapel) {
            $mapel->delete();
            Flasher::addSuccess('Mata pelajaran berhasil dihapus.');
            return response()->json(['success' => true]);
        } else {
            Flasher::addError('Mata pelajaran tidak ditemukan.');
            return response()->json(['success' => false]);
        }
        return redirect()->route('data.mataPelajaran');
    }
}
