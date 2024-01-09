<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Announcement;

class AnnouncementController extends Controller
{
    public function index()
    {
        $anns = Announcement::where('status','=','Aktif')->orderBy('id', 'DESC')->get(); #all();
        return response()->json(['success' => 'List Announcement', 'data' => $anns]);
    }


    ##COBA NOTIF API
    // Firebase Cloud Messaging Authorization Key
    const FCM_AUTH_KEY = 'AAAAh0sKUrQ:APA91bE_GW1p4poeSo7mVRC-O8ZbWnwj_6lVPqwhYz7Sr7-7GBTkfLzSwMjlz_O3gGq5JiMyWVCuCVHzI_1Nn2z0hwxB-V1MCZVkCTH8a7KHuUCMFdWWuihKVn759uNZ_CUEivoFoGLx';

    public function sendPushNotification(Request $request)
    {
        $to = $request->input('to');
        $title = $request->input('title');
        $body = $request->input('body');
        $icon = $request->input('icon');
        $url = $request->input('url');

        $result = $this->sendPush($to, $title, $body, $icon, $url);

        if ($result) {
            return response()->json(['message' => 'Push notification sent successfully','result'=>$result,'TO'=>$to], 200);
        } else {
            return response()->json(['message' => 'Failed to send push notification'], 500);
        }
    }

    private function sendPush($to, $title, $body, $icon, $url)
    {
	$data = ['key1' => 'Announcement'];
        $postdata = json_encode([
            'notification' => [
                'title' => $title,
                'body' => $body,
                'icon' => $icon,
                'click_action' => $url
	    ],
	    'data'=>$data,
            'to' => $to
        ]);

        $opts = [
            'http' => [
                'method'  => 'POST',
                'header'  => 'Content-type: application/json' . "\r\n" . 'Authorization: key=' . self::FCM_AUTH_KEY . "\r\n",
                'content' => $postdata
            ]
        ];

        $context  = stream_context_create($opts);

        $result = file_get_contents('https://fcm.googleapis.com/fcm/send', false, $context);
        if ($result) {
            return json_decode($result);
        } else {
            return false;
        }
    }

}

