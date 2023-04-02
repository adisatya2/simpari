<?php

namespace App\Http\Controllers;

use App\Models\Agama;
use PDF;
use App\Models\MasterPasien;
use Illuminate\Http\Request;

class MasterPasienController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $agama = Agama::all()->pluck('nama_agama', 'id');
        return view('master_pasien.index', compact(['agama']));
    }

    public function data(Request $request)
    {
        $master_pasien = MasterPasien::orderBy('mrn', 'desc')->get();

        return datatables()
            ->of($master_pasien)
            ->editColumn('mrn', function ($master_pasien) {
                return strval($master_pasien->mrn);
            })
            ->editColumn('tanggal_lahir', function ($master_pasien) {
                return tanggal_indonesia($master_pasien->tanggal_lahir, false);
            })
            ->addColumn('aksi', function ($master_pasien) {
                $button = '
                <div class="btn-group">
                    <button type="button" class="btn btn-secondary btn-xs  dropdown-toggle dropdown-icon" data-toggle="dropdown">
                        Select&nbsp;
                    </button>
                    <div class="dropdown-menu" role="menu">
                        <a class="dropdown-item" onclick="editForm(`' . route('pasien.update', $master_pasien->mrn) . '`)">Edit</a>
                        <a class="dropdown-item" onclick="detailPasien(`' . route('pasien.show', $master_pasien->mrn) . '`)">Detail Pasien</a>
                        <a class="dropdown-item" href="' . url('master/pasien/cetak-barcode/' . $master_pasien->mrn)  . '" target="_blank">Cetak Barcode</a>
                        <a class="dropdown-item" onclick="editForm(`' . route('pasien.show', $master_pasien->mrn) . '`)">Registrasi Rawat Inap</a>
                    </div>
                </div>
                ';

                return $button;
            })
            ->rawColumns(['aksi'])
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
        $pasien = MasterPasien::create($request->all());

        return response()->json('Data berhasil disimpan', 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $mrn)
    {
        $pasien = MasterPasien::findOrFail($mrn);

        $pasien['umur'] = hitung_umur($pasien['tanggal_lahir']);

        return response()->json($pasien);
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
    public function update(Request $request, string $mrn)
    {
        $pasien = MasterPasien::findOrFail($mrn);

        $pasien->update($request->all());

        return response()->json('Data berhasil disimpan', 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function cetakBarcode(string $mrn)
    {
        $pasien = MasterPasien::find($mrn);

        $customPaper = array(0, 0, 85.0394, 283.465);

        $pdf = PDF::loadView('master_pasien.barcode', compact('pasien'));
        $pdf->setPaper($customPaper, 'landscape');
        return $pdf->stream('master_pasien.pdf');
    }
}
