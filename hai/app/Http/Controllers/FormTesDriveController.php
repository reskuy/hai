<?php

namespace App\Http\Controllers;
use App\Models\FormTesDrive;
use Illuminate\Http\Request;

class FormTesDriveController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return FormTesDrive::all();
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
        $u = new FormTesDrive;
        $u->id_aset = $request->IdAset;
        $u->id_department = $request->IdDepartment;
        $u->penanggung_jawab = $request->PenanggungJawab;
        $u->nama_customer = $request->NamaCustomer;
        $u->kondis_awal_bbm= $request->KondisiBBM;
        $u->kondisi_awal_kilometer= $request->KondisiKM;
        $u->kondisi_awal_kebersihan= $request->KondisiKebersihan;
        $u->kondisi_awal_fisik_kendaraan= $request->KondisiFisik;
        $u->lokasi_tes_drive = $request->LokasiTesDrive;
        $u->tanggal_pemakaian = $request->TanggalPemakaian;
        $u->tanggal_kembali = $request->TanggalKembali;
        $u->jam_keluar_kendaraan = null;
        $u->approve_form_tes_drive = null;
        $u->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return FormTesDrive::where('id_form_tes_drive',$id)->first();
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
