<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cuti;
use App\Cuti_tanggal;
use App\Jenis_cuti;
use App\Karyawan;
use App\Absensi;

class PemberitahuanCutiController extends Controller
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
        $cutis = Cuti::where('pimpinan_id', '=', auth()->user()->karyawan->id)
            ->where('status', '=', '2')
            ->whereYear('tgl_pengajuan', '=', date('Y'))->get();
        $cutiTanggals = Cuti_tanggal::where('cuti_karyawan_id', '=', auth()->user()->karyawan_id)
            ->where('status', '=', '1')
            ->whereYear('tanggal', '=', date('Y'))->get();
        return view('pimpinan.pemberitahuanCuti.index', compact(
            'cutis', $cutis,
            'cutiTanggals', $cutiTanggals
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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

    public function count($id) // HITUNG YG POTONG CUTI SAJA GIMANACARANYAA??!!!??!
    {
        $cutis = Cuti::where('karyawan_id', '=', $id)
            ->whereYear('tgl_pengajuan', '=', date('Y'))->get();

        $x = 0;
        foreach ($cutis as $cuti) {
            if($cuti->jenis_cuti->kategori == '1'){
                $y = Cuti_tanggal::where('cuti_id', '=', $cuti->id)
                    ->where('status', '=', '1')
                    ->whereYear('tanggal', '=', date('Y'))->count();

                $x +=$y;
            }
        }

        return $x;
    }

    public function edit($id)
    {
        $cuti = Cuti::find($id);
        $sisa = 12 - $this->count($cuti->karyawan_id);
        $jenisCutis = Jenis_cuti::all();
        return view('pimpinan.pemberitahuanCuti.view', compact(
            'cuti', $cuti,
            'sisa', $sisa,
            'jenisCutis', $jenisCutis
        ));
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
        
        $cuti = Cuti::find($id);
        $cutiTanggals = Cuti_tanggal::where('cuti_id', '=', $id)->get();

        if($request->status === '1'){
            $cuti->status = '1';
            foreach ($cutiTanggals as $ct) {
                $absensi = Absensi::where('tanggal', '=', $ct->tanggal)
                    ->first();
                if($absensi->hari_libur_id === null){
                    $ct->status = '1';
                    $ct->save();
                    $absensis = Absensi_has_karyawan::where('absensi_id', '=', $ct->absensi_id)
                        ->where('karyawan_id', '=', $ct->cuti_karyawan_id)
                        ->where('status', '=', null)->first();
                    $absensi->karyawan()->attach($ct->cuti_karyawan_id, ['status'=> '2']);
                    $absensi->karyawan()
                        ->wherePivot('absensi_id', '=', $ct->cuti_id)
                        ->wherePivot('karyawan_id', '=', $ct->cuti_karyawan_id)
                        ->wherePivot('status', '=', null)
                        ->detach();
                }
                else{
                    $ct->status = '1';
                    $ct->save();
                }
            }
            session()->flash('success', 'Anda telah menerima pengajuan cuti'.$request->nama);
        }
        if($request->status === '0'){
            $cuti->status = '0';
            session()->flash('success', 'Anda telah menolak pengajuan cuti '.$request->nama);
        }
        $cuti->save();

        return redirect()->route('pemberitahuanCuti.index');
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
