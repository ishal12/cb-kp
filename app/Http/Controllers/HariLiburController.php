<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Hari_libur;
use App\Absensi;

class HariLiburController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $liburs = Hari_libur::all();
        return view('hrd.hariLibur.index', compact(
            'liburs', $liburs
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('hrd.hariLibur.create');
    }

    public function cekCuti($awal, $akhir)
    {
        $aw = date_create($awal);
        $ak = date_create($akhir);

        $x = date_format($aw, 'z');
        $y = date_format($ak, 'z');

        $count = $y-$x;

        $hasil = array();
        for ($i=0; $i <= $count; $i++) { 
            
            if(date_format($aw, 'l') == 'Sunday'){
                $count--;
                $i--;
            }else{
                $hasil[$i] = date_format($aw, 'Y-m-d');
            }
            $aw->modify('+1 day');  
        }
        return count($hasil);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $nama = $request->nama;
        $tAwal = $request->tAwal;
        $tAkhir = $request->tAkhir;
        $jenis = $request->jLibur;

        $this->validate($request, [
            'nama' =>'required',
            'tAwal' =>'required',
            'tAkhir' =>'required',
        ]);

        $aw = date_create($tAwal);
        $ak = date_create($tAkhir);

        if(date_format($aw, 'z') > date_format($ak, 'z')){
            session()->flash('error', 'Tanggal awal tidak boleh lebih kecil dari Tanggal akhir.');
            return redirect()->route('hariLibur.create');
        }

        $count = date_format($ak, 'z') - date_format($aw, 'z') + 1;

        $cekKalender = Absensi::whereYear('tanggal', '=', date_format($aw, 'Y'))
            ->whereMonth('tanggal', '=', date_format($aw, 'm'))->get();
        
        $hariLibur = new Hari_libur;
        $hariLibur->nama = $nama;
        $hariLibur->tgl_awal = $tAwal;
        $hariLibur->tgl_akhir = $tAkhir;
        $hariLibur->jenis = $jenis;
        $hariLibur->save();

        if($cekKalender !== null){
            $kalender = Absensi::whereYear('tanggal', '=', date_format($aw, 'Y'))
                ->whereMonth('tanggal', '=', date_format($aw, 'm'))->get();
            for($i=1; $i<=$count; $i++){
                foreach ($kalender as $k) {
                    if($k->tanggal == date_format($aw, 'Y-m-d')){
                        $update = Absensi::find($k->id);
                        $update->hari_libur_id = $hariLibur->id;
                        $update->save();
                    }
                }
                $aw->modify('+1 day');  
            }
        }

        session()->flash('success', 'Hari libur berhasil ditambahkan.');
        return redirect()->route('hariLibur.index');
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
        $libur = Hari_libur::find($id);
        return view('hrd.hariLibur.edit', compact(
            'libur', $libur
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
        $nama = $request->nama;
        $tAwal = $request->tAwal;
        $tAkhir = $request->tAkhir;
        $jenis = $request->jLibur;

        $this->validate($request, [
            'nama' =>'required',
            'tAwal' =>'required',
            'tAkhir' =>'required',
        ]);

        $aw = date_create($tAwal);
        $ak = date_create($tAkhir);

        if(date_format($aw, 'z') > date_format($ak, 'z')){
            session()->flash('error', 'Tanggal awal tidak boleh lebih kecil dari Tanggal akhir.');
            return redirect()->route('hariLibur.create');
        }

        $count = date_format($ak, 'z') - date_format($aw, 'z') + 1;

        $cekKalender = Absensi::whereYear('tanggal', '=', date_format($aw, 'Y'))
            ->whereMonth('tanggal', '=', date_format($aw, 'm'))->get();

        if($cekKalender !== null){
            $kalender = Absensi::where('hari_libur_id', '=', $id)
                ->whereYear('tanggal', '=', date_format($aw, 'Y'))
                ->whereMonth('tanggal', '=', date_format($aw, 'm'))->get();
                // dd($kalender);
                foreach ($kalender as $k) {
                    if($k->hari_libur_id == $id){
                        $update = Absensi::find($k->id);
                        $update->hari_libur_id = null;
                        $update->save();
                    }
                }
        }
        
        $hariLibur = Hari_libur::find($id);
        $hariLibur->nama = $nama;
        $hariLibur->tgl_awal = $tAwal;
        $hariLibur->tgl_akhir = $tAkhir;
        $hariLibur->jenis = $jenis;
        $hariLibur->save();

        if($cekKalender !== null){
            $kalender = Absensi::whereYear('tanggal', '=', date_format($aw, 'Y'))
                ->whereMonth('tanggal', '=', date_format($aw, 'm'))->get();
            for($i=1; $i<=$count; $i++){
                foreach ($kalender as $k) {
                    if($k->tanggal == date_format($aw, 'Y-m-d')){
                        $update = Absensi::find($k->id);
                        $update->hari_libur_id = $hariLibur->id;
                        $update->save();
                    }
                }
                $aw->modify('+1 day');  
            }
        }

        session()->flash('success', 'Hari libur berhasil ditambahkan.');
        return redirect()->route('hariLibur.index');
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
