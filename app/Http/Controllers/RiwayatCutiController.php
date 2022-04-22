<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cuti_tanggal;
use App\Jenis_cuti;

class RiwayatCutiController extends Controller
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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('hrd.riwayatCuti.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tgl = $request->tgl;
        $cutiTanggals = Cuti_tanggal::where('tanggal', '=', $tgl)->get();
        return view('hrd.riwayatCuti.index', compact(
            'cutiTanggals', $cutiTanggals,
            'tgl', $tgl
        ));
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
        $jenisCutis = Jenis_cuti::all();
        $cutiTanggal = Cuti_tanggal::find($id);

        return view('hrd.riwayatCuti.edit', compact(
            'cutiTanggal', $cutiTanggal,
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
        $ct = Cuti_tanggal::find($id);
        $ct->status = $request->status;
        $ct->keterangan = $request->ket;
        if($request->status === '1'){
            session()->flash('success', 'Anda telah berhasil merubah pengajuan cuti '.$request->nama.' pada tanggal '.$request->tCuti.' menjadi diterima');
        }
        else if($request->status === '0'){
            session()->flash('success', 'Anda telah berhasil merubah pengajuan cuti '.$request->nama.' pada tanggal '.$request->tCuti.' menjadi ditolak');
        }
        $ct->save();
        return redirect()->route('riwayatCuti.create');
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
