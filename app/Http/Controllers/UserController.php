<?php

namespace App\Http\Controllers;

use App\Models\CabangHermina;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:IT SUPPORT']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::all();
        $cabang = CabangHermina::all();
        return view('user.index', compact(['roles', 'cabang']));
    }

    public function data(Request $request)
    {
        $user = User::orderBy('created_at', 'asc')->get();

        return datatables()
            ->of($user)
            ->addColumn('role', function ($user) {
                return $user->getRoleNames();
            })
            ->editColumn('aktif', function ($user) {
                if ($user->aktif == 1) {
                    return '<i class="fas fa-check-circle"></i>';
                } else {
                    return '<i class="fas fa-times-circle"></i>';
                }
            })
            ->addColumn('aksi', function ($user) {
                $button = '
                <div class="btn-group">
                    <button type="button" class="btn btn-secondary btn-xs  dropdown-toggle dropdown-icon" data-toggle="dropdown">
                        Select&nbsp;
                    </button>
                    <div class="dropdown-menu" role="menu">
                        <a class="dropdown-item" onclick="editForm(`' . route('user.update', $user->id) . '`)">Edit</a>
                        <a class="dropdown-item" onclick="changePassword(`' . route('user.changepass', $user->id) . '`,`' . route('user.show', $user->id) . '`)">Ganti Password</a>
                    </div>
                </div>
                ';

                return $button;
            })
            ->editColumn('created_at', function ($user) {
                if ($user->created_at) {
                    return date_format($user->created_at, 'Y-m-d H:i:s');
                } else {
                    return '';
                }
            })
            ->rawColumns(['aksi', 'aktif'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        $cabang = CabangHermina::all();

        return view('user.form', compact(['roles', 'cabang']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'username' => ['required', 'string', 'max:255', 'unique:' . User::class],
            'nama_user' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', 'min:4'],
        ]);

        $user = User::create([
            'username' => $request->username,
            'name' => $request->nama_user,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'aktif' => $request->aktif ? 1 : 0,
        ]);

        $user->assignRole($request->roles);

        return redirect()->route('user.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::findOrFail($id);
        $user['roles'] = $user->getRoleNames();

        return response()->json($user);
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
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $user->name = $request['nama_user'];
        $user->email = $request['email'];
        $user->aktif = $request['aktif'] ? 1 : 0;

        $user->roles()->detach();
        $user->assignRole($request->roles);

        $user->save();

        return response()->json('Data berhasil disimpan', 200);
    }

    public function change_password(Request $request, string $id)
    {
        $request->validate([
            'password' => ['required', 'confirmed', 'min:4'],
        ]);

        $user = User::findOrFail($id);

        $user->password = Hash::make($request['password']);

        $user->save();

        return response()->json('Password berhasil diganti', 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
