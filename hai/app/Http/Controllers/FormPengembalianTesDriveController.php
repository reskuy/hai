<?php

namespace App\Http\Controllers;
use App\Models\FormPengembalianTesDrive;
use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\Aset;
use App\Models\Seen;
use App\Models\FormTesDrive;
use Illuminate\Support\Facades\DB;

class FormPengembalianTesDriveController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = FormPengembalianTesDrive::with('tesdrive')->get();
        foreach ($data as $key => $value) {
            $value['tesdrive']['department'] = Department::where('id_department',$value['tesdrive']['id_department'])->first();
            $value['tesdrive']['aset'] = Aset::where('id_aset',$value['tesdrive']['id_aset'])->first();
        }
        return response()->json($data);
    }
    public function laporan($TglAwal,$TglAkhir)
    {
        $data = FormPengembalianTesDrive::with('tesdrive')->whereBetween('tanggal_pengembalian',[date($TglAwal),date($TglAkhir)])->get();
        foreach ($data as $key => $value) {
            $value['tesdrive']['department'] = Department::where('id_department',$value['tesdrive']['id_department'])->first();
            $value['tesdrive']['aset'] = Aset::where('id_aset',$value['tesdrive']['id_aset'])->first();
        }
        return response()->json($data);
    }
    public function count($id)
    {
        $data;
        $data['totalform'] = DB::table('pengembalian_tes_drive')->count();
        $data['approve'] = DB::table('pengembalian_tes_drive')->where('approve_pengembalian_tes_drive','!=',null)->count();
        $data['seen'] = Seen::where('id_user',$id)->first('p_tesdrive')->p_tesdrive;
        return response()->json($data);
    }

    public function approve($id,Request $request)
    {
        if($request->AccBy == 'HRGA'){
            if($request->AccHR == 'N'){
                FormPengembalianTesDrive::where('id_kembali_tes_drive',$id)
                ->update(['acc_hr'=>$request->AccHR,'approve_pengembalian_tes_drive'=>$request->Approve]);
            }else{
                date_default_timezone_set('Asia/Makassar');
                $cu = FormPengembalianTesDrive::where('id_kembali_tes_drive',$id)->first();
                    $cekaset = Aset::where('id_aset',$request->IdAset);
                    $cek = $cekaset->first();
                    $kondisi = explode(',', $cek['kondisi_aset']);
                        $cekaset->update(
                            ['status_aset'=>'READY',
                            'KM'=>$cu['kondisi_akhir_kilometer'],
                            'BBM'=>$cu['kondisi_akhir_bbm'],
                            'kondisi_aset'=>(sizeof($kondisi) > 1 ? $kondisi[0] : null)]);
                $u = FormPengembalianTesDrive::where('id_kembali_tes_drive',$id)
                ->update(['acc_hr'=>$request->AccHR,'approve_pengembalian_tes_drive'=>$request->Approve,'jam_masuk_kendaraan'=>date('H:i')]);
            }
        }
        // else{
        //     date_default_timezone_set('Asia/Makassar');
        //     $cu = FormPengembalianTesDrive::where('id_kembali_tes_drive',$id)->first();
        //     if($request->AccManager != 'N'){
        //         $cekaset = Aset::where('id_aset',$request->IdAset);
        //         $cek = $cekaset->first();
        //         $kondisi = explode(',', $cek['kondisi_aset']);
        //             $cekaset->update(
        //                 ['status_aset'=>'READY',
        //                  'KM'=>$cu['kondisi_akhir_kilometer'],
        //                  'BBM'=>$cu['kondisi_akhir_bbm'],
        //                  'kondisi_aset'=>$kondisi[0]]);
        //     }
        //     $u = FormPengembalianTesDrive::where('id_kembali_tes_drive',$id)
        //     ->update(['acc_manager'=>$request->AccManager,'approve_pengembalian_tes_drive'=>$request->Approve]);
        // }
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
        date_default_timezone_set('Asia/Makassar');
        $u = new FormPengembalianTesDrive;
        $u->id_form_tes_drive = $request->IdFormTesDrive;
        $u->tanggal_pengembalian = $request->TanggalPengembalian;
        $u->jam_masuk_kendaraan = Date('H:i');
        $u->kondisi_akhir_bbm = $request->KondisiAkhirBBM;
        $u->kondisi_akhir_kilometer = $request->KondisiKilometer;
        $u->kondisi_akhir_kebersihan_interior = $request->KondisiAkhirKebersihanInterior;
        $u->kondisi_akhir_kebersihan_eksterior = $request->KondisiAkhirKebersihanEksterior;
        $u->kondisi_akhir_fisik_kendaraan = $request->KondisiAkhirFisik;
        $u->approve_pengembalian_tes_drive = null;
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
       $data =  FormPengembalianTesDrive::where('id_kembali_tes_drive',$id)->with('tesdrive')->first();
        $data['tesdrive']['department'] = Department::where('id_department',$data['tesdrive']['id_department'])->first();
        $data['tesdrive']['aset'] = Aset::where('id_aset',$data['tesdrive']['id_aset'])->first();
        return $data;
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
