<?php

namespace App\Http\Controllers\API;
use Input;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;
use Validator;
use App\Models\User;
use App\Models\Pelamar;
use App\Notifications\WelcomeEmailNotification;
use Illuminate\Support\Facades\Storage;
use Twilio\Rest\Client;
use App\Models\Verifikasi;
use App\Models\Apllyloker;
use App\Models\Karyawan;
use App\Models\CutiKaryawan;
use Illuminate\Support\Facades\Crypt;

class AuthController extends Controller
{
public function register(Request $request)
    {
        $validator = Validator::make($request->all(),[
        //'photo'            => 'required|image|mimes:jpeg,png,jpg|max:2048',
        'name'             => 'required|string|max:255',
	    'email'            => 'required|string|max:255|email|unique:users,email', //|email:rfc,dns|unique:users,email
	    'phone_number'     => 'required|string|min:9|max:13|unique:users,phone_number', 
	    'password'         => 'required|string|min:8',
	    'confirm_password' => 'required|string|min:8'
        ]);

        //$photo = $request->file('photo');

        /*
        if ($photo) {
            $fileName = time().'_'.$photo->getClientOriginalName();
            $filePath = $photo->storeAs('images/users', $fileName, 'public');
        }
        */
        $phone_number = $request['phone_number'];
        if ($request['phone_number'][0] == "0") {
            $phone_number = substr($phone_number, 1);
        }

        if ($phone_number[0] == "8") {
            $phone_number = "62" . $phone_number;
	}
	$phone = User::select('*')->where('phone_number', '=', $phone_number)->get()->last();
	$cekmail = $request['email'];
	$mail = User::select('*')->where('email', '=', $cekmail)->get()->last();
	if ($phone and $mail) {
           return response()
                ->json(['message' => 'Email Dan Telepon Anda Telah Terdaftar!! ', 'code' => 'reg1'], 401);
	}
	if ($phone) {
           return response()
               ->json(['message' => 'Nomor Telepon Anda Telah Terdaftar!! ', 'code' => 'reg3'], 401);
	}
	if ($mail){
           return response()
                ->json(['message' => 'Email Anda Telah Terdaftar!! ', 'code' => 'reg2'], 401);
	}
	if($validator->fails()){
           return response()->json($validator->errors());       
        }


	else{
            $user = User::create([
                'name'             => $request->name,
                'email'            => $request->email,
                'phone_number'     => $phone_number,
	        'password'         => Hash::make($request->password),
		'confirm_password' => Hash::make($request->password),
		'status_user'      => 'Pelamar'
         ]);
        //$this->whatsappNotification($user->phone_number, $user->name);
        $user->notify(new WelcomeEmailNotification($user));
        $token = $user->createToken('auth_token')->plainTextToken;
        return response()
            ->json(['data' => $user,'access_token' => $token, 'token_type' => 'Bearer', ]);
       }
    }
    /*   
    private function whatsappNotification($recipient, $userName)
    {
        $sid     = env("TWILIO_AUTH_SID");
        $token   = env("TWILIO_AUTH_TOKEN");
        $wa_from = env("TWILIO_WHATSAPP_FROM");
        $twilio  = new Client($sid, $token);
        
        $body = 'Hello '.$userName.', welcome to PT. Anyar Retail Indonesia.';

        return $twilio->messages->create("whatsapp:+$recipient",[
                                        "from" => "$wa_from",
                                        "body" => $body
                                    ]);
    }
    */

