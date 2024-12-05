<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\User;
use Illuminate\Http\Request;
use Flasher\Laravel\Facade\Flasher;

class GuruController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $guru = Guru::all();

        return view('admin.data-guru.index', compact('guru'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.data-guru.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'nip' => 'required|string|max:100',
            'email' => 'required|string|max:100',
            'tempat_lahir' => 'nullable|string|max:100',
            'tanggal_lahir' => 'nullable|date',
            'agama' => 'nullable|string|max:50',
            'jenis_kelamin' => 'nullable|in:laki-laki,perempuan',
            'alamat' => 'nullable|string|max:500',
            'gelar_akademik' => 'nullable|string|max:100',
            'jurusan_akademik' => 'nullable|string|max:100',
            'universitas' => 'nullable|string|max:100',
        ]);


        // periksa apakah email terdaftar di tabel `users`
        $userExists = User::where('email', $request->input('email'))->exists();
        if (!$userExists) {
            return redirect()->back()->with('error', 'Email tidak terdaftar. Harap memiliki akun terlebih dahulu.');
        }

        Guru::create([
            'name' => $request->input('name'),
            'nip' => $request->input('nip'),
            'tempat_lahir' => $request->input('tempat_lahir'),
            'tanggal_lahir' => $request->input('tanggal_lahir'),
            'agama' => $request->input('agama'),
            'jenis_kelamin' => $request->input('jenis_kelamin'),
            'alamat' => $request->input('alamat'),
            'gelar_akademik' => $request->input('gelar_akademik'),
            'jurusan_akademik' => $request->input('jurusan_akademik'),
            'universitas' => $request->input('universitas'),
        ]);

        Flasher::addSuccess('Berhasil menambahkan data.');

        return redirect()->route('data.guru.index');
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
    public function edit($id)
    {
        $guru = Guru::findOrFail($id);

        return view('admin.data-guru.edit', compact('guru'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'nip' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email,' . $id,
            'tempat_lahir' => 'nullable|string|max:100',
            'tanggal_lahir' => 'nullable|date',
            'agama' => 'nullable|string|max:50',
            'jenis_kelamin' => 'nullable|in:laki-laki,perempuan',
            'alamat' => 'nullable|string|max:500',
            'gelar_akademik' => 'nullable|string|max:100',
            'jurusan_akademik' => 'nullable|string|max:100',
            'universitas' => 'nullable|string|max:100',
        ]);

        // dd($request->all());

        $guru = Guru::findOrFail($id);

        $guru->name = $request->input('name');
        $guru->nip = $request->input('nip');
        $guru->email = $request->input('email');
        $guru->tempat_lahir = $request->input('tempat_lahir');
        $guru->tanggal_lahir = $request->input('tanggal_lahir');
        $guru->agama = $request->input('agama');
        $guru->jenis_kelamin = $request->input('jenis_kelamin');
        $guru->alamat = $request->input('alamat');
        $guru->gelar_akademik = $request->input('gelar_akademik');
        $guru->jurusan_akademik = $request->input('jurusan_akademik');
        $guru->universitas = $request->input('universitas');

        $guru->save();

        $user = User::find($guru->id_user);
        if ($user) {
            $user->email = $guru->email;
            $user->save();
        }

        Flasher::addSuccess('Berhasil mengupdate data.');

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
