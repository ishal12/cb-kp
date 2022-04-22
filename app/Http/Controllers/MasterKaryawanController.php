<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Karyawan;

class MasterKaryawanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('hrd');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $karyawans = Karyawan::all();

        return view('hrd.profilKaryawan.index', compact('karyawans', $karyawans));
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
    public function edit($id)
    {
        $karyawan = Karyawan::find($id);
        return view('hrd.profilKaryawan.edit', compact($karyawan, 'karyawan'));
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
        if($request->nama === null){
            session()->flash('error', 'Nomor nama tidak boleh kosong');
            return redirect()->route('profil.index');
        }
        if($request->alamat === null){
            session()->flash('error', 'Nomor alamat tidak boleh kosong');
            return redirect()->route('profil.index');
        }
        if($request->tlp === null){
            session()->flash('error', 'Nomor telepon tidak boleh kosong');
            return redirect()->route('profil.index');
        }
        $karyawan = Karyawan::findorfail($id);
        $karyawan->nama = $request->nama;
        $karyawan->alamat = $request->alamat;
        $karyawan->kontak = $request->tlp;
        $karyawan->save();

        session()->flash('success', 'Berhasil dirubah');
        return redirect()->route('profilKaryawan.index');
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
