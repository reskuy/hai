<?php

namespace App\Http\Controllers;
use App\Models\FormPeminjaman;
use Illuminate\Http\Request;
use App\Models\Department;
use Illuminate\Support\Facades\DB;

class FormPeminjamanController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = FormPeminjaman::with('department')->with('aset')->get();
        return response()->json($data);
    }
    public function count()
    {
        $data;
        $data['totalform'] = DB::table('form_peminjaman')->count();
        $data['approve'] = DB::table('form_peminjaman')->where('approve_peminjaman','!=',null)->count();
        return response()->json($data);
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
        $u = new FormPeminjaman;
        $u->id_aset = $request->IdAset;
        $u->id_department = $request->IdDepartment;
        $u->penanggung_jawab = $request->PenanggungJawab;
        $u->tujuan = $request->Tujuan;
        $u->keperluan = $request->Keperluan;
        $u->tgl_peminjaman = $request->TglPeminjaman;
        $u->tgl_pengembalian = $request->TglPengembalian;
        $u->jam_keluar_kendaraan = $request->JamKeluarKendaraan;
        $u->kondisi_awal_bbm = $request->KondisiAwalBBM;
        $u->kondisi_awal_kilometer = $request->KondisiAwalKilometer;
        $u->kondisi_awal_kebersihan = $request->KondisiAwalKebersihan;
        $u->kondisi_awal_fisik_kendaraan = $request->KondisiAwalFisikKendaraan;
        $u->approve_peminjaman = null;
        $u->save();
        return response()->json($u);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return FormPeminjaman::where('id_form_peminjaman',$id)->first();
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
