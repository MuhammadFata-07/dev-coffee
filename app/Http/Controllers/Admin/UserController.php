<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::with('role')
            ->when($request->filled('role'), fn ($q) =>
                $q->whereHas('role', fn ($r) => $r->where('name', $request->role)))
            ->when($request->filled('q'), fn ($q) =>
                $q->where(fn ($w) => $w
                    ->where('name', 'like', "%{$request->q}%")
                    ->orWhere('email', 'like', "%{$request->q}%")))
            ->orderBy('role_id')
            ->orderBy('name')
            ->paginate(10)
            ->withQueryString();

        $roles = Role::orderBy('id')->get();

        return view('admin.users.index', compact('users', 'roles'));
    }

    public function create()
    {
        $roles = Role::whereIn('name', ['admin', 'kasir'])->get();

        return view('admin.users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'     => ['required', 'string', 'max:100'],
            'email'    => ['required', 'email', 'max:150', 'unique:users,email'],
            'phone'    => ['nullable', 'string', 'max:20'],
            'role_id'  => ['required', Rule::exists('roles', 'id')->whereIn('name', ['admin', 'kasir'])],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $data['is_active'] = true;
        User::create($data);

        return redirect()->route('admin.users.index')->with('success', 'Akun staf berhasil dibuat.');
    }

    public function edit(User $user)
    {
        $this->abortIfCustomer($user);
        $roles = Role::whereIn('name', ['admin', 'kasir'])->get();

        return view('admin.users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        $this->abortIfCustomer($user);

        $data = $request->validate([
            'name'     => ['required', 'string', 'max:100'],
            'email'    => ['required', 'email', 'max:150', Rule::unique('users', 'email')->ignore($user->id)],
            'phone'    => ['nullable', 'string', 'max:20'],
            'role_id'  => ['required', Rule::exists('roles', 'id')->whereIn('name', ['admin', 'kasir'])],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ]);

        if (blank($data['password'] ?? null)) {
            unset($data['password']); // kosong = password tidak diubah
        }
        if ($user->id === auth()->id()) {
            unset($data['role_id']); // tidak boleh mengubah role akun sendiri
        }

        $user->update($data);

        return redirect()->route('admin.users.index')->with('success', 'Akun berhasil diperbarui.');
    }

    public function toggle(User $user)
    {
        if ($user->id === auth()->id()) {
            return back()->with('error', 'Anda tidak dapat menonaktifkan akun sendiri.');
        }

        $user->update(['is_active' => ! $user->is_active]);

        return back()->with('success', 'Akun ' . $user->name . ' sekarang ' . ($user->is_active ? 'aktif' : 'nonaktif') . '.');
    }

    private function abortIfCustomer(User $user): void
    {
        if ($user->role?->name === 'pelanggan') {
            abort(403, 'Akun pelanggan tidak dapat diubah oleh admin.');
        }
    }
}