    // method for login
    public function login(Request $request)
    {
        $user = User::where('email', $request['email'])->first();

        if($user->status_aktif == "NoneAktif") {
            return response()->json([
                'success'   => false,
                'message'   => 'Akun anda tidak aktif',
            ],500);
        }
        
        $cek_status = $user->status_user;
        if ($cek_status == 'Karyawan') {
            $krs = Karyawan::where('fk_user',$user->id)->first();
            if($krs->status_karyawan == "PHK" or $krs->status_karyawan == "Habis Kontrak" or $krs->status_karyawan =="Resign"){
                return response()->json(['message' => 'Anda Tidak Memiliki Akses', 'code' => 'reg1','pass'=>$user->password], 401);
            }
        }
        if (is_null($user)) {
            return response()->json(['message' => 'Email Anda Belum Terdaftar', 'code' => 'reg1','pass'=>$user->password], 401);
        }
        if (is_null($user->email_verified_at)) {
            return response()
		    ->json(['message' => 'Silahkan Verifikasi Email Anda', 'code' => 'reg1','pass'=>$user->password], 401);
        }
        if (!is_null($user->email_verified_at) and (!(Hash::check(request('password'), $user->password)))) {
                return response()
            ->json(['message' => 'Password Anda Salah', 'code' => 'reg2','pass'=>$user->password], 401);
        }
        if (!is_null($user->email_verified_at) and (Hash::check(request('password'), $user->password) )) {
            $lm =  Karyawan::where('fk_user', $user->id)->get()->last();
            if($user->status_user === 'Pelamar' or $user->status_user === 'Admin'){
                    #$level_jab = $lm->jabatan->kode;
                    $token = $user->createToken('auth_token')->plainTextToken;
                    $user->update(['device_token' => $request->tkn]); ##Untuk Menyimpan Token Firebase
                        return response()->json([
                        'message' => 'Hi '.$user->name.', welcome to home',
                        'token' => $token,
                        'token_type' => 'Bearer', 
                        'username' => $user->name,
                        'id' => $user->id,
                        'code' => 'reg3',
                        'lev_kar' => $lm,
                        'pass'=>$user->password,
                    ]);
	    }else{
		        $lm =  Karyawan::where('fk_user', $user->id)->get()->last();
                $level_jab = $lm->jabatan->kode;
		        $token = $user->createToken('auth_token')->plainTextToken;
		        $user->update(['device_token' => $request->tkn]); ##Untuk Menyimpan Token Firebase
                return response()->json([
                    'message' => 'Hi '.$user->name.', welcome to home',
                    'token' => $token,
                    'token_type' => 'Bearer',
                    'username' => $user->name,
                    'id' => $user->id,
                    'code' => 'reg3',
                    #'lev_kar' => $lm,
                    'lev_kar' => $level_jab,
                    'karid'   => $lm->id,
                    #'user' => auth()->user(),
                    'pass'=>$user->password,
		]);
            }

	}
    }
    public function profile()
    {
    $id_user = Auth::user();
    ##JIKA STATUS USERNYA PELAMAR
    if ($id_user->status_user == "Pelamar" or $id_user->status_user == null){
        $plm = Pelamar::where('fk_user', $id_user->id)->take(1)->get();
        #$apply = Apllyloker::with('loker')->where('user_id', $id_user->id)->get();
        $app = Apllyloker::where('progres', 'Offering Letter')->where('user_id', $id_user->id)->latest()->get();
        if($plm){
            $apply = Apllyloker::with('loker')->where('user_id', $id_user->id)->get();
        }else{
           $apply = Apllyloker::with('loker')->where('user_id', $id_user->id)->get();
        }
        $kar = Karyawan::with('jabatan')->where('fk_user', $id_user->id)->take(1)->get();
       return response()->json(['message' => 'Your Profile','data' =>  Auth::user(),'lamar'=> $plm,'apply'=>$apply,'kar'=>$kar, 'cekapp' =>  $app]);
    }
    ##Jika Status Usernya Karyawan
    else{
        $kar = Karyawan::with('jabatan')->with('cabang')->where('fk_user', $id_user->id)->take(1)->get();
        $cuti = CutiKaryawan::select("sisa_cuti")->where('id_kar', $id_user->getkaryawan->id)->first();
        if($cuti){
            $s_cuti = $cuti->sisa_cuti;
        }
        else{
            $s_cuti = 0;
        }
        return response()->json([
            'message'       => 'Your Profile',
            'user aktif'    => !auth()->user()->status_aktif,  
            'data'          => Auth::user(),
            'kar'           => $kar, 
            'cuti'          => $s_cuti
        ]);
     }
    }
    // public function profile()
    // {
    // $id_user = Auth::user();
	// $plm = Pelamar::where('fk_user', $id_user->id)->take(1)->get();
	// #$apply = Apllyloker::with('loker')->where('user_id', $id_user->id)->get();
	// $app = Apllyloker::where('progres', 'Offering Letter')->where('user_id', $id_user->id)->latest()->get();
    // $kar = Karyawan::with('jabatan')->with('cabang')->where('fk_user', $id_user->id)->take(1)->get();
    // $cuti = CutiKaryawan::select("sisa_cuti")->where('id_kar', $id_user->getkaryawan->id)->first();  
	// if($plm){
    //     $apply = Apllyloker::with('loker')->where('user_id', $id_user->id)->get();
    // }else{
    //    $apply = Apllyloker::with('loker')->where('user_id', $id_user->id)->get();
    // }
    // if($cuti){
    //     $s_cuti = $cuti->sisa_cuti;
    // }
    // else{
    //     $s_cuti = 0;
    // }
    // return response()->json(['message' => 'Your Profile','data' =>  Auth::user(),'lamar'=> $plm,
    //     'apply'=>$apply,'kar'=>$kar, 'cekapp' =>  $app,'cuti'=>$s_cuti]);
    // }
  
