<?php

namespace App\Http\Controllers;
use App\Models\Aset;
use App\Models\User;
use App\Models\Seen;
use App\Http\Controllers\UserController;
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

    public function count($id){
       $data = [];
       $data['count'] = DB::table('aset')->count();
       $data['seen'] = Seen::where('id_user',$id)->first('aset')->aset;
       return $data; 
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
        $u->BBM = $request->BBM;
        $u->KM = $request->KM;
        $u->no_plat = $request->NoPlat;
        $u->status_aset= $request->StatusAset;
        $u->kondisi_aset= $request->KondisiAset;
        $u->save();
        $user = new UserController;
        $user->log($request->User['nama_lengkap'].' Menambah '.$request->JenisAset.' '.$request->NamaAset.' '.$request->NoPlat.' Ke Data Aset');
        // UserController::log($request->User['nama_lengkap'].' Menambah '.$request->JenisAset.' '.$request->NamaAset.' '.$request->NoPlat.' Ke Data Aset');
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
                'KM'=>$request->KM,
                'BBM'=>$request->BBM,
                'no_plat'=>$request->NoPlat,
                'kondisi_aset'=>$request->KondisiAset,
                'status_aset'=>$request->StatusAset]);
                $user = new UserController;
                $user->log($request->User['nama_lengkap'].' Mengubah Data Aset '.$request->JenisAset.' '.$request->NamaAset.' '.$request->NoPlat);
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
