<?php

namespace App\Http\Controllers;

use App\Models\Bed;
use App\Models\Agama;
use App\Models\Kelas;
use App\Models\Dokter;
use App\Models\Ruangan;
use Illuminate\Support\Str;
use App\Models\MasterPasien;
use App\Models\PasienPulang;
use Illuminate\Http\Request;
use App\Models\Registrasirwi;

class PasienDirawatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ruangan = Ruangan::where('aktif', '=', 1)->orderBy('lantai', 'desc')->orderBy('kode_ruangan', 'asc')->pluck('nama_ruangan', 'kode_ruangan');
        $agama = Agama::all()->pluck('nama_agama', 'id');
        $dokter = Dokter::orderBy('nama_dokter', 'asc')->pluck('nama_dokter', 'id_dokter');
        $kelas = Kelas::all()->pluck('nama_kelas', 'id');

        return view('pasien_dirawat.index', compact(['ruangan', 'agama', 'dokter', 'kelas']));
    }

    public function data(Request $request)
    {
        $ruangan = $request['ruangan'] ? $request['ruangan'] : '';

        $bed_ruangan = Bed::with(['ruangan_bed', 'kelas_bed', 'dpjp', 'data_pasien', 'data_registrasi'])->where('aktif', '=', 1)->where('kode_ruangan', 'like', '%' . $ruangan . '%')->orderBy('no_kamar', 'asc')->get();

        return datatables()
            ->of($bed_ruangan)
            ->addColumn('los', function ($bed_ruangan) {
                if ($bed_ruangan->dpjp) {
                    $selisih = selisih_hari($bed_ruangan->tanggal_masuk, date("Y-m-d")) + 1;
                    $button = '';

                    if ($selisih > 3) {
                        $button = '<button data-los="' . $selisih . '" class="btn btn-flat btn-danger w-100 p-2">' . $selisih . '</button>';
                    } elseif ($selisih == 1) {
                        $button = '<button data-los="' . $selisih . '" class="btn btn-flat btn-info w-100 p-2">' . $selisih . '</button>';
                    } else {
                        $button = '<button data-los="' . $selisih . '" class="btn btn-flat btn-warning w-100 p-2">' . $selisih . '</button>';
                    }
                    return $button;
                } else {
                    return '';
                }
            })
            ->addColumn('no_kamar2', function ($bed_ruangan) {
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
            ->addColumn('nama_dokter', function ($bed_ruangan) {
                if ($bed_ruangan->dpjp) {
                    return $bed_ruangan->dpjp->nama_dokter;
                } else {
                    return '';
                }
            })
            ->addColumn('nama_jaminan', function ($bed_ruangan) {
                if ($bed_ruangan->data_registrasi) {
                    return $bed_ruangan->data_registrasi->nama_jaminan;
                } else {
                    return '';
                }
            })
            ->addColumn('tanggal_lahir', function ($bed_ruangan) {
                if ($bed_ruangan->data_pasien) {
                    return tanggal_indonesia($bed_ruangan->data_pasien->tanggal_lahir, false);
                } else {
                    return '';
                }
            })
            ->addColumn('umur', function ($bed_ruangan) {
                if ($bed_ruangan->data_pasien) {
                    return hitung_umur($bed_ruangan->data_pasien->tanggal_lahir);
                } else {
                    return '';
                }
            })
            ->addColumn('nik', function ($bed_ruangan) {
                if ($bed_ruangan->data_pasien) {
                    return $bed_ruangan->data_pasien->nik;
                } else {
                    return '';
                }
            })
            ->addColumn('gender', function ($bed_ruangan) {
                if ($bed_ruangan->data_pasien) {
                    return $bed_ruangan->data_pasien->jk;
                } else {
                    return '';
                }
            })
            ->addColumn('agama', function ($bed_ruangan) {
                if ($bed_ruangan->data_pasien) {
                    return $bed_ruangan->data_pasien->agama;
                } else {
                    return '';
                }
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
                if ($bed_ruangan->mrn != null) {
                    $button .= '
                    <a class="dropdown-item" onclick="detailPasien(`' . route('pasien.show', $bed_ruangan->mrn) . '`)">Detail Pasien</a>
                    <a class="dropdown-item" onclick="pulangForm(`' . route('pasiendirawat.edit', $bed_ruangan->no_kamar) . '`)">Pulangkan Pasien</a>
                    <a class="dropdown-item" onclick="pindahForm(`' . route('pasiendirawat.edit', $bed_ruangan->no_kamar) . '`)">Pindah Kamar</a>
                    <a class="dropdown-item" href="' . route('surveilans.edit', $bed_ruangan->no_registrasi) . '">Surveilans</a>
                    <a class="dropdown-item">Gizi</a>
                    <a class="dropdown-item" href="' . url('master/pasien/cetak-barcode/' . $bed_ruangan->mrn)  . '" target="_blank">Cetak Barcode</a>
                    ';
                } else {
                    $button .= '
                    <a class="dropdown-item" onclick="registrasiForm(`' . route('pasiendirawat.registrasi', $bed_ruangan->no_kamar) . '`,\'' . $bed_ruangan->no_kamar . '\')">Registrasi Pasien</a>
                    ';
                }


                $button .= '
                    <a class="dropdown-item" onclick="editForm(`' . route('pasiendirawat.show', $bed_ruangan->no_kamar) . '`)">Edit</a>
                    </div>
                </div>
                ';

                return $button;
            })
            ->rawColumns(['aksi', 'no_kamar2', 'dokter', 'los'])
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
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // $bed_ruangan = Bed::with(['ruangan_bed', 'kelas_bed', 'dpjp', 'data_pasien'])->where('aktif', '=', 1)->where('no_kamar', 'like', '%' . $id . '%')->orderBy('no_kamar', 'asc')->get();
        $bed_ruangan = Bed::with(['ruangan_bed', 'kelas_bed', 'dpjp', 'data_pasien', 'data_registrasi'])->where('no_kamar', 'like', '%' . $id . '%')->first();

        return response()->json($bed_ruangan, 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $no_kamar)
    {
        $data['bed_ruangan'] = Bed::with(['ruangan_bed', 'kelas_bed', 'dpjp', 'data_pasien', 'data_registrasi'])->where('no_kamar', 'like', '%' . $no_kamar . '%')->first();
        $data['bed_kosong'] = Bed::where('aktif', '=', 1)->whereNull('no_registrasi')->whereNull('mrn')->orderBy('no_kamar', 'asc')->get();

        return response()->json($data, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $bed = Bed::findOrFail($id);

        $request['user_edit'] = auth()->user()->username;

        $bed->diagnosa = $request['diagnosa'];
        $bed->id_dokter = $request['id_dokter'];
        // $bed->jenis_jaminan = $request['jenis_jaminan'];
        // $bed->nama_jaminan = $request['nama_jaminan'];
        $bed->hak_pasien = $request['hak_pasien'];
        $bed->bed_hinai = $request['bed_hinai'];
        $bed->tanggal_masuk = $request['tanggal_masuk'];
        $bed->keterangan_fo = $request['keterangan_fo'];
        $bed->keterangan_perawat = $request['keterangan_perawat'];
        $bed->user_edit = auth()->user()->username;

        $bed->save();

        if ($request['mrn']) {
            $pasien = MasterPasien::updateOrCreate(
                [
                    'mrn' => $request['mrn']
                ],
                [
                    'nik' => $request['nik'],
                    'nama_pasien' => $request['nama_pasien'],
                    'tempat_lahir' => $request['tempat_lahir'],
                    'tanggal_lahir' => $request['tanggal_lahir'],
                    'jk' => $request['jk'],
                    'no_telp' => $request['no_telp'],
                    'alamat' => $request['alamat'],
                    'agama' => $request['agama'],
                ]
            );
        }

        if ($request['no_registrasi']) {
            $registrasirwi = Registrasirwi::findOrFail($bed->no_registrasi);
            $registrasirwi->update([
                'diagnosa' => $request['diagnosa'],
                'jenis_jaminan' => $request['jenis_jaminan'],
                'nama_jaminan' => $request['nama_jaminan'],
            ]);
        }

        return response()->json(['pesan' => 'Data berhasil diedit'], 200);
    }

    public function registrasi(Request $request, string $id)
    {
        $noregistrasi = 'IP' . date("ymdHis") . rand(1, 99);

        $cek = Bed::where('mrn', '=', $request['mrn'])->first();

        if ($cek) {
            return response()->json('MRN tersebut sudah terdaftar', 422);
        } else {
            $kamar = Bed::find($id);

            $kamar->no_registrasi = $noregistrasi;
            $kamar->mrn = $request['mrn'];
            $kamar->nama_pasien = $request['nama_pasien'];
            $kamar->diagnosa = $request['diagnosa'];
            $kamar->id_dokter = $request['id_dokter'];
            // $kamar->jenis_jaminan = $request['jenis_jaminan'];
            // $kamar->nama_jaminan = $request['nama_jaminan'];
            $kamar->hak_pasien = $request['hak_pasien'];
            $kamar->bed_hinai = $request['bed_hinai'];
            $kamar->tanggal_masuk = $request['tanggal_masuk'];
            $kamar->keterangan_fo = $request['keterangan_fo'];
            $kamar->keterangan_perawat = $request['keterangan_perawat'];
            $kamar->user_input = auth()->user()->username;

            $pasien = MasterPasien::updateOrCreate(
                [
                    'mrn' => $request['mrn']
                ],
                [
                    'nik' => $request['nik'],
                    'nama_pasien' => $request['nama_pasien'],
                    'tempat_lahir' => $request['tempat_lahir'],
                    'tanggal_lahir' => $request['tanggal_lahir'],
                    'jk' => $request['jk'],
                    'no_telp' => $request['no_telp'],
                    'alamat' => $request['alamat'],
                    'agama' => $request['agama'],
                ]
            );

            $registrasi = Registrasirwi::create([
                'no_registrasi' => $noregistrasi,
                'tanggal_registrasi' => $request['tanggal_masuk'],
                'mrn' => $request['mrn'],
                'umur' => hitung_umur($request['tanggal_lahir']),
                'no_kamar' => $id,
                'kode_ruangan' => $kamar->kode_ruangan,
                'id_dokter' => $request['id_dokter'],
                'diagnosa' => $request['diagnosa'],
                'jenis_jaminan' => $request['jenis_jaminan'],
                'nama_jaminan' => $request['nama_jaminan'],
                'user' => auth()->user()->username,
            ]);

            $kamar->save();

            return response()->json(['pesan' => 'Data pasien berhasil disimpan'], 200);
        }
    }

    public function pindah(Request $request, string $id)
    {
        $kamar_lama = Bed::find($id);
        $kamar_baru = Bed::find($request['no_kamar_baru']);
        // $kamar_baru = Bed::with(['ruangan_bed', 'kelas_bed'])->where('no_kamar', '=',  $request['no_kamar_baru'])->first();
        $registrasirwi = Registrasirwi::findOrFail($kamar_lama->no_registrasi);

        $kamar_baru->no_registrasi = $kamar_lama->no_registrasi;
        $kamar_baru->mrn = $request['mrn'];
        $kamar_baru->nama_pasien = $request['nama_pasien'];
        $kamar_baru->diagnosa = $request['diagnosa'];
        $kamar_baru->id_dokter = $request['id_dokter'];
        // $kamar_baru->jenis_jaminan = $request['jenis_jaminan'];
        // $kamar_baru->nama_jaminan = $request['nama_jaminan'];
        $kamar_baru->hak_pasien = $request['hak_pasien'];
        $kamar_baru->bed_hinai = $request['bed_hinai'];
        $kamar_baru->tanggal_masuk = $request['tanggal_masuk'];
        $kamar_baru->tanggal_pindah = date('Y-m-d H:i:s');
        $kamar_baru->user_input = $kamar_lama->user_input;
        $kamar_baru->user_pindah = auth()->user()->username;

        $kamar_lama->no_registrasi = null;
        $kamar_lama->mrn = null;
        $kamar_lama->nama_pasien = null;
        $kamar_lama->diagnosa = null;
        $kamar_lama->id_dokter = null;
        // $kamar_lama->jenis_jaminan = null;
        // $kamar_lama->nama_jaminan = null;
        $kamar_lama->hak_pasien = null;
        $kamar_lama->bed_hinai = null;
        $kamar_lama->tanggal_masuk = null;
        if ($kamar_lama->keterangan_fo != $request['keterangan_fo'] || $kamar_lama->keterangan_perawat != $request['keterangan_perawat']) {
            $kamar_lama->keterangan_fo = $request['keterangan_fo'];
            $kamar_lama->keterangan_perawat = $request['keterangan_perawat'];
            $kamar_lama->user_edit = auth()->user()->username;
        }

        $kamar_baru->save();
        $kamar_lama->save();
        $registrasirwi->update([
            'no_kamar' => $request['no_kamar_baru'],
            'diagnosa' => $request['diagnosa'],
            'jenis_jaminan' => $request['jenis_jaminan'],
            'nama_jaminan' => $request['nama_jaminan'],
            'kode_ruangan' => $kamar_baru->kode_ruangan,
        ]);

        return response()->json(['pesan' => 'Pasien' . $request['nama_pasien'] . ' berhasil dipindahkan ke kamar ' . $request['no_kamar_baru']], 200);
    }

    public function pulang(Request $request, string $id)
    {
        $kamar_lama = Bed::find($id);

        $request['id_kelas'] = $kamar_lama->id_kelas;
        $request['no_registrasi'] = $kamar_lama->no_registrasi;
        $request['tanggal_pindah'] = $kamar_lama->tanggal_pindah;
        $request['no_registrasi'] = $kamar_lama->no_registrasi;
        $request['user_input'] = $kamar_lama->user_input;
        $request['user_pindah'] = $kamar_lama->user_pindah;
        $request['user_pulang'] = auth()->user()->username;

        $pulang = PasienPulang::create($request->all());

        if ($pulang) {
            $kamar_lama->no_registrasi = null;
            $kamar_lama->mrn = null;
            $kamar_lama->nama_pasien = null;
            $kamar_lama->diagnosa = null;
            $kamar_lama->id_dokter = null;
            // $kamar_lama->jenis_jaminan = null;
            // $kamar_lama->nama_jaminan = null;
            $kamar_lama->hak_pasien = null;
            $kamar_lama->bed_hinai = null;
            $kamar_lama->tanggal_masuk = null;
            $kamar_lama->tanggal_pindah = null;
            $kamar_lama->user_input = null;
            $kamar_lama->user_pindah = null;

            $kamar_lama->save();

            $registrasirwi = Registrasirwi::findOrFail($request['no_registrasi']);

            $registrasirwi->update(['tanggal_pulang' => $request['tanggal_pulang']]);
        }

        return response()->json(['pesan' => 'Pasien' . $request['nama_pasien'] . ' berhasil dipulangkan.'], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        //
    }

    public function count_bor(Request $request)
    {
        $ruangan = $request['ruangan'] ? $request['ruangan'] : '';

        $total_bed = Bed::with(['ruangan_bed', 'kelas_bed', 'dpjp', 'data_pasien'])->where('aktif', '=', 1)->where('flagbor', '=', 1)->where('kode_ruangan', 'like', '%' . $ruangan . '%')->orderBy('no_kamar', 'asc')->count();

        $total_pasien = Bed::with(['ruangan_bed', 'kelas_bed', 'dpjp', 'data_pasien'])->where('aktif', '=', 1)->whereNotNull('no_registrasi')->where('kode_ruangan', 'like', '%' . $ruangan . '%')->orderBy('no_kamar', 'asc')->count();

        $bed_kosong = Bed::with(['ruangan_bed', 'kelas_bed', 'dpjp', 'data_pasien'])->where('aktif', '=', 1)->whereNull('no_registrasi')->where('kode_ruangan', 'like', '%' . $ruangan . '%')->orderBy('no_kamar', 'asc')->count();

        $lebih3h = Bed::selectRaw('(datediff(now(), tanggal_masuk)+1) as los')->whereNotNull('no_registrasi')->whereRaw('(datediff(now(), tanggal_masuk)+1) > ?', 3)->where('kode_ruangan', 'like', '%' . $ruangan . '%')->orderBy('no_kamar', 'asc')->count();

        $kurang3h = Bed::selectRaw('(datediff(now(), tanggal_masuk)+1) as los')->whereNotNull('no_registrasi')->whereRaw('(datediff(now(), tanggal_masuk)+1) <= ?', 3)->where('kode_ruangan', 'like', '%' . $ruangan . '%')->orderBy('no_kamar', 'asc')->count();

        //$bor = ($total_pasien / $total_bed) * 100;
        $bor = number_format((($total_pasien / $total_bed) * 100), 2, ',', '.');

        return response()->json(['total_bed' => $total_bed, 'total_pasien' => $total_pasien, 'bed_kosong' => $bed_kosong, 'bor' => $bor, 'lebih3h' => $lebih3h, 'kurang3h' => $kurang3h], 200);
    }
}
