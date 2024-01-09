<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Announcement;
use Illuminate\Support\Facades\Storage;
use DateTime;
use Auth;
use Kreait\Firebase;
use Kreait\Firebase\Factory;
use App\Models\User;
class AnnouncementController extends Controller
{
 
    ###Kredensian Firebase
    #Firebase Cloud Messaging Authorization Key
    const FCM_AUTH_KEY = 'AAAAh0sKUrQ:APA91bE_GW1p4poeSo7mVRC-O8ZbWnwj_6lVPqwhYz7Sr7-7GBTkfLzSwMjlz_O3gGq5JiMyWVCuCVHzI_1Nn2z0hwxB-V1MCZVkCTH8a7KHuUCMFdWWuihKVn759uNZ_CUEivoFoGLx';

 

    public function index()
    {
        // $anns = Announcement::all()paginate(20);
        $anns = Announcement::orderBy('tanggal', 'DESC')->get();
        return view('announcement.index', compact('anns'));
    }

    // public function create()
    // {
    //     return view('announcement.create');
    // }

    public function store(Request $request)
    {
        $this->validate($request, [
            'subject' => 'required',
            'content' => 'required',
            'attachment' => 'mimes:pdf|max:10000',
        ]);
        
        $id_user = Auth::user();
        $dok = $request->file('attachment');
        if ($dok) {
            $Ann = $request->file('attachment');
            $announ = $request->string('subject');
            $extann = $request->file('attachment')->getClientOriginalExtension();
            $AnnName = $announ . '_' . time() . '.' . $extann;
            $Ann->storeAs('announcement/', $AnnName);
            $ayeuna = new DateTime(date('Y-m-d H:i:s'));
            Announcement::create([
                'judul'  => $request->subject,
                'isi'     => $request->content,
                'dokumen'  => $AnnName,
                'tanggal'  => $ayeuna,
                'status'  => 'Aktif',
                'id_user'  => $id_user->id,
            ]);
        }else{
            $ayeuna = new DateTime(date('Y-m-d H:i:s'));
            Announcement::create([
                'judul'  => $request->subject,
                'isi'     => $request->content,
                #'dokumen'  => $AnnName,
                'tanggal'  => $ayeuna,
                'status'  => 'Aktif',
                'id_user'  => $id_user->id,
            ]);
	}
	###Untuk MEngirim Pesan Ke FireBase
    
	$firebaseToken = User::whereNotNull('device_token')->pluck('device_token')->all();
        $SERVER_API_KEY = 'AAAAh0sKUrQ:APA91bE_GW1p4poeSo7mVRC-O8ZbWnwj_6lVPqwhYz7Sr7-7GBTkfLzSwMjlz_O3gGq5JiMyWVCuCVHzI_1Nn2z0hwxB-V1MCZVkCTH8a7KHuUCMFdWWuihKVn759uNZ_CUEivoFoGLx';
        $data = [
            "registration_ids" => $firebaseToken,
            "notification" => [
                "title" => "Daily A Team Announcement",
                "body" => $request->subject,
                "content_available" => true,
                "priority" => "high",
                'icon' => 'https://hris.anyargroup.co.id/assets/bootstrap/img/icon-office.png',
                'click_action' => 'https://staging.anyargroup.co.id/announcement/'
            ]
        ];
        $dataString = json_encode($data);

        $headers = [
            'Authorization: key=' . $SERVER_API_KEY,
            'Content-Type: application/json',
        ];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);
        $response = curl_exec($ch);	
        // dd('aya kadieuuuuuu');
        return redirect()->route('announcement.index')->with(['success' => 'Announcement Berhasil Disimpan!']);
    }

    public function show() {
        return view('announcement.create');
    }

    public function detail($id)
    {
        $anns =  Announcement::find($id);
        return view('announcement.detail', compact('anns'));
    }

    public function edit($id)
    {
        $anns = Announcement::findOrFail($id);
        return view('announcement.edit', compact('anns'));
    }

    public function storeedit(Request $request, $id)
    {
        $this->validate($request, [
            'subject' => 'required',
            'content' => 'required',
            'dokumen' => 'mimes:pdf|max:10000',
        ]);
        
        $anns = Announcement::findOrFail($id);
        $ayeuna = new DateTime(date('Y-m-d H:i:s'));
        $anns->update([
            'judul' => $request->subject,
            'isi' => $request->content,
            'status' => $request->status
        ]);

        $dok = $request->file('dokumen');

        if ($dok) {
            Storage::delete('storage/announcement' . $anns->dokumen);
            $Ann = $request->file('dokumen');
            $announ = $request->string('subject');
            $extann = $request->file('dokumen')->getClientOriginalExtension();
            $AnnName = $announ . '_' . time() . '.' . $extann;
            $Ann->storeAs('announcement/', $AnnName);
            $anns->update(['dokumen' => $AnnName]);
        }
        if ($anns) {
            //redirect dengan pesan sukses
            return redirect()->route('announcement.index')->with(['success' => 'Data Berhasil Diupdate!']);
        } else {
            //redirect dengan pesan error
            return redirect()->route('announcement.index')->with(['error' => 'Data Gagal Diupdate!']);
        }
    }
}