    // method for profile update
    public function update(Request $request)
    {
        $user = Auth::user();
        $validator = Validator::make($request->all(),[
            'name'      => 'required|string|max:255',
            'email'     => 'required|string|email|max:255|unique:users,email,'.$user->id,
            'password'  => 'nullable|string|min:8'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());       
        }

        $photo = $request->file('photo');

        if ($photo) {
            Storage::delete('public/'.$user->photo);

            $fileName = time().'_'.$photo->getClientOriginalName();
            $filePath = $photo->storeAs('images/users', $fileName, 'public');
        }

        $phone_number = $request['phone_number'];
        if ($request['phone_number'][0] == "0") {
            $phone_number = substr($phone_number, 1);
        }

        if ($phone_number[0] == "8") {
            $phone_number = "62" . $phone_number;
        }

        $user->update([
            'photo'            => $filePath ?? $user->photo,
            'name'             => $request->name,
            'email'            => $request->email,
            'phone_number'     => $phone_number,
            'password'         => $request->password ? Hash::make($request->password) : $user->password,
	        'confirm_password' => $request->confirm_password ? Hash::make($request->password) : $user->confirm_pasword
         ]);

         return response()->json(['message' => 'Successfully updated','data' => $user]);
    }

    // method for user logout and delete token
    public function logout()
    {
        auth()->user()->tokens()->delete();

        return response()->json(['message' => 'You have been logged out']);
    }    
    public function cekverify($email)
    {
        $user = User::select('*')->where('email', '=', $email)->get()->last();
        if ($user) {
            return response()->json(['message' => 'Succsess', 'data' => $user->email]);
        } else {
            return response()
                ->json(['message' => 'Email Tidak Ditemukan!! ', 'code' => 'reg1'], 401);
        }
    }
    public function resentverif(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'     => 'required|string|email|max:255|unique:users,email,'
        ]);

        $user = User::select('*')->where('email', '=', $request->email)->get()->last();
        if ($user) {
            $user->notify(new WelcomeEmailNotification($user));
            $token = $user->createToken('auth_token')->plainTextToken;
            return response()
                ->json(['message' => 'Success!! ', 'user' => $user->email, 'token' => $token]);
        } else {
            return response()
                ->json(['message' => 'Email Tidak Ditemukan!! ', 'code' => 'reg1'], 401);
        }
    }

    #public function verify(Request $request)
    public function verify($id,$notel)
    {
    #$user = User::findOrFail($request->id);
    #$user = User::select('*')
    #    ->where('id', '=', $id)
    #    ->where('phone_number', '=', $notel)
    #    ->get()->last();
    

    $decript_id = Crypt::decryptString($id);
    $decript_notel = Crypt::decryptString($notel);
    $user = User::select('*')->where('id', '=', $decript_id)->where('phone_number', '=', $decript_notel)->get()->last();

    if ($user->email_verified_at) {
        return redirect()->away('https://karir.anyargroup.co.id/login');
    }
    if ($user->markEmailAsVerified()) {
        return redirect()->away('https://karir.anyargroup.co.id/login');
    }
    return redirect()->away('https://karir.anyargroup.co.id/login');
    }

    public function changepass(Request $request)
    {
        $user = Auth::user();
        $validator = Validator::make($request->all(), [
            'email'     => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password'  => 'required|string|min:8',
            'confirm_password'  => 'required|string|min:8'
        ]);
        if ($validator->fails()) {
            return response()->json(['message' => 'Failed', 'code' => '300']);
        }
        $user->update([
            'password'         => $request->password ? Hash::make($request->password) : $user->password,
            'confirm_password' => $request->confirm_password ? Hash::make($request->password) : $user->confirm_password
        ]);
        return response()->json(['message' => 'Success', 'code' => '200']);
    }
}
