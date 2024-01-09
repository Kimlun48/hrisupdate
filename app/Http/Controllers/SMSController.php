<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use App\Models\SmsLog;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class SMSController extends Controller
{
    public function index()
    {
        return view('sms.index');
    }

    public function massms()
    {
        return view('sms.mass-sms');
    }

    public function otpindex(Request $request)
    {
        $to = $request->session()->get('phone_number');

        return view('sms.otpindex', compact('to'));
    }

    public function newpassword()
    {
        return view('sms.newpassword');
    }

    public function showLog(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // Mengatur tanggal awal dan akhir jika tidak ada input dari pengguna
        if (empty($startDate)) {
            $startDate = Carbon::now()->subMonth()->toDateString();
        }

        if (empty($endDate)) {
            $endDate = Carbon::now()->toDateString();
        }
        $recipients = explode(',', $request->recipients);
        $responses = [];
        
        foreach ($recipients as $recipient) {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer SQLM1sNt0K7grgXLwiYdU4tBaKTPtYeZv7xcIgRw',
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ])->post('https://www.smsnotif.id/api/messages', [
                'to' => trim($recipient),
                'message' => $request->message,
            ]);
        
            $responseData = $response->json();
        
            if ($response->successful()) {
                $responses[] = [
                    'recipient' => $recipient,
                    'status' => 'Success',
                    'response' => $responseData
                ];
            } else {
                $errorMessage = isset($responseData['message']) ? $responseData['message'] : 'Unknown error occurred';
                $responses[] = [
                    'recipient' => $recipient,
                    'status' => 'Failed',
                    'response' => $errorMessage
                ];
            }
        }
        

        // Mengambil log respons dari tanggal awal hingga akhir
        $logs = SmsLog::whereDate('created_at', '>=', $startDate)
            ->whereDate('created_at', '<=', $endDate)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('sms.logsms',['responses' => $responses], [
            'logs' => $logs,
            'startDate' => $startDate,
            'endDate' => $endDate,
        ]);
    }

    public function sendSMS(Request $request)
    {
        $request->validate([
            'to' => 'required',
            'message' => 'required',
        ]);

        $response = Http::withHeaders([
            'Authorization' => 'Bearer MUWsbJFqAH2oWFvliJNDZ5FAix8wNrRZKjkNFDIZ',
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ])->post('https://www.smsnotif.id/api/messages', [
            'to' => $request->to,
            'message' => $request->message,
        ]);

        if ($response->successful()) {
            // Permintaan berhasil dilakukan
            $responseData = $response->json();
            // Lakukan sesuatu dengan data respons
            // Contoh: Tampilkan pesan sukses ke pengguna
            return back()->with('success', 'SMS berhasil dikirim!');
        } else {
            // Permintaan gagal dilakukan
            $errorMessage = $response->body();
            // Tangani kesalahan
            // Contoh: Tampilkan pesan kesalahan ke pengguna
            return back()->with('error', 'Gagal mengirim SMS. Silakan coba lagi.');
        }
    }

    public function sendOTP(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'to' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $user = User::where('phone_number', $request->to)->first();

        if ($user) {
            $otpCode = mt_rand(100000, 999999);
            $expiresAt = Carbon::now()->addMinutes(5);

            $user->otp = $otpCode;
            $user->updated_at = $expiresAt;
            $user->save();

            $response = Http::withHeaders([
                'Authorization' => 'Bearer TyOJufM3kmgmy4Mwumn8AnX4oClgDVnaFAasBpIB',
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ])->post('https://www.smsnotif.id/api/messages', [
                'to' => $request->to,
                'message' => 'Your OTP is: '.$otpCode,
            ]);

            if ($response->successful()) {
                // Permintaan berhasil dilakukan
                $responseData = $response->json();
                // Tambahkan log respons sukses ke database
                SmsLog::create([
                    'to' => $request->to,
                    'message' => 'Your OTP is: '.$otpCode,
                    'status' => true,
                    'otp_verified' => false,
                    'password_changed' => false,
                ]);
                // Set session dengan nomor telepon
                $request->session()->put('phone_number', $request->to);

                // Lakukan redirect ke halaman sms.otpindex
                return redirect()->route('sms.otpindex')->with('success', 'SMS berhasil dikirim!');
            } else {
                // Permintaan gagal dilakukan
                $errorMessage = $response->body();
                // Tambahkan log respons error ke database
                SmsLog::create([
                    'to' => $request->to,
                    'message' => 'Your OTP is: '.$otpCode,
                    'status' => false,
                    'otp_verified' => false,
                    'password_changed' => false,
                ]);

                // Tangani kesalahan
                // Contoh: Tampilkan pesan kesalahan ke pengguna
                return back()->with('error', 'Gagal mengirim ulang SMS OTP. Silakan coba lagi.');
            }
        } else {
            return back()->with('error', 'Nomor telepon tidak ditemukan.'); // Jika nomor telepon tidak ditemukan
        }
    }

    public function resendOTP(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'to' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $user = User::where('phone_number', $request->to)->first();

        if ($user) {
            $otpCode = mt_rand(100000, 999999);
            $expiresAt = Carbon::now()->addMinutes(5);

            $user->otp = $otpCode;
            $user->updated_at = $expiresAt;
            $user->save();

            $response = Http::withHeaders([
                'Authorization' => 'Bearer SQLM1sNt0K7grgXLwiYdU4tBaKTPtYeZv7xcIgRw',
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ])->post('https://www.smsnotif.id/api/messages', [
                'to' => $request->to,
                'message' => 'Your resend OTP is: '.$otpCode,
            ]);

            if ($response->successful()) {
                // Permintaan berhasil dilakukan
                $responseData = $response->json();

                SmsLog::create([
                    'to' => $request->to,
                    'message' => 'Your OTP is: '.$otpCode,
                    'status' => true,
                    'otp_verified' => false,
                    'password_changed' => false,
                ]);
                // Lakukan sesuatu dengan data respons
                return redirect()->route('sms.otpindex')->with('success', 'SMS berhasil dikirim ulang!');
            } else {
                // Permintaan gagal dilakukan
                $errorMessage = $response->body();

                SmsLog::create([
                    'to' => $request->to,
                    'message' => 'Your OTP is: '.$otpCode,
                    'status' => true,
                    'otp_verified' => false,
                    'password_changed' => false,
                ]);
                // Tangani kesalahan
                // Contoh: Tampilkan pesan kesalahan ke pengguna
                return back()->with('error', 'Gagal mengirim ulang SMS OTP. Silakan coba lagi.');
            }
        } else {
            return back()->with('error', 'Nomor telepon tidak ditemukan.'); // Jika nomor telepon tidak ditemukan
        }
    }

    public function verifyOTP(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'otp-input1' => 'required|numeric',
            'otp-input2' => 'required|numeric',
            'otp-input3' => 'required|numeric',
            'otp-input4' => 'required|numeric',
            'otp-input5' => 'required|numeric',
            'otp-input6' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $otp = $request->input('otp-input1').$request->input('otp-input2').$request->input('otp-input3').$request->input('otp-input4').$request->input('otp-input5').$request->input('otp-input6');

        $user = User::where('otp', $otp)->where('updated_at', '>=', Carbon::now())->first();

        if ($user) {
            return redirect()->route('sms.newpassword')->with([
                'success' => 'OTP berhasil diverifikasi',
                'otp' => $otp,
                'email' => $user->email,
            ]);
        } else {
            return back()->with('error', 'OTP tidak valid atau telah kadaluarsa');
        }
    }

    public function showResetForm(Request $request)
    {
        $otp = $request->session()->get('otp');
        $email = $request->session()->get('email');

        return view('sms.newpassword', compact('otp', 'email'));
    }

    public function resetPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'otp' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $user = User::where('otp', $request->input('otp'))->first();

        if ($user) {
            $user->password = bcrypt($request->input('password'));
            $user->otp = null;
            $user->updated_at = null;
            $user->save();

            Auth::logout();

            return redirect()->route('login.show')->with('success', 'Password berhasil diubah');
        } else {
            return back()->with('error', 'OTP tidak valid atau telah kadaluarsa');
        }
    }

    public function test2() {
        // $skr = date('Y-m-d');
        // $minggulalu = date('Y-m-d', strtotime(date('Y-m-d'). ' - 7 days'));
        // $hasil = $this->karpres()
        //     ->whereBetween('tanggal', [$minggulalu, $skr])
        //     ->where(function ($query) {
        //         $query->whereNull('presensi_status')->orWhere('presensi_status', 'off');
        //     })->count();
        // return response()->json([
        //     $hasil
        // ]);

        $kar = Karyawan::where('id',1203)->get();
        
        foreach ($kar as $kar) {
            $mk = $kar->getAbsensiCount();
        }

        dd($mk);

        return response()->json([
            $mk
        ]);
    }
}
