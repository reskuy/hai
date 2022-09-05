<?php

namespace App\Http\Controllers;
use App\Models\FormPeminjaman;
use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\Aset;
use App\Models\Seen;
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
        $data = FormPeminjaman::with('department')->with('aset')->with('pengembalian')->get();
        return response()->json($data);
    }
    public function history($id,$department)
    {
        $data = FormPeminjaman::with('department')->with('aset')->with('pengembalian')->where('penanggung_jawab',$id)->where('id_department',$department)->get();
        return response()->json($data);
    }
    public function laporan($TglAwal,$TglAkhir)
    {
        $data = FormPeminjaman::with('department')->with('aset')->with('pengembalian')->whereBetween('tgl_peminjaman',[date($TglAwal),date($TglAkhir)])->get();
        return response()->json($data);
    }
    public function count($id)
    {
        $data;
        $data['totalform'] = DB::table('form_peminjaman')->count();
        $data['approve'] = DB::table('form_peminjaman')->where('approve_peminjaman','!=',null)->count();
        $data['seen'] = Seen::where('id_user',$id)->first('peminjaman')->peminjaman;
        return response()->json($data);
    }
    public function todaycount()
    {
        $datenow = date('Y-m-d');
        $data;
        $data['totalform'] = DB::table('form_peminjaman')->where('tgl_peminjaman',$datenow)->count();
        $data['approve'] = DB::table('form_peminjaman')->where('tgl_peminjaman',$datenow)->where('approve_peminjaman','!=',null)->count();
        return response()->json($data);
    }
    public function approve($id,Request $request)
    {
        if($request->AccBy == 'HRGA'){
            if($request->AccHR == 'N'){
                FormPeminjaman::where('id_form_peminjaman',$id)
                ->update(['acc_hr'=>$request->AccHR,'approve_peminjaman'=>$request->Approve]);
            }
            $u = FormPeminjaman::where('id_form_peminjaman',$id)
            ->update(['acc_hr'=>$request->AccHR]);
        }else{
            date_default_timezone_set('Asia/Makassar');
            $c = FormPeminjaman::where('id_form_peminjaman',$id)->first();
            if($request->AccManager != 'N'){
                if($c['keperluan'] == 'DAILY'){
                    $re = 'DAILY';
                    $sre = 'READY';
                }else{
                    $re = 'DIPINJAM';
                    $sre = 'NOT READY';
                }
                Aset::where('id_aset',$request->IdAset)
                ->update(['kondisi_aset'=>$re,'status_aset'=>$sre]);
                FormPeminjaman::where('id_form_peminjaman',$id)->update(['jam_keluar_kendaraan'=>date('H:i')]);
            }
            $u = FormPeminjaman::where('id_form_peminjaman',$id)
            ->update(['acc_manager'=>$request->AccManager,'approve_peminjaman'=>$request->Approve]);
            
        }
        return $u;
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
        $u->tgl_pengembalian = $request->EstimasiTanggalPengembalian;
        $u->jam_keluar_kendaraan = $request->JamKeluarKendaraan;
        $u->kondisi_awal_bbm = $request->KondisiAwalBBM;
        $u->kondisi_awal_kilometer = $request->KondisiAwalKilometer;
        $u->kondisi_awal_kebersihan_interior = $request->KondisiAwalKebersihanInterior;
        $u->kondisi_awal_kebersihan_eksterior = $request->KondisiAwalKebersihanEksterior;
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
        return FormPeminjaman::where('id_form_peminjaman',$id)->with('department')->with('aset')->with('pengembalian')->first();
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
