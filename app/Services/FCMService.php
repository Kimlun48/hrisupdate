<?php
// app/Services/FCMService.php
// app/Services/FCMService.php

namespace App\Services;

use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;
use GuzzleHttp\Client;

class FCMService
{
    protected $firebase;
    protected $messaging;
    protected $client;

    public function __construct()
    {
        // Path ke file service account JSON
        $serviceAccountPath = base_path('storage/app/laravel-firebase-demo-8232d-firebase-adminsdk-x1xnw-40d3dce3e2.json');

        // Inisialisasi Firebase
        $this->firebase = (new Factory)->withServiceAccount($serviceAccountPath);
        $this->messaging = $this->firebase->createMessaging();
        $this->client = new Client();
    }

    // public function handleBackgroundMessage($data)
    // {
    //     // Handle payload notifikasi di sini
    //     // $data['title'] dan $data['body'] berisi informasi notifikasi

    //     Log::info('Background Message Received', $data);
    // }

    public function sendNotification($token, $title, $body)
    {
        // dd($title);
        // $message = CloudMessage::new()
        //     ->withNotification(['title' => $title, 'body' => $body])
        //     ->withData(['custom_title' => $title, 'custom_body' => $body]);


        // $FcmToken = auth()->user()->fcm_token;
        // $title = $request->input('title');
        // $body = $request->input('body');
        $message = CloudMessage::new([
            'token' => $token,
            'notification' => [
              'title' => $title,
               'body' => $body
              ],
           ]);

        $this->messaging->send(
            CloudMessage::withTarget('token', $token),
            false, // Tanda validasi hanya
            $message
        );



        // Alternatif: Jika Anda ingin menyertakan data tambahan, gunakan contoh di bawah ini
        
        // $this->messaging->send(
        //     CloudMessage::withTarget('token', $token),
        //     false, // Tanda validasi hanya
        //     $message
        //         ->withData(['key' => 'value'])
        // );
        

        return ['success' => true];
    }
}
