<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Verifikasi;
use App\Models\Pelamar;
use App\Models\Apllyloker;
use App\Http\Resources\StatusLamarResource;
use App\Models\Loker;

class StatusLamarController extends Controller
{
    public function index()
    {

    $sts = Verifikasi::all();
        
	return new StatusLamarResource(true, 'List Data Status', $sts);
    }
    public function show()
    {
    //
    }
    public function detail($sts)
    {

    $app = Apllyloker::findOrFail($sts);
    $aa = Verifikasi::where('fk_apply', $app->id)->get();
    
	return new StatusLamarResource(true, 'Data Statusaaa ',$aa);

    }

        public function detlistapply($usr,$lok)
    {
        $ceklok = Loker::find($lok);
        $app = Apllyloker::where('user_id', $usr)->where('loker_id', $ceklok->id)->take(1)->get();
	return new StatusLamarResource(true, 'Data Apply ', $app);       
    }

}		
