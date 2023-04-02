<?php

namespace App\Http\Controllers;

use App\Models\Ruangan;
use App\Models\PasienPulang;
use Illuminate\Http\Request;

class PasienPulangController extends Controller
{
    public function index()
    {
        $ruangan = Ruangan::orderBy('lantai', 'desc')->orderBy('kode_ruangan', 'asc')->pluck('nama_ruangan', 'kode_ruangan');

        return view('pasien_pulang.index', compact(['ruangan']));
    }

    public function data(Request $request)
    {
        $ruangan = $request['ruangan'] ? $request['ruangan'] : '';
        $from = $request['tanggal_awal'] ? $request['tanggal_awal'] . ' 00:00:00' : '';
        $to = $request['tanggal_akhir'] ? $request['tanggal_akhir'] . ' 23:59:59' : '';

        $pasien_pulang = PasienPulang::with(['ruangan_bed', 'kelas_bed', 'dpjp', 'data_pasien', 'data_registrasi'])->where('kode_ruangan', 'like', '%' . $ruangan . '%')->whereBetween('tanggal_pulang', [$from, $to])->orderBy('created_at', 'desc')->get();

        return datatables()
            ->of($pasien_pulang)
            ->addColumn('los', function ($pasien_pulang) {
                if ($pasien_pulang->dpjp) {
                    $selisih = selisih_hari($pasien_pulang->tanggal_masuk, $pasien_pulang->tanggal_pulang) + 1;
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
            ->addColumn('no_kamar2', function ($pasien_pulang) {
                $button = '
                <span class="text-bold" data-kamar="' . $pasien_pulang->no_kamar . '" data-toggle="tooltip" data-html="true" data-placement="bottom" title="' . $pasien_pulang->kelas_bed->nama_kelas . '<br>' . $pasien_pulang->ruangan_bed->nama_ruangan . '<br>Lantai ' . $pasien_pulang->ruangan_bed->lantai;

                if ($pasien_pulang->flagbor == 1) {
                    $button .= '<br> BOR <i class=\'fas fa-check-circle text-success\'></i>';
                } else {
                    $button .= '<br> BOR <i class=\'fas fa-times-circle  text-danger\'></i>';
                }
                if ($pasien_pulang->flagsetting == 1) {
                    $button .= '<br> Setting <i class=\'fas fa-check-circle text-success\'></i>';
                } else {
                    $button .= '<br> Setting <i class=\'fas fa-times-circle  text-danger\'></i>';
                }

                $button .= '">
                ' . $pasien_pulang->no_kamar . '
                </span>';

                return $button;
            })
            ->editColumn('dokter', function ($pasien_pulang) {
                $span = '';
                if ($pasien_pulang->dpjp) {
                    $span .= '
                    <span data-toggle="tooltip" data-html="true"  data-placement="bottom" title="' . $pasien_pulang->dpjp->id_dokter . '<br>' . $pasien_pulang->dpjp->nama_dokter . '<br>' . $pasien_pulang->dpjp->departemen . '">' . $pasien_pulang->dpjp->nama_dokter . '</span>
                    ';
                }
                return $span;
            })
            ->addColumn('nama_dokter', function ($pasien_pulang) {
                if ($pasien_pulang->dpjp) {
                    return $pasien_pulang->dpjp->nama_dokter;
                } else {
                    return '';
                }
            })
            ->addColumn('nama_jaminan', function ($pasien_pulang) {
                if ($pasien_pulang->data_registrasi) {
                    return $pasien_pulang->data_registrasi->nama_jaminan;
                } else {
                    return '';
                }
            })
            ->editColumn('tanggal_masuk', function ($pasien_pulang) {
                if ($pasien_pulang->tanggal_masuk) {
                    return tanggal_indonesia($pasien_pulang->tanggal_masuk, true);
                } else {
                    return '';
                }
            })
            ->addColumn('aksi', function ($pasien_pulang) {
                $button = '
                <div class="btn-group">
                    <button type="button" class="btn btn-secondary btn-xs dropdown-toggle dropdown-icon m-0" data-toggle="dropdown">
                        Select&nbsp;
                    </button>
                    <div class="dropdown-menu" role="menu">';

                $button .= '
                    <a class="dropdown-item" href="' . route('surveilans.edit', $pasien_pulang->no_registrasi) . '">Surveilans</a>
                    <a class="dropdown-item" onclick="detailForm(`' . route('pasienpulang.show', $pasien_pulang->no_registrasi) . '`)">Detail Data Registrasi</a>
                    <a class="dropdown-item" onclick="detailPasien(`' . route('pasien.show', $pasien_pulang->mrn) . '`)">Detail Pasien</a>
                    <a class="dropdown-item" href="' . url('master/pasien/cetak-barcode/' . $pasien_pulang->mrn)  . '" target="_blank">Cetak Barcode</a>
                    </div>
                </div>
                ';

                return $button;
            })
            ->rawColumns(['aksi', 'no_kamar2', 'dokter', 'los'])
            ->make(true);
    }

    public function show(string $id)
    {
        $pasien_pulang = PasienPulang::with(['ruangan_bed', 'kelas_bed', 'dpjp', 'data_pasien', 'data_registrasi'])->where('no_registrasi', 'like', '%' . $id . '%')->first();

        return response()->json($pasien_pulang, 200);
    }
}
