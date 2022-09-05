<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Log;
use App\Models\Seen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function log($status){
        date_default_timezone_set('Asia/Makassar');
        $log = new Log();
        $log->Tanggal = date('Y-m-d');
        $log->Jam = date('H:i');
        $log->Status = $status;
        $log->save();
    }

    public function login(Request $req){
        $user = User::where('username',$req->username)->where('password',$req->password)->with('department')->first();
        if($user != null){
            $this->log($user->nama_lengkap.' Login ');
            return $user;
        }else{
            return 'error';
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return User::with('department')->get();
    }
    public function time(){

        date_default_timezone_set('Asia/Makassar');
        return date("l, j F Y h:i:s");
    }

    public function count(){
        return DB::table('user')->count();
    }

    public function seen($name,$id){
        Seen::where('id_user',$id)->update([$name=>'N']);
    }

    public function setseen($name){
       $id = Seen::get('id_user');
        foreach ($id as $key => $value) {
            Seen::where('id_user',$value->id_user)->update([$name=>'Y']);
        }
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
        $u = new User;
        $u->username = $request->Username;
        $u->password = $request->Password;
        $u->level = $request->Level;
        $u->nama_lengkap = $request->NamaLengkap;
        $u->id_department = $request->Department;
        $u->save();
        $this->log($request->User['nama_lengkap'].' Membuat User Baru Dengan Nama '.$request->NamaLengkap);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return User::where('id_user',$id)->first();
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
        $u = User::where('id_user',$id)
            ->update([
                'Username'=>$request->Username,
                'password'=>$request->Password,
                'nama_lengkap'=>$request->NamaLengkap,
                'id_department'=>$request->Department,
                'level'=>$request->Level]);
        $this->log($request->User['nama_lengkap'].' Mengubah User Dengan Nama '.$request->NamaLengkap);
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
        $data = DB::table('user')->where('id_user',$id);
        // $user = $data->first();
        // $this->log($request->User['nama_lengkap'].' Mengubah User Dengan Nama '.$request->NamaLengkap);
        return $data->delete();
    }
}
