<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Gate;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    // Mostrar todos los usuarios
    public function index()
    {


        $users = User::all();
        return view('users.index', compact('users'));
    }

    // Mostrar el formulario para crear un nuevo usuario
    public function create()
    {

        $roles = Role::all();
        return view('users.create', compact('roles'));
    }

    // Almacenar un nuevo usuario en la base de datos
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'roles' => 'array'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        if ($request->roles) {
            $roleNames = Role::whereIn('id', $request->roles)->pluck('name')->toArray();
            $user->syncRoles($roleNames);
        }

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }


    // Mostrar el formulario para editar un usuario existente
    public function edit(User $user)
    {


        $roles = Role::all();
        $userRoles = $user->roles->pluck('id')->toArray();
        return view('users.edit', compact('user', 'roles', 'userRoles'));
    }
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'roles' => 'array'
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
        ]);

        if ($request->roles) {
            $roleNames = Role::whereIn('id', $request->roles)->pluck('name')->toArray();
            $user->syncRoles($roleNames);
        }

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }


    // Eliminar un usuario de la base de datos
    public function destroy(User $user)
    {


        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}
