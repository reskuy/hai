<?php

namespace App\Http\Controllers;
use App\Models\Aset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AsetController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Aset::all();
    }

    public function count(){
        return DB::table('aset')->count();
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
        $u = new Aset;
        $u->jenis_aset = $request->JenisAset;
        $u->nama_aset = $request->NamaAset;
        $u->warna = $request->Warna;
        $u->no_plat = $request->NoPlat;
        $u->status_aset= $request->StatusAset;
        $u->kondisi_aset= $request->KondisiAset;
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
        return Aset::where('id_aset',$id)->first();
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
        $u = Aset::where('id_aset',$id)
            ->update([
                'jenis_aset'=>$request->JenisAset,
                'nama_aset'=>$request->NamaAset,
                'warna'=>$request->Warna,
                'no_plat'=>$request->NoPlat,
                'kondisi_aset'=>$request->KondisiAset,
                'status_aset'=>$request->StatusAset]);
        return $u;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return DB::table('aset')->where('id_aset',$id)->delete();
    }
}
