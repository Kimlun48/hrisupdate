<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Inbox;
use Illuminate\Http\Request;
use App\Models\Karyawan;
use Auth;
use App\Models\LevelJabatan;
use App\Models\PresensiRequest; 
use App\Models\TimeOff;


use App\Models\User;

class InboxController extends Controller
{
    public function index()
    {
        $inbox = Inbox::with('pengirim', 'penerima')->orderBy('created_at', 'desc')->get();

        return response()->json(['succes' => 'List Inbox' , 'data' => $inbox]);
    }

    ##index maneger 
    public function indexmanager()
    {
        $user_id = Auth::user();
        $cek_atasan = Karyawan::where('fk_level_jabatan', $user_id->getkaryawan->jabatan->parent_id)->latest()->first();
    
        $inbox = Inbox::with('pengirim', 'penerima')
            ->where('penerima_id', $user_id->id)
            ->orWhere('pengirim_id', $cek_atasan->fk_user)
            ->orderBy('created_at', 'desc')
            ->get();
    
        if ($inbox->isEmpty()) {
            return response()->json(['message' => 'Inbox is empty']);
        }
    
        $updatedInbox = $inbox->map(function ($item) {
            if ($item->id_time_offs) {
                $savetime = TimeOff::find($item->id_time_offs);
                $notes = $savetime->statusoff;

    
                $title = '';
                if ($savetime->status_approve === 'approve') {
                    $title .= ' Request Time Off '.$savetime->statusoff.' Approved';
                } elseif ($savetime->status_approve === 'reject') {
                    $title .= ' Request Time Off '.$savetime->statusoff.' Rejected';
                } else {
                    $title .= ' Request Time Off '.$savetime->statusoff.' Submitted';
                }
    
                $isi = '';
                if ($savetime->status_approve === 'approve') {
                    $isi_pengirim = 'Your Request Time Off ('. $savetime->statusoff .') has been ('. $savetime->status_approve .') on ('.$savetime->tanggal_approve.') , check in on ('.$savetime->tanggal.')';
                } elseif ($savetime->status_approve === 'reject') {
                    $isi_pengirim = 'Your Request Time Off ('. $savetime->statusoff .') has been ('. $savetime->status_approve .') on ('.$savetime->tanggal_approve.') , check in on ('.$savetime->tanggal.')';
                } else {
                    $isi_pengirim = 'Pengajuan Off Request Time Off ('. $savetime->statusoff .') has been submitted, please wait for approval from your superior!';
                }
    
                $item->title = $title;
                $item->isi_pengirim = $isi_pengirim;
                $item->notes = $notes;

            }
    
            return $item;
        });


        $updatedInbox = $inbox->map(function ($item) {
            if ($item->id_presensi_requests) {
                $presensiRequest = PresensiRequest::find($item->id_presensi_requests);
                $notes = $presensiRequest->notes;

                $item->notes = $notes;

            }
    
            return $item;
        });
    
        return response()->json(['success' => 'List Inbox', 'data' => $updatedInbox]);
    }
    

    
    ##index karyawan 
    public function inboxsubor()
    {
        $user_id = Auth::user()->id;
        $inbox = Inbox::with('pengirim', 'penerima')
            ->where(function ($query) use ($user_id) {
                $query->where('pengirim_id', $user_id)
                    ->orWhere('penerima_id', $user_id);
            })
            ->orderBy('created_at', 'desc')
            ->get();
            
	        if ($inbox->isEmpty()) {
                return response()->json(['message' => 'Inbox is empty','data'=>[]],200);
            }

            $updatedInbox = $inbox->map(function ($item) {
                if ($item->id_time_offs) {
                    $savetime = TimeOff::find($item->id_time_offs);
                    $statusoff = $savetime->statusoff;

        
                    $title = '';
                    if ($savetime->status_approve === 'approve') {
                        $title .= ' Request Time Off '.$savetime->statusoff.' Approved';
                    } elseif ($savetime->status_approve === 'reject') {
                        $title .= ' Request Time Off '.$savetime->statusoff.' Rejected';
                    } else {
                        $title .= ' Request Time Off '.$savetime->statusoff.' Submitted';
                    }
        
                    $isi = '';
                    if ($savetime->status_approve === 'approve') {
                        $isi_pengirim = 'Your Request Time Off ('. $savetime->statusoff .') has been ('. $savetime->status_approve .') on ('.$savetime->tanggal_approve.') , check in on ('.$savetime->tanggal.')';
                    } elseif ($savetime->status_approve === 'reject') {
                        $isi_pengirim = 'Your Request Time Off ('. $savetime->statusoff .') has been ('. $savetime->status_approve .') on ('.$savetime->tanggal_approve.') , check in on ('.$savetime->tanggal.')';
                    } else {
                        $isi_pengirim = 'Pengajuan Off Request Time Off ('. $savetime->statusoff .') has been submitted, please wait for approval from your superior!';
                    }
        
                    $item->title = $title;
                    $item->isi_pengirim = $isi_pengirim;
                    $item->statusoff = $statusoff;

                }
        
                return $item;
            });

            $updatedInbox = $inbox->map(function ($item) {
                if ($item->id_presensi_requests) {
                    $presensiRequest = PresensiRequest::find($item->id_presensi_requests);
                    $notes = $presensiRequest->notes;

                    $item->notes = $notes;

                }
        
                return $item;
            });
    
    
        return response()->json(['success' => 'List Inbox', 'data' => $updatedInbox]);

    }


    public function updateStatusBawahanToRead(Request $request ,$id)
    {
        $inbox = Inbox::find($id);

        // if (!$inbox) {
        //     return response()->json(['error' => 'Inbox not found'], 404);
        // }
        
        $inbox->status_bawahan = 'read';
        $inbox->save();

        return response()->json(['message' => 'Status bawahan updated to read'], 200);
    }

    public function updateStatusAtasanToRead(Request $request ,$id)
    {
        $inbox = Inbox::find($id);

        // if (!$inbox) {
        //     return response()->json(['error' => 'Inbox not found'], 404);
        // }
        
        $inbox->status_atasan = 'read';
        $inbox->save();

        return response()->json(['message' => 'Status atasan updated to read'], 200);
    }

    

}
