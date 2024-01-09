<?php
 
namespace App\Http\Controllers;
use App\Models\User;
 
use Illuminate\Http\Request;
use Kreait\Firebase;
use Kreait\Firebase\Factory;


#use Kreait\Firebase\Messaging\CloudMessage;
#use Kreait\Firebase\ServiceAccount;

class FirebaseController extends Controller
{

    public function index()
    {
        $firebase = (new Factory)
            ->withServiceAccount(__DIR__.'/laravel-firebase-demo-8232d-firebase-adminsdk-x1xnw-40d3dce3e2.json')
            ->withDatabaseUri('https://laravel-firebase-demo-8232d-default-rtdb.asia-southeast1.firebasedatabase.app');#'https://laravel-firebase-demo-8b4b1-default-rtdb.firebaseio.com');
 
        $database = $firebase->createDatabase();
 
        $blog = $database
        ->getReference('blog');
 
        echo '<pre>';
        print_r($blog->getvalue());
        echo '</pre>';
    }
    ###BARUU
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function firindex()
    {
        return view('firebase.index');
    }
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function saveToken(Request $request)
    {
        auth()->user()->update(['device_token'=>$request->token]);
        return response()->json(['token saved successfully.']);
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function sendNotification(Request $request)
    {
        $firebaseToken = User::whereNotNull('device_token')->pluck('device_token')->all();
        $SERVER_API_KEY = 'AAAAh0sKUrQ:APA91bE_GW1p4poeSo7mVRC-O8ZbWnwj_6lVPqwhYz7Sr7-7GBTkfLzSwMjlz_O3gGq5JiMyWVCuCVHzI_1Nn2z0hwxB-V1MCZVkCTH8a7KHuUCMFdWWuihKVn759uNZ_CUEivoFoGLx';
        $data = [
            "registration_ids" => $firebaseToken,
            "notification" => [
                "title" => $request->title,
		"body" => $request->body,
                "content_available" => true,
                "priority" => "high",
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

	#dd($response);
	return response()->json(['Announcement Notification Broadcast Success!!.']);
    }

}



