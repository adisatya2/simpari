<?php

namespace App\Http\Controllers;

use DateTime;
use App\Models\Ruangan;
use App\Models\IdoBundle;
use App\Models\IdoHeader;
use App\Models\IskBundle;
use App\Models\IskDetail;
use App\Models\VapBundle;
use App\Models\VapDetail;
use App\Models\IadpBundle;
use App\Models\IadpDetail;
use Illuminate\Http\Request;
use App\Models\PhlebitisBundle;
use App\Models\PhlebitisDetail;
use Illuminate\Contracts\Database\Eloquent\Builder;

class LaporanPPIController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ruangan = Ruangan::where('aktif', '=', 1)->orderBy('lantai', 'desc')->orderBy('kode_ruangan', 'asc')->pluck('nama_ruangan', 'kode_ruangan');
        return view('laporan_hais.index', compact(['ruangan']));
    }

    public function data_phlebitis(Request $request)
    {
        $ruangan = $request['ruangan'] ? $request['ruangan'] : '';
        $from = $request['tanggal_awal'];
        $to = $request['tanggal_akhir'];

        $phlebitis = PhlebitisDetail::with([
            'header',
            'header.data_registrasi',
            'header.data_registrasi.data_pasien'
        ])
            ->whereBetween('tanggal_observasi', [$from, $to])
            ->whereRelation(
                'header',
                'ruang_perawatan',
                'like',
                '%' . $ruangan . '%'
            )
            ->get();

        return datatables()
            ->of($phlebitis)
            ->editColumn('created_at', function ($phlebitis) {
                return date_format($phlebitis->created_at, 'Y-m-d H:i');
            })
            ->addColumn('tanggal_registrasi', function ($phlebitis) {
                return date_format(new DateTime($phlebitis->header->data_registrasi->tanggal_registrasi), 'Y-m-d');
            })
            ->addColumn('aksi', function ($phlebitis) {
                $button = '
                <div class="btn-group">
                    <button type="button" class="btn btn-secondary btn-xs  dropdown-toggle dropdown-icon" data-toggle="dropdown">
                        Select&nbsp;
                    </button>
                    <div class="dropdown-menu" role="menu">
                        <a class="dropdown-item" href="' . route('surveilans.edit', $phlebitis->header->no_registrasi) . '" target="_blank">Lihat Data Surveilans</a>
                    </div>
                </div>
                ';

                return $button;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function data_isk(Request $request)
    {
        $ruangan = $request['ruangan'] ? $request['ruangan'] : '';
        $from = $request['tanggal_awal'];
        $to = $request['tanggal_akhir'];

        $isk = IskDetail::with([
            'header',
            'header.data_registrasi',
            'header.data_registrasi.data_pasien'
        ])
            ->whereBetween('tanggal_observasi', [$from, $to])
            ->whereRelation(
                'header',
                'ruang_perawatan',
                'like',
                '%' . $ruangan . '%'
            )
            ->get();

        return datatables()
            ->of($isk)
            ->editColumn('created_at', function ($isk) {
                return date_format($isk->created_at, 'Y-m-d H:i');
            })
            ->addColumn('tanggal_registrasi', function ($isk) {
                return date_format(new DateTime($isk->header->data_registrasi->tanggal_registrasi), 'Y-m-d');
            })
            ->addColumn('aksi', function ($isk) {
                $button = '
                <div class="btn-group">
                    <button type="button" class="btn btn-secondary btn-xs  dropdown-toggle dropdown-icon" data-toggle="dropdown">
                        Select&nbsp;
                    </button>
                    <div class="dropdown-menu" role="menu">
                        <a class="dropdown-item" href="' . route('surveilans.edit', $isk->header->no_registrasi) . '" target="_blank">Lihat Data Surveilans</a>
                    </div>
                </div>
                ';

                return $button;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function data_iadp(Request $request)
    {
        $ruangan = $request['ruangan'] ? $request['ruangan'] : '';
        $from = $request['tanggal_awal'];
        $to = $request['tanggal_akhir'];

        $iadp = IadpDetail::with([
            'header',
            'header.data_registrasi',
            'header.data_registrasi.data_pasien'
        ])
            ->whereBetween('tanggal_observasi', [$from, $to])
            ->whereRelation(
                'header',
                'ruang_perawatan',
                'like',
                '%' . $ruangan . '%'
            )
            ->get();

        return datatables()
            ->of($iadp)
            ->editColumn('created_at', function ($iadp) {
                return date_format($iadp->created_at, 'Y-m-d H:i');
            })
            ->addColumn('tanggal_registrasi', function ($iadp) {
                return date_format(new DateTime($iadp->header->data_registrasi->tanggal_registrasi), 'Y-m-d');
            })
            ->addColumn('aksi', function ($iadp) {
                $button = '
                <div class="btn-group">
                    <button type="button" class="btn btn-secondary btn-xs  dropdown-toggle dropdown-icon" data-toggle="dropdown">
                        Select&nbsp;
                    </button>
                    <div class="dropdown-menu" role="menu">
                        <a class="dropdown-item" href="' . route('surveilans.edit', $iadp->header->no_registrasi) . '" target="_blank">Lihat Data Surveilans</a>
                    </div>
                </div>
                ';

                return $button;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function data_vap(Request $request)
    {
        $ruangan = $request['ruangan'] ? $request['ruangan'] : '';
        $from = $request['tanggal_awal'];
        $to = $request['tanggal_akhir'];

        $vap = VapDetail::with([
            'header',
            'header.data_registrasi',
            'header.data_registrasi.data_pasien'
        ])
            ->whereBetween('tanggal_observasi', [$from, $to])
            ->whereRelation(
                'header',
                'ruang_perawatan',
                'like',
                '%' . $ruangan . '%'
            )
            ->get();

        return datatables()
            ->of($vap)
            ->editColumn('created_at', function ($vap) {
                return date_format($vap->created_at, 'Y-m-d H:i');
            })
            ->addColumn('tanggal_registrasi', function ($vap) {
                return date_format(new DateTime($vap->header->data_registrasi->tanggal_registrasi), 'Y-m-d');
            })
            ->addColumn('aksi', function ($vap) {
                $button = '
                <div class="btn-group">
                    <button type="button" class="btn btn-secondary btn-xs  dropdown-toggle dropdown-icon" data-toggle="dropdown">
                        Select&nbsp;
                    </button>
                    <div class="dropdown-menu" role="menu">
                        <a class="dropdown-item" href="' . route('surveilans.edit', $vap->header->no_registrasi) . '" target="_blank">Lihat Data Surveilans</a>
                    </div>
                </div>
                ';

                return $button;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function data_ido(Request $request)
    {
        $ruangan = $request['ruangan'] ? $request['ruangan'] : '';
        $from = $request['tanggal_awal'] ? $request['tanggal_awal'] . ' 00:00:00' : '';
        $to = $request['tanggal_akhir'] ? $request['tanggal_akhir'] . ' 23:59:59' : '';

        $ido = IdoHeader::with([
            'data_registrasi',
            'data_registrasi.data_pasien'
        ])
            ->whereNotNull('ruang_perawatan')
            ->where('ruang_perawatan', 'like', '%' . $ruangan . '%')
            ->whereBetween('created_at', [$from, $to])
            ->get();

        return datatables()
            ->of($ido)
            ->editColumn('created_at', function ($ido) {
                return date_format($ido->created_at, 'Y-m-d H:i');
            })
            ->addColumn('tanggal_registrasi', function ($ido) {
                return date_format(new DateTime($ido->data_registrasi->tanggal_registrasi), 'Y-m-d');
            })
            ->addColumn('aksi', function ($ido) {
                $button = '
                <div class="btn-group">
                    <button type="button" class="btn btn-secondary btn-xs  dropdown-toggle dropdown-icon" data-toggle="dropdown">
                        Select&nbsp;
                    </button>
                    <div class="dropdown-menu" role="menu">
                        <a class="dropdown-item" href="' . route('surveilans.edit', $ido->no_registrasi) . '" target="_blank">Lihat Data Surveilans</a>
                    </div>
                </div>
                ';

                return $button;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function count(Request $request)
    {
        $ruangan = $request['ruangan'] ? $request['ruangan'] : '';
        $from = $request['tanggal_awal'];
        $to = $request['tanggal_akhir'];
        $from2 = $request['tanggal_awal'] ? $request['tanggal_awal'] . ' 00:00:00' : '';
        $to2 = $request['tanggal_akhir'] ? $request['tanggal_akhir'] . ' 23:59:59' : '';

        $data = [
            'Phlebitis' => PhlebitisDetail::with(['header'])
                ->selectRaw('status, count(*) as total')
                ->whereBetween('tanggal_observasi', [$from, $to])
                ->whereRelation('header', 'ruang_perawatan', 'like', '%' . $ruangan . '%')
                ->groupBy('status')
                ->pluck('total', 'status'),
            'ISK' => IskDetail::with(['header'])
                ->selectRaw('status, count(*) as total')
                ->whereBetween('tanggal_observasi', [$from, $to])
                ->whereRelation('header', 'ruang_perawatan', 'like', '%' . $ruangan . '%')
                ->groupBy('status')
                ->pluck('total', 'status'),
            'IADP' => IadpDetail::with(['header'])
                ->selectRaw('status, count(*) as total')
                ->whereBetween('tanggal_observasi', [$from, $to])
                ->whereRelation('header', 'ruang_perawatan', 'like', '%' . $ruangan . '%')
                ->groupBy('status')
                ->pluck('total', 'status'),
            'VAP' => VapDetail::with(['header'])
                ->selectRaw('status, count(*) as total')
                ->whereBetween('tanggal_observasi', [$from, $to])
                ->whereRelation('header', 'ruang_perawatan', 'like', '%' . $ruangan . '%')
                ->groupBy('status')
                ->pluck('total', 'status'),
            'IDO' => IdoHeader::selectRaw('status, count(*) as total')
                ->whereNotNull('ruang_perawatan')
                ->where('ruang_perawatan', 'like', '%' . $ruangan . '%')
                ->whereBetween('created_at', [$from2, $to2])
                ->groupBy('status')
                ->pluck('total', 'status'),
        ];

        return $data;
    }

    public function count_bundle(Request $request)
    {
        $ruangan = $request['ruangan'] ? $request['ruangan'] : '';
        $from = $request['tanggal_awal'];
        $to = $request['tanggal_akhir'];
        $from2 = $request['tanggal_awal'] ? $request['tanggal_awal'] . ' 00:00:00' : '';
        $to2 = $request['tanggal_akhir'] ? $request['tanggal_akhir'] . ' 23:59:59' : '';

        $data = [];
        $total = [];
        $bundle = [];

        if ($request['hais'] == "phlebitis") {
            $phlebitis_bundle = PhlebitisBundle::pluck('bundle', 'id');
            $total = PhlebitisDetail::whereBetween('tanggal_observasi', [$from, $to])
                ->whereRelation('header', 'ruang_perawatan', 'like', '%' . $ruangan . '%')
                ->count();
            foreach ($phlebitis_bundle as $key => $item) {
                $count = PhlebitisDetail::where('bundle', 'like', '%' . $item . '%')
                    ->whereBetween('tanggal_observasi', [$from, $to])
                    ->whereRelation('header', 'ruang_perawatan', 'like', '%' . $ruangan . '%')
                    ->count();
                $bundle += [$item => $count];
            }
            $data = [
                'total' => $total,
                'bundle' => $bundle,
            ];

            return $data;
        }
        if ($request['hais'] == "isk") {
            $isk_bundle = IskBundle::pluck('bundle', 'id');
            $total = IskDetail::whereBetween('tanggal_observasi', [$from, $to])
                ->whereRelation('header', 'ruang_perawatan', 'like', '%' . $ruangan . '%')
                ->count();
            foreach ($isk_bundle as $key => $item) {
                $count = IskDetail::where('bundle', 'like', '%' . $item . '%')
                    ->whereBetween('tanggal_observasi', [$from, $to])
                    ->whereRelation('header', 'ruang_perawatan', 'like', '%' . $ruangan . '%')
                    ->count();
                $bundle += [$item => $count];
            }
            $data = [
                'total' => $total,
                'bundle' => $bundle,
            ];

            return $data;
        }
        if ($request['hais'] == "iadp") {
            $iadp_bundle = IadpBundle::pluck('bundle', 'id');
            $total = IadpDetail::whereBetween('tanggal_observasi', [$from, $to])
                ->whereRelation('header', 'ruang_perawatan', 'like', '%' . $ruangan . '%')
                ->count();
            foreach ($iadp_bundle as $key => $item) {
                $count = IadpDetail::where('bundle', 'like', '%' . $item . '%')
                    ->whereBetween('tanggal_observasi', [$from, $to])
                    ->whereRelation('header', 'ruang_perawatan', 'like', '%' . $ruangan . '%')
                    ->count();
                $bundle += [$item => $count];
            }
            $data = [
                'total' => $total,
                'bundle' => $bundle,
            ];

            return $data;
        }
        if ($request['hais'] == "vap") {
            $vap_bundle = VapBundle::pluck('bundle', 'id');
            $total = VapDetail::whereBetween('tanggal_observasi', [$from, $to])
                ->whereRelation('header', 'ruang_perawatan', 'like', '%' . $ruangan . '%')
                ->count();
            foreach ($vap_bundle as $key => $item) {
                $count = VapDetail::where('bundle', 'like', '%' . $item . '%')
                    ->whereBetween('tanggal_observasi', [$from, $to])
                    ->whereRelation('header', 'ruang_perawatan', 'like', '%' . $ruangan . '%')
                    ->count();
                $bundle += [$item => $count];
            }
            $data = [
                'total' => $total,
                'bundle' => $bundle,
            ];

            return $data;
        }
        if ($request['hais'] == "ido") {
            $ido_bundle = IdoBundle::all();
            $pre = [];
            $intra = [];
            $post = [];
            foreach ($ido_bundle as $item) {
                if ($item->waktu == 'Pre Operasi') {
                    $count = IdoHeader::where('bundle_pre', 'like', '%' . $item->bundle . '%')
                        ->whereNotNull('ruang_perawatan')
                        ->where('ruang_perawatan', 'like', '%' . $ruangan . '%')
                        ->whereBetween('created_at', [$from2, $to2])
                        ->count();
                    $pre += [$item->bundle => $count];
                }

                if ($item->waktu == 'Intra Operasi') {
                    $count = IdoHeader::where('bundle_intra', 'like', '%' . $item->bundle . '%')
                        ->whereNotNull('ruang_perawatan')
                        ->where('ruang_perawatan', 'like', '%' . $ruangan . '%')
                        ->whereBetween('created_at', [$from2, $to2])
                        ->count();
                    $intra += [$item->bundle => $count];
                }

                if ($item->waktu == 'Post Operasi') {
                    $count = IdoHeader::where('bundle_post', 'like', '%' . $item->bundle . '%')
                        ->whereNotNull('ruang_perawatan')
                        ->where('ruang_perawatan', 'like', '%' . $ruangan . '%')
                        ->whereBetween('created_at', [$from2, $to2])
                        ->count();
                    $post += [$item->bundle => $count];
                }
            }
            $data += ['Pre Operasi' => $pre];
            $data += ['Intra Operasi' => $intra];
            $data += ['Post Operasi' => $post];

            return $data;
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [];

        $phlebitis = [];
        $phlebitis_bundle = PhlebitisBundle::pluck('bundle', 'id');
        foreach ($phlebitis_bundle as $key => $item) {
            $count = PhlebitisDetail::where('bundle', 'like', '%' . $item . '%')->count();
            $phlebitis += [$item => $count];
        }
        $data += ['phlebitis' => $phlebitis];

        $isk = [];
        $isk_bundle = IskBundle::pluck('bundle', 'id');
        foreach ($isk_bundle as $key => $item) {
            $count = IskDetail::where('bundle', 'like', '%' . $item . '%')->count();
            $isk += [$item => $count];
        }
        $data += ['isk' => $isk];

        $iadp = [];
        $iadp_bundle = IadpBundle::pluck('bundle', 'id');
        foreach ($iadp_bundle as $key => $item) {
            $count = IadpDetail::where('bundle', 'like', '%' . $item . '%')->count();
            $iadp += [$item => $count];
        }
        $data += ['iadp' => $iadp];

        $vap = [];
        $vap_bundle = VapBundle::pluck('bundle', 'id');
        foreach ($vap_bundle as $key => $item) {
            $count = VapDetail::where('bundle', 'like', '%' . $item . '%')->count();
            $vap += [$item => $count];
        }
        $data += ['vap' => $vap];

        $ido = [];
        $ido_bundle = IdoBundle::all();
        $pre = [];
        $intra = [];
        $post = [];
        foreach ($ido_bundle as $item) {
            if ($item->waktu == 'Pre Operasi') {
                $count = IdoHeader::where('bundle_pre', 'like', '%' . $item->bundle . '%')->count();
                $pre += [$item->bundle => $count];
            }

            if ($item->waktu == 'Intra Operasi') {
                $count = IdoHeader::where('bundle_intra', 'like', '%' . $item->bundle . '%')->count();
                $intra += [$item->bundle => $count];
            }

            if ($item->waktu == 'Post Operasi') {
                $count = IdoHeader::where('bundle_post', 'like', '%' . $item->bundle . '%')->count();
                $post += [$item->bundle => $count];
            }
        }
        $ido += ['Pre Operasi' => $pre];
        $ido += ['Intra Operasi' => $intra];
        $ido += ['Post Operasi' => $post];
        $data += ['ido' => $ido];


        return $data;
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
