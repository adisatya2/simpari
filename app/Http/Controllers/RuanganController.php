<?php

namespace App\Http\Controllers;

use App\Models\Ruangan;
use Illuminate\Http\Request;

class RuanganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('ruangan.index');
    }

    public function data(Request $request)
    {
        $ruangan = Ruangan::orderBy('lantai', 'asc')->orderBy('nama_ruangan', 'asc')->get();

        return datatables()
            ->of($ruangan)
            ->editColumn('kode_ruangan', function ($ruangan) {
                return strval($ruangan->kode_ruangan);
            })
            ->editColumn('aktif', function ($ruangan) {
                if ($ruangan->aktif == 1) {
                    return '<i class="fas fa-check-circle"></i>';
                } else {
                    return '<i class="fas fa-times-circle"></i>';
                }
            })
            ->addColumn('aksi', function ($ruangan) {
                $button = '
                <div class="btn-group">
                    <button type="button" class="btn btn-secondary btn-xs  dropdown-toggle dropdown-icon" data-toggle="dropdown">
                        Select&nbsp;
                    </button>
                    <div class="dropdown-menu" role="menu">
                        <a class="dropdown-item" onclick="editForm(`' . route('ruangan.update', $ruangan->kode_ruangan) . '`)">Edit</a>
                    </div>
                </div>
                ';

                return $button;
            })
            ->rawColumns(['aksi', 'aktif'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request['aktif'] = !$request['aktif'] ? 0 :  1;

        $ruangan = Ruangan::create($request->all());

        return response()->json('Data berhasil disimpan', 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $ruangan = Ruangan::findOrFail($id);

        return response()->json($ruangan);
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
        $ruangan = Ruangan::findOrFail($id);

        $request['aktif'] = !$request['aktif'] ? 0 :  1;

        $ruangan->update($request->all());

        return response()->json('Data berhasil disimpan', 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
