<?php

namespace App\Http\Controllers\Sys;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('sys.users.index', compact('users'));
    }

/* ------------------------------------------------------------------------------------------------------------- */

    public function create()
    {
        return view('sys.users.create');
    }

/* ------------------------------------------------------------------------------------------------------------- */

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('sys.users.index')->with('success', 'Usuario creado correctamente.');
    }

/* ------------------------------------------------------------------------------------------------------------- */

    public function show(string $id)
    {
        $user = User::findOrFail($id);
        return view('sys.users.show', compact('user'));
    }

/* ------------------------------------------------------------------------------------------------------------- */

    public function edit(string $id)
    {
        $user = User::findOrFail($id);

        return view('sys.users.edit', compact('user'));
    }

/* ------------------------------------------------------------------------------------------------------------- */

    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:6',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        $user->save();

        return redirect()->route('sys.users.index')->with('success', 'Usuario actualizado correctamente.');
    }

/* ------------------------------------------------------------------------------------------------------------- */

    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('sys.users.index')->with('success', 'Usuario eliminado correctamente');
    }
}
