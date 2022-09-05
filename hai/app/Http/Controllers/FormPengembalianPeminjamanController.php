<?php

namespace App\Http\Controllers;
use App\Models\FormPengembalianPeminjaman;
use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\Aset;
use App\Models\Seen;
use App\Models\FormPeminjaman;
use Illuminate\Support\Facades\DB;

class FormPengembalianPeminjamanController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = FormPengembalianPeminjaman::with('peminjaman')->get();
        foreach ($data as $key => $value) {
            $value['peminjaman']['department'] = Department::where('id_department',$value['peminjaman']['id_department'])->first();
            $value['peminjaman']['aset'] = Aset::where('id_aset',$value['peminjaman']['id_aset'])->first();
        }
        return response()->json($data);
    }
    public function laporan($TglAwal,$TglAkhir)
    {
        $data = FormPengembalianPeminjaman::with('peminjaman')->whereBetween('tgl_pengembalian',[date($TglAwal),date($TglAkhir)])->get();
        foreach ($data as $key => $value) {
            $value['peminjaman']['department'] = Department::where('id_department',$value['peminjaman']['id_department'])->first();
            $value['peminjaman']['aset'] = Aset::where('id_aset',$value['peminjaman']['id_aset'])->first();
        }
        return response()->json($data);
    }
    public function count($id)
    {
        $data['totalform'] = DB::table('pengembalian_peminjaman')->count();
        $data['approve'] = DB::table('pengembalian_peminjaman')->where('approve_pengembalian_kendaraan','!=',null)->count();
        $data['seen'] = Seen::where('id_user',$id)->first('p_peminjaman')->p_peminjaman;
        return response()->json($data);
    }

    public function approve($id,Request $request)
    {
        if($request->AccBy == 'HRGA'){
            if($request->AccHR == 'N'){
                FormPengembalianPeminjaman::where('id_kembali_peminjaman',$id)
                ->update(['acc_hr'=>$request->AccHR,'approve_pengembalian_peminjaman'=>$request->Approve]);
            }else{
                date_default_timezone_set('Asia/Makassar');
                $cu = FormPengembalianPeminjaman::where('id_kembali_peminjaman',$id)->first();
                    $cekaset = Aset::where('id_aset',$request->IdAset);
                    $cek = $cekaset->first();
                    $kondisi = explode(',', $cek['kondisi_aset']);
                        $cekaset->update(
                            ['status_aset'=>'READY',
                            'KM'=>$cu['kondisi_akhir_kilometer'],
                            'BBM'=>$cu['kondisi_akhir_bbm'],
                            'kondisi_aset'=>$kondisi[0]]);
                $u = FormPengembalianPeminjaman::where('id_kembali_peminjaman',$id)
                ->update(['acc_hr'=>$request->AccHR,'approve_pengembalian_kendaraan'=>$request->Approve,'jam_masuk_kendaraan'=>date('H:i')]);
            }
        }
        // else{
        //     date_default_timezone_set('Asia/Makassar');
        //     $cu = FormPengembalianPeminjaman::where('id_kembali_peminjaman',$id)->first();
        //     if($request->AccManager != 'N'){
        //         Aset::where('id_aset',$request->IdAset)
        //         ->update(['status_aset'=>'READY','KM'=>$cu['kondisi_akhir_kilometer'],'BBM'=>$cu['kondisi_akhir_bbm']]);
        //     }
        //     $u = FormTesDrive::where('id_kembali_peminjaman',$id)
        //     ->update(['acc_manager'=>$request->AccManager,'approve_pengembalian_kendaraan'=>$request->Approve]);
            
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
        $u = new FormPengembalianPeminjaman;
        $u->id_form_peminjaman = $request->IdFormPeminjaman;
        $u->tgl_pengembalian = $request->TanggalPengembalian;
        $u->jam_masuk_kendaraan = $request->JamMasuk;
        $u->kondisi_akhir_bbm = $request->KondisiAkhirBBM;
        $u->kondisi_akhir_kilometer = $request->KondisiKilometer;
        $u->kondisi_kebersihan_kendaraan_interior = $request->KondisiAkhirKebersihanInterior;
        $u->kondisi_kebersihan_kendaraan_eksterior = $request->KondisiAkhirKebersihanEksterior;
        $u->kondisi_fisik_kendaraan = $request->KondisiAkhirFisik;
        $u->acc_hr = null;
        $u->approve_pengembalian_kendaraan = null;
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
        $data = FormPengembalianPeminjaman::where('id_kembali_peminjaman',$id)->with('peminjaman')->first();
        $data['peminjaman']['aset'] = Aset::where('id_aset',$data['peminjaman']['id_aset'])->first();
        $data['peminjaman']['department'] = Department::where('id_department',$data['peminjaman']['id_department'])->first();
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
