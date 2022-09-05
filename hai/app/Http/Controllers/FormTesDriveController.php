<?php

namespace App\Http\Controllers;
use App\Models\FormTesDrive;
use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\Aset;
use App\Models\Seen;
use Illuminate\Support\Facades\DB;

class FormTesDriveController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = FormTesDrive::with('department')->with('aset')->with('pengembalian')->get();
        return response()->json($data);
    }
    public function laporan($TglAwal,$TglAkhir)
    {
        $data = FormTesDrive::with('department')->with('aset')->with('pengembalian')->whereBetween('tanggal_pemakaian',[date($TglAwal),date($TglAkhir)])->get();
        return response()->json($data);
    }
    public function count($id)
    {
        $data;
        $data['totalform'] = DB::table('form_tes_drive')->count();
        $data['approve'] = DB::table('form_tes_drive')->where('approve_form_tes_drive','!=',null)->count();
        $data['seen'] = Seen::where('id_user',$id)->first('tes_drive')->tes_drive;
        return response()->json($data);
    }

    public function todaycount()
    {
        $datenow = date('Y-m-d');
        $data;
        $data['totalform'] = DB::table('form_tes_drive')->where('tanggal_pemakaian',$datenow)->count();
        $data['approve'] = DB::table('form_tes_drive')->where('tanggal_pemakaian',$datenow)->where('approve_form_tes_drive','!=',null)->count();
        return response()->json($data);
    }

    public function history($id)
    {
        $data = FormTesDrive::with('department')->with('aset')->with('pengembalian')->where('penanggung_jawab',$id)->get();
        return response()->json($data);
    }
    public function approve($id,Request $request)
    {
        if($request->AccBy == 'HRGA'){
            if($request->AccHR == 'N'){
                FormTesDrive::where('id_form_tes_drive',$id)
                ->update(['acc_hr'=>$request->AccHR,'approve_form_tes_drive'=>$request->Approve]);
            }
            $u = FormTesDrive::where('id_form_tes_drive',$id)
            ->update(['acc_hr'=>$request->AccHR]);
        }else{
            date_default_timezone_set('Asia/Makassar');
            if($request->AccManager != 'N'){
                $aset = Aset::where('id_aset',$request->IdAset);
                $cekaset = $aset->first();
                if($cekaset['kondisi_aset'] != null){
                    $aset->update(['status_aset'=>'NOT READY','kondisi_aset'=>$cekaset['kondisi_aset'].',TES DRIVE']);
                }else{
                    $aset->update(['status_aset'=>'NOT READY','kondisi_aset'=>'TES DRIVE']);
                }
                FormTesDrive::where('id_form_tes_drive',$id)->update(['jam_keluar_kendaraan'=>date('H:i')]);
            }
            $u = FormTesDrive::where('id_form_tes_drive',$id)
            ->update(['acc_manager'=>$request->AccManager,'approve_form_tes_drive'=>$request->Approve]);
            
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
        $u = new FormTesDrive;
        $u->id_aset = $request->IdAset;
        $u->id_department = $request->IdDepartment;
        $u->penanggung_jawab = $request->PenanggungJawab;
        $u->nama_customer = $request->NamaCustomer;
        $u->kondisi_awal_bbm= $request->KondisiBBM;
        $u->kondisi_awal_kilometer= $request->KondisiKM;
        $u->kondisi_awal_kebersihan_interior= $request->KondisiAwalKebersihanInterior;
        $u->kondisi_awal_kebersihan_eksterior= $request->KondisiAwalKebersihanEksterior;
        $u->kondisi_awal_fisik_kendaraan= $request->KondisiFisik;
        $u->lokasi_tes_drive = $request->LokasiTesDrive;
        $u->tanggal_pemakaian = $request->TanggalPemakaian;
        $u->tanggal_kembali = null;
        $u->jam_keluar_kendaraan = $request->JamKeluar;
        $u->estimasi_jam_masuk_kendaraan = $request->JamMasuk;
        $u->tanggal_kembali = $request->EstimasiTanggalKembali;
        $u->approve_form_tes_drive = null;
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
        return FormTesDrive::where('id_form_tes_drive',$id)->with('department')->with('aset')->with('pengembalian')->first();
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
