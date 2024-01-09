<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Karyawan;

class LoginController extends Controller
{
    /**
     * Display login page.
     * 
     * @return Renderable
     */
    public function show()
    {
        return view('auth.login');
    }

    /**
     * Handle account login request
     * 
     * @param LoginRequest $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function login(LoginRequest $request)
    {
       $credentials = $request->getCredentials();
        // $cek_user = User::where('email', $request['email'])->first();
       $cek_user = User::where('email', $request['email'])->first();
        #Untuk User Yang tidak Absen selama 1 minggu maka user Di kunci,selain disini cek di app/Console/Commands/AutomationNonAktifUser.php dan di app/Console/Kernel.php Untuk Otomasitsasi nya dijalankan di Crontab
        // if($cek_user->status_aktif == "NoneAktif"){
        //     return redirect()->to('login')->withErrors(trans('Anda Tidak Memiliki Akses HAHAH!!!'));
        // }

        if (is_null($cek_user)) {
            $credentials = $request->getCredentials();
            return redirect()->to('login')
                ->withErrors(trans('Anda Tidak Memiliki Akun!!!'));
        } else {
            $cek_status = $cek_user->status_user;
            // dd($cek_user->status_user,$cek_user->id);
            if ($cek_status == 'Karyawan') {
                $krs = Karyawan::where('fk_user',$cek_user->id)->first();
                if($krs->status_karyawan == "phk" or $krs->status_karyawan == "PHK" or $krs->status_karyawan == "habiskontrak" or $krs->status_karyawan =="Resign"){
                    return redirect()->to('login')->withErrors(trans('Anda Tidak Memiliki Akses PHK!!!'));
                }
                // if($krs->status_karyawan == "Resign"){
                //     return redirect()->to('login')->withErrors(trans('Anda Tidak Memiliki Akses Resign!!!'));
                // }
                if (!Auth::validate($credentials)) :
                    return redirect()->to('login')->withErrors(trans('auth.failed'));
                endif;
                $user = Auth::getProvider()->retrieveByCredentials($credentials);
                Auth::login($user);
                return $this->authenticated($request, $user);
            }
            if ($cek_status == 'Admin') {
                if (!Auth::validate($credentials)) :
                    return redirect()->to('login')
                        ->withErrors(trans('auth.failed'));
                endif;
                $user = Auth::getProvider()->retrieveByCredentials($credentials);
                Auth::login($user);
                return $this->authenticated($request, $user);
            } else {
                return redirect()->to('login')
                    ->withErrors(trans('Anda Tidak Memiliki Akses!!!'));
            }
        }
        #$credentials = $request->getCredentials();
	#if(!Auth::validate($credentials)):
        #    return redirect()->to('login')
        #        ->withErrors(trans('auth.failed'));
        #endif;
        #$user = Auth::getProvider()->retrieveByCredentials($credentials);
        #Auth::login($user);
        #return $this->authenticated($request, $user);
    }

    /**
     * Handle response after user authenticated
     * 
     * @param Request $request
     * @param Auth $user
     * 
     * @return \Illuminate\Http\Response
     */
    protected function authenticated(Request $request, $user) 
    {
        return redirect()->intended();
    }
}
