<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Absensi;
use App\Absensi_has_karyawan;
use App\Karyawan;
use App\Hari_libur;

class AbsensiKalenderController extends Controller
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
        // GK BISA BUAT ILANGIN
        // $xs = Absensi_has_karyawan::where('status', '=', null)
        //     ->groupBy('absensi_id')->get();
        // foreach ($xs as $x) {
        //     dd($x);
        // }

        $kalenders = Absensi::with(['absensi_has_karyawan' => function ($x){
                    $x->select('absensi_id', 'karyawan_id', 'status');
                }])
            ->where('hari_libur_id', '=', null)->get();
            // ->where('status', '=', null)->get();

        // foreach ($kalenders as $k) {
        //     dd($k);
        //     foreach ($k->absensi_has_karyawan as $a) {
        //         dd($a->status);
        //     }
            
        // }

        return view('hrd.absnKalender.index', compact(
            'kalenders', $kalenders
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('hrd.absnKalender.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $bulan = $request->bulan;
        $tahun = $request->tahun;

        $cekLibur = Hari_libur::whereYear('tgl_awal', '=', $tahun)
            ->whereMonth('tgl_awal', '=', $bulan)->first();

        $cekKalender = Absensi::whereYear('tanggal', '=', $tahun)
            ->whereMonth('tanggal', '=', $bulan)->first();
        if($cekKalender === null){
            $d = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);

            for($i=1;$i<=$d;$i++){

                $date = date_format(date_create($tahun.'-'.$bulan.'-'.$i), 'Y-m-d' );
                if(date_format(date_create($tahun.'-'.$bulan.'-'.$i), 'l') == 'Sunday'){

                }else
                {
                    $absen = new Absensi;
                    $absen->tanggal = $date;
                    if($cekLibur !== null){
                        $liburs = Hari_libur::whereYear('tgl_awal', '=', $tahun)
                            ->whereMonth('tgl_awal', '=', $bulan)->get();
                        foreach ($liburs as $l) {
                            if($l->tgl_awal <= $date && $date <= $l->tgl_akhir)
                                $absen->hari_libur_id = $l->id;
                        }
                    }
                    $absen->save();
                    $this->absensi_kalender($date, $absen);
                    
                }
                    
            }

            session()->flash('success', 'Kalender absensi pada bulan '.date('F Y', mktime(0, 0, 0, $bulan, 0, $tahun)).' telah berhasil dibuat.');
            return redirect()->route('absnKalender.index');
        }
        else
        {
            session()->flash('error', 'Maaf, kalender absensi pada bulan '.date('F Y', mktime(0, 0, 0, $bulan, 0, $tahun)).' sudah ada.');
            return redirect()->route('absnKalender.create');
        }
    }

    public function absensi_kalender($date, $absen)
    {
        $karyawan = Karyawan::all();
        foreach ($karyawan as $k) {
            $absen->karyawan()->attach($k->id, ['status'=>null]);
        }
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
        $absensis = Absensi_has_karyawan::where('absensi_id', '=', $id)->get();
        return view('hrd.absnKalender.edit', compact(
            'absensis', $absensis
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) // BELOM DIBIKIN PENGECEKAN BUAT CUTI
    {
        $nik = $request->nik;
        $status = $request->status;

        $kalender = Absensi::find($id);

        $absensi = Absensi_has_karyawan::where('absensi_id', '=', $id)
            ->where('status', '=', null)
            ->first();
        if($absensi !== null)
            $kalender->karyawan()->detach();

        for($i=0; $i<count($nik); $i++){

            $kalender->karyawan()->attach($nik[$i], ['status'=> $status[$i]]);
            $kalender->save();

        }
        
        session()->flash('success', 'Absensi pada tanggal '.date('Y F d', strtotime($kalender->tanggal)).' telah berhasil dibuat.');
        return redirect()->route('absnKalender.index');
    }

    public function semua($id)
    {
        $kalender = Absensi::find($id);

        $karyawans = Karyawan::all();

        $absensis = Absensi_has_karyawan::where('absensi_id', '=', $id)
            ->where('status', '=', null)->get();
        foreach ($absensis as $a) {
            $x = $a->karyawan_id;
            $kalender->karyawan()->attach($a->karyawan_id, ['status'=> '1']);
            $kalender->karyawan()
                ->wherePivot('absensi_id', '=', $id)
                ->wherePivot('karyawan_id', '=', $a->karyawan_id)
                ->wherePivot('status', '=', null)
                ->detach();
            $kalender->save();
        }
        
        session()->flash('success', 'Rekap absensi pada tanggal '.date('Y F d', strtotime($kalender->tanggal)).' telah berhasil dibuat.');
        return redirect()->route('absnKalender.index');
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
