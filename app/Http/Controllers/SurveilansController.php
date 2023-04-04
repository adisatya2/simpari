<?php

namespace App\Http\Controllers;

use App\Models\Bed;
use App\Models\Agama;
use App\Models\Kelas;
use App\Models\Dokter;
use App\Models\Ruangan;
use App\Models\IdoBundle;
use App\Models\IdoGejala;
use App\Models\IdoHeader;
use App\Models\IskBundle;
use App\Models\IskDetail;
use App\Models\IskGejala;
use App\Models\IskHeader;
use App\Models\VapBundle;
use App\Models\VapDetail;
use App\Models\VapGejala;
use App\Models\VapHeader;
use App\Models\IadpBundle;
use App\Models\IadpDetail;
use App\Models\IadpGejala;
use App\Models\IadpHeader;
use App\Models\AlatInvasif;
use App\Models\JenisCairan;
use App\Models\Profilaksis;
use Illuminate\Http\Request;
use App\Models\Registrasirwi;
use App\Models\LokasiCatheter;
use App\Models\PhlebitisBundle;
use App\Models\PhlebitisDetail;
use App\Models\PhlebitisGejala;
use App\Models\PhlebitisHeader;

class SurveilansController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ruangan = Ruangan::orderBy('lantai', 'desc')->orderBy('kode_ruangan', 'asc')->pluck('nama_ruangan', 'kode_ruangan');
        $agama = Agama::all()->pluck('nama_agama', 'id');
        $dokter = Dokter::orderBy('nama_dokter', 'asc')->pluck('nama_dokter', 'id_dokter');
        $kelas = Kelas::all()->pluck('nama_kelas', 'id');

        return view('surveilans/index', compact(['ruangan', 'agama', 'dokter', 'kelas']));
    }

    public function data(Request $request)
    {
        $ruangan = $request['ruangan'] ? $request['ruangan'] : '';

        $bed_ruangan = Bed::with(['ruangan_bed', 'kelas_bed', 'dpjp', 'data_pasien'])->whereNotNull('no_registrasi')->where('aktif', '=', 1)->where('kode_ruangan', 'like', '%' . $ruangan . '%')->orderBy('no_kamar', 'asc')->get();

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
            ->addColumn('aksi', function ($bed_ruangan) {
                $button = '
                <div class="btn-group">
                    <button type="button" class="btn btn-secondary btn-xs dropdown-toggle dropdown-icon m-0" data-toggle="dropdown">
                        Select&nbsp;
                    </button>
                    <div class="dropdown-menu" role="menu">';
                $button .= '
                    <a class="dropdown-item" href="' . route('surveilans.edit', $bed_ruangan->no_registrasi) . '">Surveilans</a>
                    <a class="dropdown-item" onclick="detailForm(`' . route('pasiendirawat.show', $bed_ruangan->no_kamar) . '`)">Detail Data Registrasi</a>
                    <a class="dropdown-item" onclick="detailPasien(`' . route('pasien.show', $bed_ruangan->mrn) . '`)">Detail Pasien</a>
                    <a class="dropdown-item" href="' . url('master/pasien/cetak-barcode/' . $bed_ruangan->mrn)  . '" target="_blank">Cetak Barcode</a>
                    </div>
                </div>
                ';

                return $button;
            })
            ->rawColumns(['aksi', 'no_kamar', 'dokter', 'los'])
            ->make(true);
    }

    public function show(string $id)
    {
        //
    }

    public function create()
    {
        //
    }

    public function edit(string $id)
    {
        $data_registrasi = Registrasirwi::with(['dpjp', 'data_pasien', 'data_kamar'])->where('no_registrasi', 'like', '%' . $id . '%')->orderBy('no_kamar', 'asc')->first();
        $ruangan = Ruangan::orderBy('lantai', 'asc')->pluck('nama_ruangan', 'kode_ruangan');
        $profilaksis = Profilaksis::orderBy('nama_obat', 'asc')->pluck('nama_obat', 'id');
        $alat_invasif = AlatInvasif::all();
        $isk_bundle = IskBundle::all();
        $isk_gejala = IskGejala::all();
        $vap_bundle = VapBundle::all();
        $vap_gejala = VapGejala::all();
        $iadp_bundle = IadpBundle::all();
        $iadp_gejala = IadpGejala::all();
        $phlebitis_bundle = PhlebitisBundle::all();
        $phlebitis_gejala = PhlebitisGejala::all();
        $ido_bundle = IdoBundle::all();
        $ido_gejala = IdoGejala::all();
        $lokasi_catheter = LokasiCatheter::all();
        $jenis_cairan = JenisCairan::all();

        $logphlebitis = PhlebitisHeader::where('no_registrasi', '=', $data_registrasi->no_registrasi)->orderBy('created_at', 'desc')->get();
        $logisk = IskHeader::where('no_registrasi', '=', $data_registrasi->no_registrasi)->orderBy('created_at', 'desc')->get();
        $logiadp = IadpHeader::where('no_registrasi', '=', $data_registrasi->no_registrasi)->orderBy('created_at', 'desc')->get();
        $logvap = VapHeader::where('no_registrasi', '=', $data_registrasi->no_registrasi)->orderBy('created_at', 'desc')->get();
        $logido = IdoHeader::where('no_registrasi', '=', $data_registrasi->no_registrasi)->orderBy('created_at', 'desc')->get();

        return view('surveilans/surveilans', compact(['ruangan', 'data_registrasi', 'profilaksis', 'alat_invasif', 'lokasi_catheter', 'jenis_cairan', 'isk_bundle', 'isk_gejala', 'vap_bundle', 'vap_gejala', 'iadp_bundle', 'iadp_gejala', 'phlebitis_bundle', 'phlebitis_gejala', 'ido_bundle', 'ido_gejala', 'logphlebitis', 'logisk', 'logiadp', 'logvap', 'logido']));
    }

    public function store_phlebitis(Request $request)
    {
        // $header['id'] = 'PHB-' . $request['observasi_ke'] . '-' . date("ymd") . '-' . $request['no_registrasi'];
        if (!$request['id_header']) {
            $cek = PhlebitisHeader::where('no_registrasi', '=', $request['no_registrasi'])->where('pemasangan_ke', '=', $request['pemasangan_ke'])->get();
            if ($cek->count() > 0) {
                return response()->json(['pesan' => 'error'], 409);
            }
            PhlebitisHeader::create(
                [
                    'id' => 'PHB-' . $request['pemasangan_ke'] . '-' . date("ymd") . '-' . $request['no_registrasi'],
                    'no_registrasi' => $request['no_registrasi'],
                    'ruang_perawatan' => $request['ruang_perawatan'],
                    'ruang_pemasangan' => $request['ruang_pemasangan_catheter'],
                    'petugas_pasang' => $request['petugas_pasang'],
                    'jenis_cairan' => $request['jenis_cairan'],
                    'pemasangan_ke' => $request['pemasangan_ke'],
                    'nomor_catheter' => $request['nomor_catheter'],
                    'lokasi_pemasangan' => $request['lokasi_pemasangan'],
                    'tanggal_pemasangan' => $request['tanggal_pemasangan'],
                    'tanggal_dilepas' => $request['tanggal_dilepas'] ? $request['tanggal_dilepas'] : null,
                    'user_create' => auth()->user()->username,
                    // 'created_at' => time(),
                ]
            );
        }
        if ($request['id_header']) {
            $cek = PhlebitisDetail::where('id_header', '=', $request['id_header'])->where('tanggal_observasi', '=', $request['tanggal_observasi'])->get();
            if ($cek->count() > 0) {
                return response()->json(['pesan' => 'Data dengan tanggal yang sama sudah di-input'], 409);
            }

            $detail['bundle'] = $request['phlebitis_bundle'] ? implode(", ", $request['phlebitis_bundle']) : null;
            $detail['gejala'] = $request['phlebitis_gejala'] ? implode(", ", $request['phlebitis_gejala']) : null;

            PhlebitisDetail::create(
                [
                    'id_header' => $request['id_header'],
                    'observasi_ke' => $request['observasi_ke'],
                    'tanggal_observasi' => $request['tanggal_observasi'],
                    'antibiotik' => $request['antibiotik_phlebitis'],
                    'bundle' => $detail['bundle'],
                    'gejala' => $detail['gejala'],
                    'tanggal_pemeriksaan_kultur' => $request['tanggal_pemeriksaan_kultur_phlebitis'],
                    'hasil_kultur' => $request['hasil_kultur_phlebitis'],
                    'status' => $request['status_phlebitis'],
                    'user_create' => auth()->user()->username,
                    // 'created_at' => time(),
                ]
            );
        }

        $phlebitis_bundle = PhlebitisBundle::all();
        $phlebitis_gejala = PhlebitisGejala::all();

        $logphlebitis = PhlebitisHeader::with(['detail_list', 'data_ruang_pemasangan', 'data_ruang_perawatan'])->where('no_registrasi', '=', $request['no_registrasi'])->orderBy('created_at', 'desc')->get();

        $view = view('surveilans/log_phlebitis', compact(['logphlebitis', 'phlebitis_bundle', 'phlebitis_gejala']));
        $view = $view->render();

        return response()->json(['view' => $view, 'pesan' => 'Data berhasil disimpan.'], 200);
    }

    public function show_phlebitis_header(string $id)
    {
        $phlebitis = PhlebitisHeader::with(['detail_list', 'data_ruang_pemasangan', 'data_ruang_perawatan'])->where('id', '=', $id)->first();

        return  $phlebitis;
    }

    public function show_phlebitis_detail(string $id)
    {
        $phlebitis = PhlebitisDetail::with(['header'])->where('id', '=', $id)->first();

        return  $phlebitis;
    }

    public function update_phlebitis(Request $request, string $id)
    {
        if (!$request['id_header']) {
            $phlebitis = PhlebitisHeader::findOrFail($id);

            $phlebitis->ruang_perawatan = $request['ruang_perawatan'];
            $phlebitis->ruang_pemasangan = $request['ruang_pemasangan_catheter'];
            $phlebitis->petugas_pasang = $request['petugas_pasang'];
            $phlebitis->jenis_cairan = $request['jenis_cairan'];
            $phlebitis->nomor_catheter = $request['nomor_catheter'];
            $phlebitis->lokasi_pemasangan = $request['lokasi_pemasangan'];
            $phlebitis->tanggal_pemasangan = $request['tanggal_pemasangan'];
            $phlebitis->tanggal_dilepas = $request['tanggal_dilepas'] ? $request['tanggal_dilepas'] : null;
            $phlebitis->save();
        }
        if ($request['id_header']) {
            $cek = PhlebitisDetail::where('id_header', '=', $request['id_header'])->where('tanggal_observasi', '=', $request['tanggal_observasi'])->get();
            if ($cek->count() > 0) {
                return response()->json(['pesan' => 'Data dengan tanggal yang sama sudah di-input'], 409);
            }

            $detail['bundle'] = $request['phlebitis_bundle'] ? implode(", ", $request['phlebitis_bundle']) : null;
            $detail['gejala'] = $request['phlebitis_gejala'] ? implode(", ", $request['phlebitis_gejala']) : null;

            $phlebitis = PhlebitisDetail::findOrFail($id);

            $phlebitis->tanggal_observasi = $request['tanggal_observasi'];
            $phlebitis->antibiotik = $request['antibiotik_phlebitis'];
            $phlebitis->bundle = $detail['bundle'];
            $phlebitis->gejala = $detail['gejala'];
            $phlebitis->tanggal_pemeriksaan_kultur = $request['tanggal_pemeriksaan_kultur_phlebitis'];
            $phlebitis->hasil_kultur = $request['hasil_kultur_phlebitis'];
            $phlebitis->status = $request['status_phlebitis'];
            $phlebitis->save();
        }

        $phlebitis_bundle = PhlebitisBundle::all();
        $phlebitis_gejala = PhlebitisGejala::all();

        $logphlebitis = PhlebitisHeader::with(['detail_list', 'data_ruang_pemasangan', 'data_ruang_perawatan'])->where('no_registrasi', '=', $request['no_registrasi'])->orderBy('created_at', 'desc')->get();

        $view = view('surveilans/log_phlebitis', compact(['logphlebitis', 'phlebitis_bundle', 'phlebitis_gejala']));
        $view = $view->render();

        return response()->json(['view' => $view, 'pesan' => 'Data berhasil diedit.'], 200);
    }

    public function store_isk(Request $request)
    {
        // $header['id'] = 'PHB-' . $request['observasi_ke'] . '-' . date("ymd") . '-' . $request['no_registrasi'];
        if (!$request['id_header']) {
            $cek = IskHeader::where('no_registrasi', '=', $request['no_registrasi'])->where('pemasangan_ke', '=', $request['pemasangan_ke'])->get();
            if ($cek->count() > 0) {
                return response()->json(['pesan' => 'error'], 409);
            }
            IskHeader::create(
                [
                    'id' => 'ISK-' . $request['pemasangan_ke'] . '-' . date("ymd") . '-' . $request['no_registrasi'],
                    'no_registrasi' => $request['no_registrasi'],
                    'ruang_perawatan' => $request['ruang_perawatan'],
                    'pemasangan_ke' => $request['pemasangan_ke'],
                    'ruang_pemasangan' => $request['ruang_pemasangan'],
                    'petugas_pasang' => $request['petugas_pasang'],
                    'nomor_uc' => $request['nomor_uc'],
                    'tanggal_pemasangan' => $request['tanggal_pemasangan'],
                    'tanggal_dilepas' => $request['tanggal_dilepas'] ? $request['tanggal_dilepas'] : null,
                    'user_create' => auth()->user()->username,
                ]
            );
        }
        if ($request['id_header']) {
            $cek = IskDetail::where('id_header', '=', $request['id_header'])->where('tanggal_observasi', '=', $request['tanggal_observasi'])->get();
            if ($cek->count() > 0) {
                return response()->json(['pesan' => 'Data dengan tanggal yang sama sudah di-input'], 409);
            }

            $detail['bundle'] = $request['isk_bundle'] ? implode(", ", $request['isk_bundle']) : null;
            $detail['gejala'] = $request['isk_gejala'] ? implode(", ", $request['isk_gejala']) : null;

            IskDetail::create(
                [
                    'id_header' => $request['id_header'],
                    'observasi_ke' => $request['observasi_ke'],
                    'tanggal_observasi' => $request['tanggal_observasi'],
                    'antibiotik' => $request['antibiotik_isk'],
                    'bundle' => $detail['bundle'],
                    'gejala' => $detail['gejala'],
                    'tanggal_pemeriksaan_kultur' => $request['tanggal_pemeriksaan_kultur_isk'],
                    'hasil_kultur' => $request['hasil_kultur_isk'],
                    'status' => $request['status_isk'],
                    'user_create' => auth()->user()->username,
                ]
            );
        }


        $isk_bundle = IskBundle::all();
        $isk_gejala = IskGejala::all();

        $logisk = IskHeader::with(['detail_list', 'data_ruang_pemasangan', 'data_ruang_perawatan'])->where('no_registrasi', '=', $request['no_registrasi'])->orderBy('created_at', 'desc')->get();

        $view = view('surveilans/log_isk', compact(['logisk', 'isk_bundle', 'isk_gejala']));
        $view = $view->render();

        return response()->json(['view' => $view, 'pesan' => 'Data berhasil disimpan.'], 200);
    }

    public function show_isk_header(string $id)
    {
        $isk = IskHeader::with(['detail_list', 'data_ruang_pemasangan', 'data_ruang_perawatan'])->where('id', '=', $id)->first();

        return  $isk;
    }

    public function show_isk_detail(string $id)
    {
        $isk = IskDetail::with(['header'])->where('id', '=', $id)->first();

        return  $isk;
    }

    public function update_isk(Request $request, string $id)
    {
        if (!$request['id_header']) {
            $isk = IskHeader::findOrFail($id);

            $isk->ruang_perawatan = $request['ruang_perawatan'];
            $isk->ruang_pemasangan = $request['ruang_pemasangan'];
            $isk->petugas_pasang = $request['petugas_pasang'];
            $isk->nomor_uc = $request['nomor_uc'];
            $isk->tanggal_pemasangan = $request['tanggal_pemasangan'];
            $isk->tanggal_dilepas = $request['tanggal_dilepas'] ? $request['tanggal_dilepas'] : null;
            $isk->save();
        }
        if ($request['id_header']) {
            $cek = IskDetail::where('id_header', '=', $request['id_header'])->where('tanggal_observasi', '=', $request['tanggal_observasi'])->get();
            if ($cek->count() > 0) {
                return response()->json(['pesan' => 'Data dengan tanggal yang sama sudah di-input'], 409);
            }

            $detail['bundle'] = $request['isk_bundle'] ? implode(", ", $request['isk_bundle']) : null;
            $detail['gejala'] = $request['isk_gejala'] ? implode(", ", $request['isk_gejala']) : null;

            $isk = IskDetail::findOrFail($id);

            $isk->tanggal_observasi = $request['tanggal_observasi'];
            $isk->antibiotik = $request['antibiotik_isk'];
            $isk->bundle = $detail['bundle'];
            $isk->gejala = $detail['gejala'];
            $isk->tanggal_pemeriksaan_kultur = $request['tanggal_pemeriksaan_kultur_isk'];
            $isk->hasil_kultur = $request['hasil_kultur_isk'];
            $isk->status = $request['status_isk'];
            $isk->save();
        }

        $isk_bundle = IskBundle::all();
        $isk_gejala = IskGejala::all();

        $logisk = IskHeader::with(['detail_list', 'data_ruang_pemasangan', 'data_ruang_perawatan'])->where('no_registrasi', '=', $request['no_registrasi'])->orderBy('created_at', 'desc')->get();

        $view = view('surveilans/log_isk', compact(['logisk', 'isk_bundle', 'isk_gejala']));
        $view = $view->render();

        return response()->json(['view' => $view, 'pesan' => 'Data berhasil diedit.'], 200);
    }

    public function store_iadp(Request $request)
    {
        if (!$request['id_header']) {
            $cek = IadpHeader::where('no_registrasi', '=', $request['no_registrasi'])->where('pemasangan_ke', '=', $request['pemasangan_ke'])->get();
            if ($cek->count() > 0) {
                return response()->json(['pesan' => 'error'], 409);
            }
            IadpHeader::create(
                [
                    'id' => 'IAD-' . $request['pemasangan_ke'] . '-' . date("ymd") . '-' . $request['no_registrasi'],
                    'no_registrasi' => $request['no_registrasi'],
                    'ruang_perawatan' => $request['ruang_perawatan'],
                    'pemasangan_ke' => $request['pemasangan_ke'],
                    'ruang_pemasangan' => $request['ruang_pemasangan'],
                    'petugas_pasang' => $request['petugas_pasang'],
                    'nomor_cvc' => $request['nomor_cvc'],
                    'tanggal_pemasangan' => $request['tanggal_pemasangan'],
                    'tanggal_dilepas' => $request['tanggal_dilepas'] ? $request['tanggal_dilepas'] : null,
                    'user_create' => auth()->user()->username,
                ]
            );
        }
        if ($request['id_header']) {
            $cek = IadpDetail::where('id_header', '=', $request['id_header'])->where('tanggal_observasi', '=', $request['tanggal_observasi'])->get();
            if ($cek->count() > 0) {
                return response()->json(['pesan' => 'Data dengan tanggal yang sama sudah di-input'], 409);
            }

            $detail['bundle'] = $request['iadp_bundle'] ? implode(", ", $request['iadp_bundle']) : null;
            $detail['gejala'] = $request['iadp_gejala'] ? implode(", ", $request['iadp_gejala']) : null;

            IadpDetail::create(
                [
                    'id_header' => $request['id_header'],
                    'observasi_ke' => $request['observasi_ke'],
                    'tanggal_observasi' => $request['tanggal_observasi'],
                    'antibiotik' => $request['antibiotik_iadp'],
                    'bundle' => $detail['bundle'],
                    'gejala' => $detail['gejala'],
                    'tanggal_pemeriksaan_kultur' => $request['tanggal_pemeriksaan_kultur_iadp'],
                    'hasil_kultur' => $request['hasil_kultur_iadp'],
                    'status' => $request['status_iadp'],
                    'user_create' => auth()->user()->username,
                ]
            );
        }


        $iadp_bundle = IadpBundle::all();
        $iadp_gejala = IadpGejala::all();

        $logiadp = IadpHeader::with(['detail_list', 'data_ruang_pemasangan', 'data_ruang_perawatan'])->where('no_registrasi', '=', $request['no_registrasi'])->orderBy('created_at', 'desc')->get();

        $view = view('surveilans/log_iadp', compact(['logiadp', 'iadp_bundle', 'iadp_gejala']));
        $view = $view->render();

        return response()->json(['view' => $view, 'pesan' => 'Data berhasil disimpan.'], 200);
    }

    public function show_iadp_header(string $id)
    {
        $isk = IadpHeader::with(['detail_list', 'data_ruang_pemasangan', 'data_ruang_perawatan'])->where('id', '=', $id)->first();

        return  $isk;
    }

    public function show_iadp_detail(string $id)
    {
        $isk = IadpDetail::with(['header'])->where('id', '=', $id)->first();

        return  $isk;
    }

    public function update_iadp(Request $request, string $id)
    {
        if (!$request['id_header']) {
            $isk = IadpHeader::findOrFail($id);

            $isk->ruang_perawatan = $request['ruang_perawatan'];
            $isk->ruang_pemasangan = $request['ruang_pemasangan'];
            $isk->petugas_pasang = $request['petugas_pasang'];
            $isk->nomor_cvc = $request['nomor_cvc'];
            $isk->tanggal_pemasangan = $request['tanggal_pemasangan'];
            $isk->tanggal_dilepas = $request['tanggal_dilepas'] ? $request['tanggal_dilepas'] : null;
            $isk->save();
        }
        if ($request['id_header']) {
            $cek = IadpDetail::where('id_header', '=', $request['id_header'])->where('tanggal_observasi', '=', $request['tanggal_observasi'])->get();
            if ($cek->count() > 0) {
                return response()->json(['pesan' => 'Data dengan tanggal yang sama sudah di-input'], 409);
            }

            $detail['bundle'] = $request['iadp_bundle'] ? implode(", ", $request['iadp_bundle']) : null;
            $detail['gejala'] = $request['iadp_gejala'] ? implode(", ", $request['iadp_gejala']) : null;

            $isk = IadpDetail::findOrFail($id);

            $isk->tanggal_observasi = $request['tanggal_observasi'];
            $isk->antibiotik = $request['antibiotik_iadp'];
            $isk->bundle = $detail['bundle'];
            $isk->gejala = $detail['gejala'];
            $isk->tanggal_pemeriksaan_kultur = $request['tanggal_pemeriksaan_kultur_iadp'];
            $isk->hasil_kultur = $request['hasil_kultur_iadp'];
            $isk->status = $request['status_iadp'];
            $isk->save();
        }

        $iadp_bundle = IadpBundle::all();
        $iadp_gejala = IadpGejala::all();

        $logiadp = IadpHeader::with(['detail_list', 'data_ruang_pemasangan', 'data_ruang_perawatan'])->where('no_registrasi', '=', $request['no_registrasi'])->orderBy('created_at', 'desc')->get();

        $view = view('surveilans/log_iadp', compact(['logiadp', 'iadp_bundle', 'iadp_gejala']));
        $view = $view->render();

        return response()->json(['view' => $view, 'pesan' => 'Data berhasil diedit.'], 200);
    }

    public function store_vap(Request $request)
    {
        if (!$request['id_header']) {
            $cek = VapHeader::where('no_registrasi', '=', $request['no_registrasi'])->where('pemasangan_ke', '=', $request['pemasangan_ke'])->get();
            if ($cek->count() > 0) {
                return response()->json(['pesan' => 'error'], 409);
            }
            VapHeader::create(
                [
                    'id' => 'IAD-' . $request['pemasangan_ke'] . '-' . date("ymd") . '-' . $request['no_registrasi'],
                    'no_registrasi' => $request['no_registrasi'],
                    'ruang_perawatan' => $request['ruang_perawatan'],
                    'pemasangan_ke' => $request['pemasangan_ke'],
                    'ruang_pemasangan' => $request['ruang_pemasangan'],
                    'tanggal_pemasangan' => $request['tanggal_pemasangan'],
                    'tanggal_dilepas' => $request['tanggal_dilepas'] ? $request['tanggal_dilepas'] : null,
                    'user_create' => auth()->user()->username,
                ]
            );
        }
        if ($request['id_header']) {
            $cek = VapDetail::where('id_header', '=', $request['id_header'])->where('tanggal_observasi', '=', $request['tanggal_observasi'])->get();
            if ($cek->count() > 0) {
                return response()->json(['pesan' => 'Data dengan tanggal yang sama sudah di-input'], 409);
            }

            $detail['bundle'] = $request['vap_bundle'] ? implode(", ", $request['vap_bundle']) : null;
            $detail['gejala'] = $request['vap_gejala'] ? implode(", ", $request['vap_gejala']) : null;

            VapDetail::create(
                [
                    'id_header' => $request['id_header'],
                    'observasi_ke' => $request['observasi_ke'],
                    'tanggal_observasi' => $request['tanggal_observasi'],
                    'antibiotik' => $request['antibiotik_vap'],
                    'bundle' => $detail['bundle'],
                    'gejala' => $detail['gejala'],
                    'tanggal_pemeriksaan_kultur' => $request['tanggal_pemeriksaan_kultur_vap'],
                    'hasil_kultur' => $request['hasil_kultur_vap'],
                    'status' => $request['status_vap'],
                    'user_create' => auth()->user()->username,
                ]
            );
        }


        $vap_bundle = VapBundle::all();
        $vap_gejala = VapGejala::all();

        $logvap = VapHeader::with(['detail_list', 'data_ruang_pemasangan', 'data_ruang_perawatan'])->where('no_registrasi', '=', $request['no_registrasi'])->orderBy('created_at', 'desc')->get();

        $view = view('surveilans/log_vap', compact(['logvap', 'vap_bundle', 'vap_gejala']));
        $view = $view->render();

        return response()->json(['view' => $view, 'pesan' => 'Data berhasil disimpan.'], 200);
    }

    public function show_vap_header(string $id)
    {
        $isk = VapHeader::with(['detail_list', 'data_ruang_pemasangan', 'data_ruang_perawatan'])->where('id', '=', $id)->first();

        return  $isk;
    }

    public function show_vap_detail(string $id)
    {
        $isk = VapDetail::with(['header'])->where('id', '=', $id)->first();

        return  $isk;
    }

    public function update_vap(Request $request, string $id)
    {
        if (!$request['id_header']) {
            $isk = VapHeader::findOrFail($id);

            $isk->ruang_perawatan = $request['ruang_perawatan'];
            $isk->ruang_pemasangan = $request['ruang_pemasangan'];
            $isk->tanggal_pemasangan = $request['tanggal_pemasangan'];
            $isk->tanggal_dilepas = $request['tanggal_dilepas'] ? $request['tanggal_dilepas'] : null;
            $isk->save();
        }
        if ($request['id_header']) {
            $cek = VapDetail::where('id_header', '=', $request['id_header'])->where('tanggal_observasi', '=', $request['tanggal_observasi'])->get();
            if ($cek->count() > 0) {
                return response()->json(['pesan' => 'Data dengan tanggal yang sama sudah di-input'], 409);
            }

            $detail['bundle'] = $request['vap_bundle'] ? implode(", ", $request['vap_bundle']) : null;
            $detail['gejala'] = $request['vap_gejala'] ? implode(", ", $request['vap_gejala']) : null;

            $isk = VapDetail::findOrFail($id);

            $isk->tanggal_observasi = $request['tanggal_observasi'];
            $isk->antibiotik = $request['antibiotik_vap'];
            $isk->bundle = $detail['bundle'];
            $isk->gejala = $detail['gejala'];
            $isk->tanggal_pemeriksaan_kultur = $request['tanggal_pemeriksaan_kultur_vap'];
            $isk->hasil_kultur = $request['hasil_kultur_vap'];
            $isk->status = $request['status_vap'];
            $isk->save();
        }

        $vap_bundle = VapBundle::all();
        $vap_gejala = VapGejala::all();

        $logvap = VapHeader::with(['detail_list', 'data_ruang_pemasangan', 'data_ruang_perawatan'])->where('no_registrasi', '=', $request['no_registrasi'])->orderBy('created_at', 'desc')->get();

        $view = view('surveilans/log_vap', compact(['logvap', 'vap_bundle', 'vap_gejala']));
        $view = $view->render();

        return response()->json(['view' => $view, 'pesan' => 'Data berhasil diedit.'], 200);
    }

    public function store_ido(Request $request)
    {
        if ($request['ido_header']) {
            $cek = IdoHeader::where('no_registrasi', '=', $request['no_registrasi'])->where('operasi_ke', '=', $request['operasi_ke'])->get();
            if ($cek->count() > 0) {
                return response()->json(['pesan' => 'error'], 409);
            }
            $IdoHeader = new IdoHeader;

            $IdoHeader->id = 'IDO-' . $request['operasi_ke'] . '-' . date("ymd") . '-' . $request['no_registrasi'];
            $IdoHeader->no_registrasi = $request['no_registrasi'];
            $IdoHeader->operasi_ke = $request['operasi_ke'];
            $IdoHeader->jadwal_operasi = $request['jadwal_operasi'];
            $IdoHeader->jenis_operasi = $request['jenis_operasi'];
            $IdoHeader->user_create = auth()->user()->username;

            $IdoHeader->save();
        }

        $ido_bundle = IdoBundle::all();
        $ido_gejala = IdoGejala::all();

        $logido = IdoHeader::with(['data_ruang_perawatan'])->where('no_registrasi', '=', $request['no_registrasi'])->orderBy('created_at', 'desc')->get();

        $view = view('surveilans/log_ido', compact(['logido', 'ido_bundle', 'ido_gejala']));
        $view = $view->render();

        return response()->json(['view' => $view, 'pesan' => 'Data berhasil disimpan.'], 200);
    }

    public function show_ido(string $id)
    {
        $ido = IdoHeader::with(['data_ruang_perawatan'])->where('id', '=', $id)->first();

        return  $ido;
    }

    public function update_ido(Request $request, string $id)
    {
        $IdoHeader = IdoHeader::findOrFail($id);

        $berhasil = false;

        if ($request['ido_header']) {
            $IdoHeader->no_registrasi = $request['no_registrasi'];
            $IdoHeader->operasi_ke = $request['operasi_ke'];
            $IdoHeader->jadwal_operasi = $request['jadwal_operasi'];
            $IdoHeader->jenis_operasi = $request['jenis_operasi'];
            $IdoHeader->user_update = auth()->user()->username;

            if ($IdoHeader->save()) {
                $berhasil = true;
            }
        }

        if ($request['ido_pre']) {

            $bundle_pre = $request['bundle_pre'] ? implode(", ", $request['bundle_pre']) : null;

            $IdoHeader->ruang_perawatan = $request['ruang_perawatan'];
            $IdoHeader->suhu = $request['suhu'];
            $IdoHeader->gds = $request['gds'];
            $IdoHeader->screening_mrsa = $request['screening_mrsa'];
            $IdoHeader->pencukuran_dengan = $request['pencukuran_dengan'];
            $IdoHeader->antibiotik_profilaksis = $request['antibiotik_profilaksis'];
            $IdoHeader->waktu_pemberian_profilaksis = $request['waktu_pemberian_profilaksis'] ? $request['waktu_pemberian_profilaksis'] : null;
            $IdoHeader->riwayat_penyakit = $request['riwayat_penyakit'];
            $IdoHeader->bundle_pre = $bundle_pre;
            $IdoHeader->user_update_pre = auth()->user()->username;

            if ($IdoHeader->save()) {
                $berhasil = true;
            }
        }

        if ($request['ido_intra']) {

            $bundle_intra = $request['bundle_intra'] ? implode(", ", $request['bundle_intra']) : null;

            $IdoHeader->ruang_operasi = $request['ruang_operasi'];
            $IdoHeader->nama_prosedur_operasi = $request['nama_prosedur_operasi'];
            $IdoHeader->kualifikasi_daerah_operasi = $request['kualifikasi_daerah_operasi'];
            $IdoHeader->lama_operasi = $request['lama_operasi'];
            $IdoHeader->antibiotik_tambahan_intra = $request['antibiotik_tambahan_intra'];
            $IdoHeader->bundle_intra = $bundle_intra;
            $IdoHeader->user_update_intra = auth()->user()->username;

            if ($IdoHeader->save()) {
                $berhasil = true;
            }
        }

        if ($request['ido_post']) {

            $bundle_post = $request['bundle_post'] ? implode("; ", $request['bundle_post']) : null;
            $ido_gejala = $request['ido_gejala'] ? implode(", ", $request['ido_gejala']) : null;

            $IdoHeader->bundle_post = $bundle_post;
            $IdoHeader->gejala = $ido_gejala;
            $IdoHeader->keterangan = $request['keterangan'];
            $IdoHeader->status = $request['status_ido'];
            $IdoHeader->user_update_post = auth()->user()->username;

            if ($IdoHeader->save()) {
                $berhasil = true;
            }
        }

        $ido_bundle = IdoBundle::all();
        $ido_gejala = IdoGejala::all();

        $logido = IdoHeader::with(['data_ruang_perawatan'])->where('no_registrasi', '=',  $IdoHeader['no_registrasi'])->orderBy('created_at', 'desc')->get();

        $view = view('surveilans/log_ido', compact(['logido', 'ido_bundle', 'ido_gejala']));
        $view = $view->render();

        if ($berhasil) {
            return response()->json(['view' => $view, 'pesan' => 'Data berhasil disimpan.'], 200);
        } else {
            return response()->json(['pesan' => 'Data gagal disimpan.'], 500);
        }
    }
}
