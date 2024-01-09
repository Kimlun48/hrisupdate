<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class PushNotificationController extends Controller
{

    // Firebase Cloud Messaging Authorization Key
    const FCM_AUTH_KEY = 'AAAAh0sKUrQ:APA91bE_GW1p4poeSo7mVRC-O8ZbWnwj_6lVPqwhYz7Sr7-7GBTkfLzSwMjlz_O3gGq5JiMyWVCuCVHzI_1Nn2z0hwxB-V1MCZVkCTH8a7KHuUCMFdWWuihKVn759uNZ_CUEivoFoGLx';

    public function sendPushNotification(Request $request)
    {


        #$to = $request->input('to');
        #$title = $request->input('title');
        #$body = $request->input('body');
        #$icon = $request->input('icon');
        #$url = $request->input('url');
        #$result = $this->sendPush($to, $title, $body, $icon, $url);
        $tes_token = 'eeQxMesajT1utEEmMmIWi9:APA91bGy8KsL3kS55jB15C7HHYh-il1bGvYF5BhSFXz68J75inAKkeTf1DW4d3EbeXaJExW59uY5R-OeBF_nAlF-LBVnv2Z9-jbynVmQYCDTAdZxr1qjssMPe6RcIldM8f6DY5bc7Fan';
        ##Untuk Karyawan Bersangkutan
        $to = $request->input('to');
        $title = "Tes Request Presensi";
        $body = 'Tes Request Absen';
        $icon = $request->input('icon');
        $url = $request->input('url');
        $result = $this->sendPush($to, $title, $body, $icon, $url);

        ##Untuk Atasan
        #$to1 = $tes_token;
	#$title1 = 'INFOO APPROVAL';
	#$body1 = 'Bawahan Anda Meminta Approval Absensi title';
        #$icon1 = $request->input('icon');
        #$url1 = $request->input('url');
        #$result1 = $this->sendPushAtasan($to1, $title1, $body1, $icon1, $url1);

        if ($result) {
            return response()->json(['message' => 'Push notification sent successfully','result'=>$result,'TO'=>$to], 200);
        } else {
            return response()->json(['message' => 'Failed to send push notification'], 500);
        }
    }
    private function sendPushAtasan($to1, $title1, $body1, $icon1, $url1)
    {
        $data = [
            'key1' => 'RequestAttendace',
        ];

        $postdata = json_encode([
            'notification' => [
                'title' => $title1,
                'body' => $body1,
                'icon' => $icon1,
                'click_action' => $url1
	    ],
	    'data' => $data,
            'to' => $to1
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

    private function sendPush($to, $title, $body, $icon, $url)
    {
	 $data = [
            'key1' => 'RequestAttendace',
        ];
        $postdata = json_encode([
            'notification' => [
                'title' => $title,
                'body' => $body,
                'icon' => $icon,
                'click_action' => $url
	    ],
	    'data' => $data,
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

