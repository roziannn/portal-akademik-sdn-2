<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\User;
use Illuminate\Http\Request;
use Flasher\Laravel\Facade\Flasher;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::all();
        return view('admin.user-manager.index', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'role' => 'required|string',
            'guru_access' => 'nullable',
        ]);

        $user = new User;
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->role = $validated['role'];
        $user->password = bcrypt($validated['password']);
        $user->save();

        if ($user->role === 'guru') {
            $guru = new Guru;
            $guru->id_user = $user->id;
            $guru->name = $validated['name'];
            $guru->email = $validated['email'];
            $guru->created_by = auth()->user()->name;
            $guru->wali_kelas = ($validated['guru_access'] === 'wali_kelas') ? true : false;
            $guru->save();
        }


        Flasher::addSuccess('Berhasil membuat akun user.');

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
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('data.user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|string|min:6',
            'role' => 'required|string',
            'guru_access' => 'nullable',
        ]);

        $user = User::findOrFail($id);
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->role = $validated['role'];

        if (!empty($validated['password'])) {
            $user->password = bcrypt($validated['password']);
        }

        $user->save();

        if ($user->role === 'guru') {
            $guru = Guru::where('id_user', $user->id)->first();

            if (!$guru) {
                $guru = new Guru;
                $guru->id_user = $user->id;
            }

            $guru->name = $validated['name'];
            $guru->email = $validated['email'];
            $guru->created_by = auth()->user()->name;
            $guru->wali_kelas = ($validated['guru_access'] === 'wali_kelas') ? true : false;
            $guru->save();
        } else {
            Guru::where('id_user', $user->id)->delete();
        }

        Flasher::addSuccess('Berhasil memperbarui data user.');

        return redirect()->route('data.user');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = User::find($id);


        if ($user) {
            $user->delete();
            Flasher::addSuccess('User berhasil dihapus.');
            return response()->json(['success' => true]);
        } else {
            Flasher::addError('User tidak ditemukan.');
            return response()->json(['success' => false]);
        }
        return redirect()->route('data.user');
    }
}
