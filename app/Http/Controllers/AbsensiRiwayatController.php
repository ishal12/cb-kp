<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Absensi;
use App\Absensi_has_karyawan;
use App\Karyawan;

class AbsensiRiwayatController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('hrd.absnRiwayat.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('hrd.absnRiwayat.create');
    }

    public function cekStatus($b, $t, $status, $karyawan)
    {
        $db = DB::table('absensi_has_karyawans')
            ->join('absensis', 'absensi_has_karyawans.absensi_id', '=', 'absensis.id')
            ->join('karyawans', 'absensi_has_karyawans.karyawan_id', '=', 'karyawans.id')
            ->select('karyawans.*')
            ->where('absensis.hari_libur_id', '=', null)
            ->where('absensi_has_karyawans.status', '=', $status)
            ->where('karyawans.id', '=', $karyawan)
            ->whereMonth('absensis.tanggal', '=', $b)
            ->whereYear('absensis.tanggal', '=', $t)
            ->count('absensi_has_karyawans.status');
        return $db;
    }

    public function cekCuti($b, $t, $jenis, $karyawan)
    {
        $db = DB::table('cuti_tanggals')
            ->join('jenis_cutis', 'cuti_tanggals.cuti_jenis_cuti_id', '=', 'jenis_cutis.id')
            ->join('cutis', 'cuti_tanggals.cuti_id', '=', 'cutis.id')
            ->select('cuti_tanggals.*')
            ->where('cutis.status', '=', '1')
            ->where('jenis_cutis.kategori', '=', $jenis)
            ->where('cuti_tanggals.status', '=', '1')
            ->where('cutis.karyawan_id', '=', $karyawan)
            ->whereMonth('cuti_tanggals.tanggal', '=', $b)
            ->whereYear('cuti_tanggals.tanggal', '=', $t)
            ->count('cuti_tanggals.status');
        return $db;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) //MASIH BINGUNG BIAR BISA COUNT PER KARYAWAN PADA PERIODE TERTENTU
    {
        
        $tahun = $request->tahun;
        $bulan = $request->bulan;

        $kar = Karyawan::all();
        // $coba = array();
        $ar = array();
        foreach ($kar as $k) {
            $ar[] = [
                'nik'=>$k->id,
                'nama'=>$k->nama, 
                'masuk'=>$this->cekStatus($bulan, $tahun, '1', $k->id),
                'alfa'=>$this->cekStatus($bulan, $tahun, '0', $k->id),
                'sakit'=>$this->cekStatus($bulan, $tahun, '3', $k->id),
                'izin'=>$this->cekCuti($bulan, $tahun, '0', $k->id),
                'cuti'=>$this->cekCuti($bulan, $tahun, '1', $k->id),
            ];
            // $kry = new DataKaryawan();
            // $kry->nik   = $k->id;
            // $kry->nama  = $k->nama;
            // $kry->masuk = $this->cekStatus($bulan, $tahun, '1', $k->id);
            // $kry->alfa  = $this->cekStatus($bulan, $tahun, '0', $k->id);
            // $kry->sakit = $this->cekStatus($bulan, $tahun, '3', $k->id);
            // $kry->izin  = $this->cekCuti($bulan, $tahun, '0', $k->id);
            // $kry->cuti  = $this->cekCuti($bulan, $tahun, '1', $k->id);
            // $coba = array_push($kry);
        }
        // dd($ar[0]['nik']);

        return view('hrd.absnRiwayat.index', compact(
            'ar', $ar
        ));

        // $kalenders = Absensi::whereMonth('tanggal', '=', $bulan)
        //     ->whereYear('tanggal', '=', $tahun)
        //     ->where('hari_libur_id', '=', null)->get();
        // $ar = array();
        // foreach ($kalenders as $k) {
        //     foreach ($k->absensi_has_karyawan as $a) {
        //         if($a->status == '1')
        //             $ar[$a->karyawan_id][] = $a;
        //     }
        // }
        // dd($ar);
        // $karyawans = Karyawan::all();
        // $kars = array();
        // $masuk = 0;
        // foreach ($karyawans as $k) {
        //     foreach ($ar as $a) {
        //         dd($a );
        //         if($a->status == '1'){
        //             $masuk++;
        //         }
        //     }
        //     $kars[$a->id][] = array('masuk'=> $masuk);
        //     $masuk = 0;

        // }
        
        // dd($kars);
        // $kalenders = Karyawan::with(['absensi' => function ($x){
        //     $x->whereYear('tanggal', '=', $tahun)
        //     ->where('hari_libur_id', '=', null);
        // }])('tanggal', '=', $bulan)
        //     ->whereYear('tanggal', '=', $tahun)
        //     ->where('hari_libur_id', '=', null)->get();

        // $result = array();
        // foreach ($variable as $key => $value) {
        //     # code...
        // }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

class DataKaryawan
{
    public $nik;
    public $nama;
    public $masuk;
    public $alfa;
    public $sakit;
    public $izin;
    public $cuti;
}
