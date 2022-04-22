<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jenis_cuti;
use App\Cuti;
use App\Cuti_tanggal;

class KaryawanCutiController extends Controller
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
    public function count() // HITUNG YG POTONG CUTI SAJA GIMANACARANYAA??!!!??!
    {
        $cutis = Cuti::where('karyawan_id', '=', auth()->user()->karyawan_id)
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

        // return Cuti_tanggal::where('cuti_karyawan_id', '=', auth()->user()->karyawan_id)
        //     ->where('status', '=', '1')
        //     ->whereYear('tanggal', '=', date('Y'))->count();
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

    public function index()
    {
        $cutis = Cuti::where('karyawan_id', '=', auth()->user()->karyawan_id)
            ->whereYear('tgl_pengajuan', '=', date('Y'))->get();
        $sisaCuti = 12 - $this->count();
        $cutiTanggals = Cuti_tanggal::where('cuti_karyawan_id', '=', auth()->user()->karyawan_id)
            ->where('status', '=', '1')
            ->whereYear('tanggal', '=', date('Y'))->get();
        return view('karyawan.cuti.index', compact(
            'cutis', $cutis,
            'count', $sisaCuti,
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
        $jenisCutis = Jenis_cuti::all();
        return view('karyawan.cuti.create', compact('jenisCutis', $jenisCutis));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'ket' =>'required',
            'tAwal' =>'required',
            'tAkhir' =>'required',
        ]);

        $aw = date_create($request->tAwal);
        $ak = date_create($request->tAkhir);

        if(date_format($aw, 'z') > date_format($ak, 'z')){
            session()->flash('error', 'Tanggal awal tidak boleh lebih kecil dari Tanggal akhir.');
            return redirect()->route('cuti.create');
        }

        $cutiTakar = $this->count() + $this->cekCuti($request->tAwal, $request->tAkhir);

        if(12 < $cutiTakar)
        {
            session()->flash('error', 'Maaf, Anda telah melewati batas cuti tahunan.');
            return redirect()->route('cuti.create');
        }

        $cekPending = Cuti::where('karyawan_id', '=', auth()->user()->karyawan_id)
            ->where('status', '=', '2')
            ->whereYear('tgl_pengajuan', '=', date('Y'))->count();

        if($cekPending != 0){
            session()->flash('error', 'Maaf, Anda masih memiliki pengajuan cuti yang sedang diproses.');
            return redirect()->route('cuti.create');
        }

        $batasCuti = Jenis_cuti::find($request->kategori);

        if( $this->cekCuti($request->tAwal, $request->tAkhir) > $batasCuti->limit){
            session()->flash('error', 'Maaf, Anda melebihi batas cuti yang telah ditentukan.');
            return redirect()->route('cuti.create');
        }
         // PISAH ANATA POTNG CUTI DAN TIDAK POTONG CUTI
        
        $cuti = new Cuti;
        $cuti->tgl_pengajuan = $request->tPengajuan;
        $cuti->tgl_awal = $request->tAwal;
        $cuti->tgl_akhir = $request->tAkhir;
        $cuti->keterangan = $request->ket;
        $cuti->status = '2';
        $cuti->jenis_cuti_id = $request->kategori;
        $cuti->karyawan_id = $request->nik;
        $cuti->karyawan_jabatan_id = $request->jab;
        $cuti->pimpinan_id = auth()->user()->karyawan->karyawan_id;
        $cuti->pimpinan_jabatan_id = auth()->user()->karyawan->karyawan_jabatan_id;
        $cuti->save();
        
        $this->cutiTerpakai($request->tAwal, $request->tAkhir, $cuti);

        session()->flash('success', 'Berhasil disimpan');
        return redirect()->route('cuti.index');

    }

    public function cutiTerpakai($awal, $akhir, $cuti)
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

                $cuti_tanggal = new Cuti_tanggal;
                $cuti_tanggal->cuti_id = $cuti->id;
                $cuti_tanggal->cuti_jenis_cuti_id = $cuti->jenis_cuti_id;
                $cuti_tanggal->cuti_karyawan_id = $cuti->karyawan_id;
                $cuti_tanggal->cuti_karyawan_jabatan_id = $cuti->karyawan_jabatan_id;
                $cuti_tanggal->status = '0';
                $cuti_tanggal->tanggal = date_format($aw, 'Y-m-d');

                $cuti_tanggal->save();
            }
            $aw->modify('+1 day');  
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
