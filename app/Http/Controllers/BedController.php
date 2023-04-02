<?php

namespace App\Http\Controllers;

use App\Models\Bed;
use App\Models\Kelas;
use App\Models\Ruangan;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class BedController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ruangan = Ruangan::orderBy('lantai', 'asc')->orderBy('kode_ruangan', 'asc')->pluck('nama_ruangan', 'kode_ruangan');
        $kelas = Kelas::all()->pluck('nama_kelas', 'id');

        return view('bed.index', compact(['ruangan', 'kelas']));
    }

    public function data(Request $request)
    {
        $bed = Bed::with(['ruangan_bed', 'kelas_bed'])->orderBy('no_kamar', 'asc')->get();

        return datatables()
            ->of($bed)
            ->editColumn('no_kamar', function ($bed) {
                return strval($bed->no_kamar);
            })
            ->editColumn('flagbor', function ($bed) {
                if ($bed->flagbor == 1) {
                    return '<i class="fas fa-check-circle text-success"></i>';
                } else {
                    return '<i class="fas fa-times-circle text-danger"></i>';
                }
            })
            ->editColumn('flagsetting', function ($bed) {
                if ($bed->flagsetting == 1) {
                    return '<i class="fas fa-check-circle text-success"></i>';
                } else {
                    return '<i class="fas fa-times-circle text-danger"></i>';
                }
            })
            ->editColumn('aktif', function ($bed) {
                if ($bed->aktif == 1) {
                    return '<i class="fas fa-check-circle text-success"></i>';
                } else {
                    return '<i class="fas fa-times-circle text-danger"></i>';
                }
            })
            ->addColumn('aksi', function ($bed) {
                $button = '
                <div class="btn-group">
                    <button type="button" class="btn btn-secondary btn-xs  dropdown-toggle dropdown-icon" data-toggle="dropdown">
                        Select&nbsp;
                    </button>
                    <div class="dropdown-menu" role="menu">
                        <a class="dropdown-item" onclick="editForm(`' . route('bed.update', $bed->no_kamar) . '`)">Edit</a>
                    </div>
                </div>
                ';

                return $button;
            })
            ->rawColumns(['aksi', 'aktif', 'flagbor', 'flagsetting'])
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
        $request['no_kamar'] = Str::upper($request['no_kamar']);
        $request['flagbor'] = !$request['flagbor'] ? 0 :  1;
        $request['flagsetting'] = !$request['flagsetting'] ? 0 :  1;
        $request['aktif'] = !$request['aktif'] ? 0 :  1;
        $request['user_create'] =  auth()->user()->username;

        $bed = Bed::create($request->all());

        return response()->json('Data berhasil disimpan', 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $bed = Bed::findOrFail($id);

        return response()->json($bed);
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
        $kamar = Bed::findOrFail($id);

        $request['no_kamar'] = Str::upper($request['no_kamar']);
        $request['flagbor'] = !$request['flagbor'] ? 0 :  1;
        $request['flagsetting'] = !$request['flagsetting'] ? 0 :  1;
        $request['aktif'] = !$request['aktif'] ? 0 :  1;

        $kamar->update($request->all());

        return response()->json('Data berhasil disimpan', 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kamar = Bed::findOrFail($id);

        $kamar->update(['aktif' => 0]);

        return response()->json('Data berhasil dinonaktifkan', 200);
    }
}
