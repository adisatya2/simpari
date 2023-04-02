<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use Illuminate\Http\Request;

class DokterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dokter.index');
    }

    public function data(Request $request)
    {
        $dokter = Dokter::orderBy('nama_dokter', 'asc')->get();

        return datatables()
            ->of($dokter)
            ->editColumn('id_dokter', function ($dokter) {
                return strval($dokter->id_dokter);
            })
            ->editColumn('aktif', function ($dokter) {
                if ($dokter->aktif == 1) {
                    return '<i class="fas fa-check-circle"></i>';
                } else {
                    return '<i class="fas fa-times-circle"></i>';
                }
            })
            ->addColumn('aksi', function ($dokter) {
                $button = '
                <div class="btn-group">
                    <button type="button" class="btn btn-secondary btn-xs  dropdown-toggle dropdown-icon" data-toggle="dropdown">
                        Select&nbsp;
                    </button>
                    <div class="dropdown-menu" role="menu">
                        <a class="dropdown-item" onclick="editForm(`' . route('dokter.update', $dokter->id_dokter) . '`)">Edit</a>
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

        $dokter = Dokter::create($request->all());

        return response()->json('Data berhasil disimpan', 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $dokter = Dokter::findOrFail($id);

        return response()->json($dokter);
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
        $dokter = Dokter::findOrFail($id);

        $request['aktif'] = !$request['aktif'] ? 0 :  1;

        $dokter->update($request->all());

        return response()->json('Data berhasil disimpan', 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $dokter = Dokter::findOrFail($id);

        $dokter->update(['aktif' => 0]);

        return response()->json('Data berhasil dinonaktifkan', 200);
    }
}
