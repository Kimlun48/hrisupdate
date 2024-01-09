<?php

use App\Http\Controllers\API\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ForgotPasswordController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::controller(AuthController::class)->group(function () {
    #Tanpa Req Token
    Route::post('/register', 'register');
    Route::post('/login', 'login');
    Route::apiResource('/cabang', App\Http\Controllers\API\CabangController::class);
    Route::apiResource('/apipt', App\Http\Controllers\API\ApiPerusahaanController::class);
    Route::apiResource('/apiloker', App\Http\Controllers\API\ApiLokerController::class);
    Route::post('password/email', [ForgotPasswordController::class, 'forgot']);
    Route::get('/verify/{id}/{notel}', [AuthController::class, 'verify']);
    Route::post('password/reset', [ForgotPasswordController::class, 'reset']);
    Route::get('/cekverify/{email}', [App\Http\Controllers\API\AuthController::class, 'cekverify'])->name('cekverify.cek_verify');
    Route::post('/resendemail', [App\Http\Controllers\API\AuthController::class, 'resentverif'])->name('resendemail.resentverif');
    Route::apiResource('/presensi', App\Http\Controllers\API\PresensiController::class);

    #Dengan Req Token
    Route::middleware('auth:sanctum')->group(function () {
        Route::prefix('/profile')->group(function () {
            Route::get('/', 'profile');
	    Route::post('/', 'update');
        });
        Route::post('/logout', 'logout');
        Route::post('/changepass', [AuthController::class, 'changepass']);
        Route::post('/wish', [App\Http\Controllers\API\WishlistController::class, 'store']);
        Route::get('/wishlist', [App\Http\Controllers\API\WishlistController::class, 'wishlist']);	
        Route::apiResource('/provinsi', App\Http\Controllers\API\ProvinsiController::class);
        Route::apiResource('/kota', App\Http\Controllers\API\KotaController::class);
        Route::apiResource('/kecamatan', App\Http\Controllers\API\KecamatanController::class);
        Route::apiResource('/desa', App\Http\Controllers\API\DesaController::class);
        Route::apiResource('/pelamar', App\Http\Controllers\API\PelamarController::class);
        Route::post('/pelamar/updateprofile/{idlamar}', [App\Http\Controllers\API\PelamarController::class,'updateprofile'])->name('pelamar.updateprofile');
        Route::post('/apiloker/saveaplly/{id_loker}/{id_lamar}/{id_user}', [App\Http\Controllers\API\ApiLokerController::class,'saveaplly'])->name('apiloker.saveaplly');
        Route::get('/apiloker/showcab/{kocab}', [App\Http\Controllers\API\ApiLokerController::class,'showcab'])->name('apiloker.showcab');
        Route::apiResource('/status', App\Http\Controllers\API\StatusLamarController::class);
        Route::get('/status/apply/{sts}', [App\Http\Controllers\API\StatusLamarController::class,'detail'])->name('status.detail');
        Route::get('/status/detlistapply/{usr}/{lok}', [App\Http\Controllers\API\StatusLamarController::class,'detlistapply'])->name('status.detlistapply');
	Route::get('/getpresensi/{id}', [App\Http\Controllers\API\PresensiController::class, 'getpresensi']);
	Route::get('/getbreaktime/{id}', [App\Http\Controllers\API\PresensiController::class, 'getbreaktime']);
	Route::get('/apikar', [App\Http\Controllers\API\KaryawanController::class, 'apikar']);
	Route::get('/offday', [App\Http\Controllers\API\PresensiController::class, 'offday'])->name('offday');
	Route::get('/getshifkar/{id}', [App\Http\Controllers\API\PresensiController::class, 'getshifkar'])->name('getshifkar');
        ###Subordinate
	Route::get('/apipressub', [App\Http\Controllers\API\KaryawanController::class, 'presensisubordinate']);
	Route::get('/kar/absenanakbuah', [App\Http\Controllers\API\KaryawanController::class, 'absenanakbuah']);
        Route::get('/kar/level_karyawan', [App\Http\Controllers\API\KaryawanController::class, 'level_karyawan']);
	### Time OFF
        Route::get('/timeoff',[App\Http\Controllers\API\TimeOffController::class, 'index'])->name('timeoff.index');
	#Route::apiResource('/timeoff', App\Http\Controllers\API\TimeOffController::class);
        Route::post('/timeoff/store', [\App\Http\Controllers\API\TimeOffController::class, 'store'])->name('timeoff.store');
	Route::get('/timeoff/listoff', [App\Http\Controllers\API\TimeOffController::class, 'listoff'])->name('timeoff.listoff');
	Route::get('/timeoff/getlistoff/{id}', [App\Http\Controllers\API\TimeOffController::class, 'getlistoff'])->name('timeoff.getlistoff');
	Route::get('/timeoff/levjab', [\App\Http\Controllers\API\TimeOffController::class, 'levjab'])->name('timeoff.levjab');
        Route::post('/timeoff/approvetimeoff/{id}', [\App\Http\Controllers\API\TimeOffController::class, 'approvetimeoff'])->name('timeoff.approvetimeoff');
        Route::get('/timeoff/listoffapprove', [\App\Http\Controllers\API\TimeOffController::class, 'listoff_approve'])->name('timeoff.listoffapprove');
        Route::get('/timeoff/listoffreject', [\App\Http\Controllers\API\TimeOffController::class, 'listoff_reject'])->name('timeoff.listoffreject');
        Route::get('/timeoff/karlistoff/{id}', [\App\Http\Controllers\API\TimeOffController::class, 'kar_listoff'])->name('timeoff.karlistoff');
        #Route::get('/timeoff/karlistoffreject/{id}', [\App\Http\Controllers\API\TimeOffController::class, 'kar_listoff_reject'])->name('timeoff.karlistoffreject');
        Route::get('/timeoff/listchoicetimeoff', [\App\Http\Controllers\API\TimeOffController::class, 'listchoicetimeoff'])->name('timeoff.listchoicetimeoff');
        Route::post('/timeoff/canceltimeoff', [\App\Http\Controllers\API\TimeOffController::class, 'canceltimeoff'])->name('timeoff.canceltimeoff');
        
        ##Inbox time off
        Route::get('/inbox', [\App\Http\Controllers\API\InboxController::class, 'index'])->name('inbox.index');
        Route::get('/inbox/manager', [\App\Http\Controllers\API\InboxController::class, 'indexmanager'])->name('inbox.indexmanager');
        Route::get('/inbox/subor', [\App\Http\Controllers\API\InboxController::class, 'inboxsubor'])->name('inbox.indexsubor');


        ##Over Time       
        Route::get('/over', [\App\Http\Controllers\API\OverTimeController::class, 'index'])->name('over.index');
        Route::post('/over/overstore', [\App\Http\Controllers\API\OverTimeController::class, 'overstore'])->name('over.overstore');
        Route::get('/over/getoverkar', [\App\Http\Controllers\API\OverTimeController::class, 'getoverkar'])->name('over.getoverkar');
        Route::get('/over/leadindexovertime', [\App\Http\Controllers\API\OverTimeController::class, 'lead_index_overtime'])->name('over.leadindexovertime');
        Route::post('/over/overtimeapproval', [\App\Http\Controllers\API\OverTimeController::class, 'overtimeapproval'])->name('over.overtimeapproval');
        ##Inbox req attendance
        Route::get('/inbox/reqattend/subor', [\App\Http\Controllers\API\InboxController::class, 'inboxsubor'])->name('inboxreq.indexsubor');
        Route::get('/inbox/reqattend/manager', [\App\Http\Controllers\API\InboxController::class, 'inboxsubor'])->name('inboxreq.indexsmanager');
        Route::post('/inbox/markmanager/{id}', [\App\Http\Controllers\API\InboxController::class, 'updateStatusAtasanToRead'])->name('inbox.markmanager');
        Route::post('/inbox/marksubor/{id}', [\App\Http\Controllers\API\InboxController::class, 'updateStatusBawahanToRead'])->name('inbox.marksubor');



	###Request Attendance
	Route::get('/reqattend/indexreqattend', [\App\Http\Controllers\API\PresensiRequestsController::class, 'indexreqattend'])->name('reqattend.indexreqattend');
	Route::get('/reqattend/karreqattend/{id}', [\App\Http\Controllers\API\PresensiRequestsController::class, 'karreqattend'])->name('reqattend.karreqattend');
	Route::post('/reqattend/savereqattend', [\App\Http\Controllers\API\PresensiRequestsController::class, 'savereqattend'])->name('reqattend.savereqattend');
	Route::post('/reqattend/approvereqattend/{id}', [\App\Http\Controllers\API\PresensiRequestsController::class, 'approvereqattend'])->name('reqattend.approvereqattend');
	Route::post('/reqattend/savebreak', [\App\Http\Controllers\API\PresensiRequestsController::class, 'savebreak'])->name('reqattend.savebreak');
        Route::get('/reqattend/getparamcabang', [\App\Http\Controllers\API\PresensiRequestsController::class, 'getparamcabang'])->name('reqattend.getparamcabang');

        Route::post('/reqattend/cancelreqpres', [\App\Http\Controllers\API\PresensiRequestsController::class, 'cancelreqpres'])->name('reqattend.cancelreqpres');
#----Change Shift Awal
        Route::post('/shift/changeshift', [\App\Http\Controllers\API\ShiftPresensiController::class, 'changeshift'])->name('shift.changeshift');
	Route::get('/shift/getparam', [\App\Http\Controllers\API\ShiftPresensiController::class, 'getparam'])->name('shift.getparam');
	Route::get('/shift/leadchshift', [\App\Http\Controllers\API\ShiftPresensiController::class, 'leadchshift'])->name('shift.leadchshift');
        Route::post('/shift/changeshiftapp', [\App\Http\Controllers\API\ShiftPresensiController::class, 'changeshiftapp'])->name('shift.changeshiftapp');
        Route::get('/shift/getchangeshift/{id}', [\App\Http\Controllers\API\ShiftPresensiController::class, 'getchangeshift'])->name('shift.getchangeshift');
        Route::post('/shift/cancelchangeshift', [\App\Http\Controllers\API\ShiftPresensiController::class, 'cancelchangeshift'])->name('shift.cancelchangeshift');
        


        #----Change Shift Akhir
	##Change Photo Profile Employee
        Route::put('/profile/changephoto/{id}', [App\Http\Controllers\API\ChangePhotoController::class, 'changephoto'])->name('profile.changephoto');

	###Anouncement
	Route::apiResource('/announ', \App\Http\Controllers\API\AnnouncementController::class);
        ##Tambahan Dinamic Form
	Route::post('/berkas/store', [\App\Http\Controllers\API\BerkasLamaranController::class, 'store'])->name('berkas.store');
        Route::get('/berkas/getberkas/{id}', [\App\Http\Controllers\API\BerkasLamaranController::class, 'getberkas'])->name('berkas.getberkas');
        Route::post('/keluarga/insert', [\App\Http\Controllers\API\KeluargaController::class, 'insert'])->name('keluarga.insert');
        Route::post('/keluarga/insertawal', [\App\Http\Controllers\API\KeluargaController::class, 'insertawal'])->name('keluarga.insertawal');
        Route::post('/pendidikan/insert', [\App\Http\Controllers\API\RiwayatPendidikanController::class, 'insert'])->name('pendidikan.insert');
        Route::post('/kerja/insert', [\App\Http\Controllers\API\RiwayatKerjaController::class, 'insert'])->name('kerja.insert');
        Route::post('/kesehatan/insert', [\App\Http\Controllers\API\RiwayatKesehatanController::class, 'insert'])->name('kesehatan.insert');
        Route::get('/keluarga/kel/{id}', [\App\Http\Controllers\API\KeluargaController::class, 'getkel'])->name('keluarga.getkel');
        Route::get('/pendidikan/didik/{id}', [\App\Http\Controllers\API\RiwayatPendidikanController::class, 'getdidik'])->name('pendidikan.getdidik');
        Route::get('/kerja/krj/{id}', [\App\Http\Controllers\API\RiwayatKerjaController::class, 'getkerja'])->name('kerja.getkerja');
        Route::get('/kesehatan/sehat/{id}', [\App\Http\Controllers\API\RiwayatKesehatanController::class, 'getsehat'])->name('kesehatan.getsehat');
        ##FIreBase
	Route::post('/send-push-notification', [App\Http\Controllers\API\AnnouncementController::class, 'sendPushNotification']);

    });##Ini Tutup URL YANG MENGGUNAKAN PERMITION SANCTUM
});

