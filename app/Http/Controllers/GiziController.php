<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Agama;
use App\Models\Bed;
use App\Models\Dokter;
use App\Models\Kelas;
use App\Models\Ruangan;
use Illuminate\Http\Request;

class GiziController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:IT SUPPORT|PERAWAT|PANTRY/GIZI|MUTU DAN AKREDITASI|DIREKSI']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ruangan = Ruangan::orderBy('lantai', 'desc')->orderBy('kode_ruangan', 'asc')->pluck('nama_ruangan', 'kode_ruangan');
        $agama = Agama::all()->pluck('nama_agama', 'id');
        $dokter = Dokter::orderBy('nama_dokter', 'asc')->pluck('nama_dokter', 'id_dokter');
        $kelas = Kelas::all()->pluck('nama_kelas', 'id');

        return view('gizi/index', compact(['ruangan', 'agama', 'dokter', 'kelas']));
    }

    public function data(Request $request)
    {
        $ruangan = $request['ruangan'] ? $request['ruangan'] : '';

        $bed_ruangan = Bed::with(['ruangan_bed', 'kelas_bed', 'dpjp', 'data_pasien', 'data_gizi'])->whereNotNull('no_registrasi')->where('aktif', '=', 1)->where('kode_ruangan', 'like', '%' . $ruangan . '%')->orderBy('no_kamar', 'asc')->get();

        // $bed_ruangan = Bed::with(['ruangan_bed', 'kelas_bed', 'dpjp', 'data_pasien', 'data_gizi'])->whereNotNull('no_registrasi')->where('aktif', '=', 1)->orderBy('no_kamar', 'asc')->get();

        return datatables()
            ->of($bed_ruangan)
            ->addColumn('los', function ($bed_ruangan) {
                if ($bed_ruangan->dpjp) {
                    $selisih = selisih_hari($bed_ruangan->tanggal_masuk, date("Y-m-d")) + 1;
                    $button = '';

                    if ($selisih > 3) {
                        $button = '<button class="btn btn-flat btn-danger">' . $selisih . '</button>';
                    } elseif ($selisih == 1) {
                        $button = '<button class="btn btn-flat btn-info">' . $selisih . '</button>';
                    } else {
                        $button = '<button class="btn btn-flat btn-warning">' . $selisih . '</button>';
                    }
                    return $button;
                } else {
                    return '';
                }
            })
            ->addColumn('no_kamar', function ($bed_ruangan) {
                $button = '
                <span class="text-bold" data-kamar="' . $bed_ruangan->no_kamar . '" data-toggle="tooltip" data-html="true" data-placement="bottom" title="' . $bed_ruangan->kelas_bed->nama_kelas . '<br>' . $bed_ruangan->ruangan_bed->nama_ruangan . '<br>Lantai ' . $bed_ruangan->ruangan_bed->lantai;

                if ($bed_ruangan->flagbor == 1) {
                    $button .= '<br> BOR <i class=\'fas fa-check-circle text-success\'></i>';
                } else {
                    $button .= '<br> BOR <i class=\'fas fa-times-circle  text-danger\'></i>';
                }
                if ($bed_ruangan->flagsetting == 1) {
                    $button .= '<br> Setting <i class=\'fas fa-check-circle text-success\'></i>';
                } else {
                    $button .= '<br> Setting <i class=\'fas fa-times-circle  text-danger\'></i>';
                }

                $button .= '">
                ' . $bed_ruangan->no_kamar . '
                </span>';

                return $button;
            })
            ->editColumn('dokter', function ($bed_ruangan) {
                $span = '';
                if ($bed_ruangan->dpjp) {
                    $span .= '
                    <span data-toggle="tooltip" data-html="true"  data-placement="bottom" title="' . $bed_ruangan->dpjp->id_dokter . '<br>' . $bed_ruangan->dpjp->nama_dokter . '<br>' . $bed_ruangan->dpjp->departemen . '">' . $bed_ruangan->dpjp->nama_dokter . '</span>
                    ';
                }
                return $span;
            })
            ->editColumn('tanggal_masuk', function ($bed_ruangan) {
                if ($bed_ruangan->tanggal_masuk) {
                    return tanggal_indonesia($bed_ruangan->tanggal_masuk, true);
                } else {
                    return '';
                }
            })
            ->addColumn('diet', function ($bed_ruangan) {
                if ($bed_ruangan->data_gizi) {
                    return $bed_ruangan->data_gizi->diet;
                } else {
                    return '';
                }
            })
            ->addColumn('keterangan', function ($bed_ruangan) {
                if ($bed_ruangan->data_gizi) {
                    return $bed_ruangan->data_gizi->keterangan;
                } else {
                    return '';
                }
            })
            ->addColumn('aksi', function ($bed_ruangan) {
                $button = '
                <div class="btn-group">
                    <button type="button" class="btn btn-secondary btn-xs dropdown-toggle dropdown-icon m-0" data-toggle="dropdown">
                        Select&nbsp;
                    </button>
                    <div class="dropdown-menu" role="menu">';
                $button .= '
                    <a class="dropdown-item" onclick="formDiet(`' . route('diet.update', $bed_ruangan->no_registrasi) . '`)">Diet</a>
                    <a class="dropdown-item" onclick="detailForm(`' . route('pasiendirawat.show', $bed_ruangan->no_kamar) . '`)">Detail Data Registrasi</a>
                    <a class="dropdown-item" onclick="detailPasien(`' . route('pasien.show', $bed_ruangan->mrn) . '`)">Detail Pasien</a>
                    </div>
                </div>
                ';
                if ($bed_ruangan->data_gizi) {
                    $button .= '
                    <a class="dropdown-item" href="' . url('gizi/cetaklabel/' . $bed_ruangan->mrn) . '" target="_blank">Cetak Label Gizi</a>
                ';
                }
                $button .= '
                </div>
                ';

                return $button;
            })
            ->rawColumns(['aksi', 'no_kamar', 'dokter', 'los'])
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
        //
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
