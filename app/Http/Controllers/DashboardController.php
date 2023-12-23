<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Unit;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $units = Unit::all();

        return view('dashboard.index', compact('units'));
    }


    public function settingAdmin()
    {
        $superAdminRole = Role::where('name', 'superadmin')->first();

        $users = User::whereDoesntHave('roles', function ($query) use ($superAdminRole) {
            $query->where('id', $superAdminRole->id);
        })->get();

        return view('dashboard.setting-admin', compact('users'));
    }

    public function updateAdminRole(Request $request)
    {
        // Validasi form jika diperlukan
        $request->validate([
            'id_user' => 'required|exists:users,id',
        ]);

        // Update role user menjadi admin
        $user = User::find($request->id_user);
        if ($user->getRoleNames()[0] == "admin") {
            $user->removeRole('admin');
            $user->assignRole('pegawai');
        }else{
            $user->removeRole('pegawai');
            $user->assignRole('admin');
        }

        return redirect()->route('dashboard.setting-admin')->with('success', 'Role user berhasil diubah menjadi admin.');
    }
}
