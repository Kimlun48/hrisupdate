<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MemberShipController;
use App\Http\Controllers\WebcamController;
use App\Http\Controllers\SMSController;
use App\Http\Controllers\FirebaseController;
use App\Http\Controllers\PushNotificationController; ##Untuk Push Mobile Android
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|

Route::get('/', function () {
    return view('welcome');
});
*/



Route::group(['namespace' => 'App\Http\Controllers'], function () {
        /**
         * Home Routes
         */
        Route::get('/', 'HomeController@index')->name('home.index');
        Route::get('/dash', [\App\Http\Controllers\HomeController::class, 'dashboard'])->name('home.dash');
        Route::view('forgot_password', 'auth.reset_password')->name('password.reset');

        Route::group(['middleware' => ['guest']], function () {
                /**
                 * Register Routes
                 */
                Route::get('/register', 'RegisterController@show')->name('register.show');
                Route::post('/register', 'RegisterController@register')->name('register.perform');
                // Route::get('/nonaktif', [\App\Http\Controllers\SMSController::class, 'test2']);


                /**
                 * Login Routes
                 */
                Route::get('/login', 'LoginController@show')->name('login.show');
                Route::post('/login', 'LoginController@login')->name('login.perform');


                ##Forgot password OTP
                Route::get('/forgotpassword', [\App\Http\Controllers\SMSController::class, 'index'])->name('sms.index');
                Route::get('/otpindex', [\App\Http\Controllers\SMSController::class, 'otpindex'])->name('sms.otpindex');
                Route::get('/newpassword', [\App\Http\Controllers\SMSController::class, 'showResetForm'])->name('sms.newpassword');
                Route::post('/sendotp', [\App\Http\Controllers\SMSController::class, 'sendOTP'])->name('mass.sms');
                Route::post('/veriotp', [\App\Http\Controllers\SMSController::class, 'verifyOTP'])->name('verifyotp');
                Route::post('/resendotp', [\App\Http\Controllers\SMSController::class, 'resendOTP'])->name('resendOTP');
                Route::post('/resetpass', [\App\Http\Controllers\SMSController::class, 'resetPassword'])->name('sms.resetpass');
                Route::get('/mass-sms', [\App\Http\Controllers\SMSController::class, 'massms'])->name('indexmass.sms');
        });

        Route::group(['middleware' => ['auth', 'permission']], function () {
                /**
                 * Logout Routes
                 */
                Route::get('/logout', 'LogoutController@perform')->name('logout.perform');

                Route::resource('/posisijob', \App\Http\Controllers\PosisijobController::class);
                Route::get('/posisijob/edit/{id}', [\App\Http\Controllers\PosisijobController::class, 'edit'])->name('posisijob.edit');
                Route::get('/posisijob/read', [\App\Http\Controllers\PosisijobController::class, 'read']);
                Route::post('/posisijob/storeedit/{id}', [\App\Http\Controllers\PosisijobController::class, 'storeedit'])->name('posisijob.storeedit');

                // Route::resource('/loker', \App\Http\Controllers\LokerController::class);
                Route::get('/loker', [\App\Http\Controllers\LokerController::class, 'index'])->name('loker.index');
                Route::get('/loker/create', [\App\Http\Controllers\LokerController::class, 'create'])->name('loker.create');
                Route::post('/loker/store', [\App\Http\Controllers\LokerController::class, 'store'])->name('loker.store');
                Route::post('/loker/saveaplly/{idloker}/{idlamar}/{id_user}', [\App\Http\Controllers\LokerController::class, 'saveaplly'])->name('loker.saveaplly');
                Route::get('/loker/listapply/{id}', [\App\Http\Controllers\LokerController::class, 'listapply'])->name('loker.listapply');
                Route::get('/loker/detail/{id}', [\App\Http\Controllers\LokerController::class, 'detail'])->name('loker.detail');
                Route::get('/loker/nonactive', [\App\Http\Controllers\LokerController::class, 'nonactive']);
                Route::get('/loker/readdata', [\App\Http\Controllers\LokerController::class, 'show'])->name('loker.readdata');
                Route::get('/loker/readdata_nonactive', [\App\Http\Controllers\LokerController::class, 'nonactive']);
                #Route::get('/loker/nonactive', 'LokerController@nonactive');
                // Route::get('/loker/readdata/{status}', [\App\Http\Controllers\LokerController::class, 'readdata'])->name('loker.readdata');

                #Awal shift
                Route::get('/shift', [\App\Http\Controllers\ShiftPresensiController::class, 'index'])->name('shift.index');
                Route::get('/shift/read_data', [\App\Http\Controllers\ShiftPresensiController::class, 'read_data'])->name('shift.read_data');
                Route::get('/shift/search', [\App\Http\Controllers\ShiftPresensiController::class, 'search'])->name('shift.search');
                Route::get('/shift/showedit/{id}', [\App\Http\Controllers\ShiftPresensiController::class, 'showedit'])->name('shift.showedit');
                Route::post('/shift/update/{id}', [\App\Http\Controllers\ShiftPresensiController::class, 'update'])->name('shift.update');
                Route::post('/shift/shiftimport', [\App\Http\Controllers\ShiftPresensiController::class, 'shiftimport'])->name('shift.shiftimport');
                Route::get('/shift/shiftexport', [\App\Http\Controllers\ShiftPresensiController::class, 'shiftexport'])->name('shift.shiftexport');
                Route::get('/shift/shiftkar', [\App\Http\Controllers\ShiftPresensiController::class, 'index_shiftkar'])->name('shift.shiftkar');
                Route::get('/shift/read_shiftkar', [\App\Http\Controllers\ShiftPresensiController::class, 'shiftkar']);
                Route::get('/shift/karcreate', [\App\Http\Controllers\ShiftPresensiController::class, 'karcreate'])->name('shift.karcreate');
                Route::post('/shift/storechangeshift', [\App\Http\Controllers\ShiftPresensiController::class, 'storechangeshift'])->name('shift.storechangeshift');
                Route::get('/shift/requestshift', [\App\Http\Controllers\ShiftPresensiController::class, 'requestshift'])->name('shift.requestshift');
                Route::get('/shift/showupdate/{id}', [\App\Http\Controllers\ShiftPresensiController::class, 'showupdate'])->name('shift.showupdate');
                Route::post('/shift/approve/{id}', [\App\Http\Controllers\ShiftPresensiController::class, 'approve'])->name('shift.approve');
                Route::get('/shift/showreject/{id}', [\App\Http\Controllers\ShiftPresensiController::class, 'showreject'])->name('shift.showreject');
                Route::post('/shift/reject/{id}', [\App\Http\Controllers\ShiftPresensiController::class, 'reject'])->name('shift.reject');
                Route::get('/shift/approvalreqshift', [\App\Http\Controllers\ShiftPresensiController::class, 'approvalreqshift'])->name('shift.approvalreqshift');
                Route::get('/shift/exportExcel', [\App\Http\Controllers\ShiftPresensiController::class, 'exportExcel'])->name('shift.exportExcel');
                #akhir SHift

                Route::resource('/cabang', \App\Http\Controllers\CabangController::class);
                Route::get('/cabang/detail/{id}', [\App\Http\Controllers\CabangController::class, 'detail'])->name('cabang.detail');
                Route::post('/cabang/storeedit/{id}', [\App\Http\Controllers\CabangController::class, 'storeedit'])->name('cabang.storeedit');
                
                

                Route::resource('/perusahaan', \App\Http\Controllers\PerusahaanController::class);
                Route::get('/perusahaan/edit/{id}', [\App\Http\Controllers\PerusahaanController::class, 'edit'])->name('perusahaan.edit');
                Route::post('/perusahaan/storeedit/{id}', [\App\Http\Controllers\PerusahaanController::class, 'storeedit'])->name('perusahaan.storeedit');
                #Route::get('/pelamar', [\App\Http\Controllers\PelamarController::class, 'index']);

                //Route::resource('/pelamar', \App\Http\Controllers\PelamarsController::class);
                Route::get('/pelamar', [\App\Http\Controllers\PelamarsController::class, 'index'])->name('pelamar.index');
                Route::get('/pelamar/show', [\App\Http\Controllers\PelamarsController::class, 'show'])->name('pelamar.show');
                Route::get('/pelamar/showdetail/{id}', [\App\Http\Controllers\PelamarsController::class, 'showdetail'])->name('pelamar.detail');
                Route::get('/pelamar/showapp/{id}', [\App\Http\Controllers\PelamarsController::class, 'showapp']);
                Route::get('/pelamar/showrej/{id}', [\App\Http\Controllers\PelamarsController::class, 'showrej']);
                Route::get('/pelamar/readdata/{status}', [\App\Http\Controllers\PelamarsController::class, 'readdata']);
                Route::get('/pelamar/progres/{progress}', [\App\Http\Controllers\PelamarsController::class, 'viewproggress']);
                

                Route::resource('/verif', \App\Http\Controllers\VerifikasiController::class);
                Route::get('/verif/create/{id}', [\App\Http\Controllers\VerifikasiController::class, 'create'])->name('verif.create');
                Route::get('/verif/createoffering/{id}', [\App\Http\Controllers\VerifikasiController::class, 'createoffering'])->name('verif.createoffering');
                Route::get('/verif/createemploye/{id}', [\App\Http\Controllers\VerifikasiController::class, 'createemploye'])->name('verif.createemploye');
                Route::post('/verif/store/{id}', [\App\Http\Controllers\VerifikasiController::class, 'store'])->name('verif.store');
                Route::post('/verif/storeoffering/{id}', [\App\Http\Controllers\VerifikasiController::class, 'storeoffering'])->name('verif.storeoffering');
                Route::post('/verif/storeemploye/{id}', [\App\Http\Controllers\VerifikasiController::class, 'storeemploye'])->name('verif.storeemploye');
                Route::get('/employ/detail/{id}', [\App\Http\Controllers\EmployController::class, 'detail'])->name('employ.detail');
                Route::get('/myinfo/{id}', [\App\Http\Controllers\EmployController::class, 'myinfo'])->name('employ.myinfo');
                Route::get('/myinfo', [\App\Http\Controllers\EmployController::class, 'myinfo'])->name('employ.myinfo');
                Route::get('/verif/cetakol/{id}', [\App\Http\Controllers\VerifikasiController::class, 'cetakol'])->name('verif.cetakol');
                Route::post('/verif/storeapprove', [\App\Http\Controllers\VerifikasiController::class, 'storeapprove'])->name('verif.storeapprove');
                Route::post('/verif/storereject', [\App\Http\Controllers\VerifikasiController::class, 'storereject'])->name('verif.storereject');
                Route::get('/loker/edit/{id}', [\App\Http\Controllers\LokerController::class, 'edit'])->name('loker.edit');
                Route::post('/loker/storeedit/{id}', [\App\Http\Controllers\LokerController::class, 'storeedit'])->name('loker.storeedit');
                ##Edit Di profile User
                Route::get('/employ/showeditpersonaldata/{id}', [\App\Http\Controllers\EmployController::class, 'showeditpersonaldata']);#->name('employ.showeditpersonaldata');
                Route::post('/employ/storepersonalprofil', [\App\Http\Controllers\EmployController::class, 'storepersonalprofil']);#->name('employ.storepersonalprofil');
                Route::get('/employ/showidentityaddressprofile/{id}', [\App\Http\Controllers\EmployController::class, 'showidentityaddressprofile']);#->name('employ.showidentityaddressprofile');
                Route::post('/employ/saveidentityaddressprofile', [\App\Http\Controllers\EmployController::class, 'saveidentityaddressprofile']);#->name('employ.storeidentityaddressprofile');
                Route::get('/employ/showemploydata/{id}', [\App\Http\Controllers\EmployController::class, 'showeditemploydata']);#->name('employ.showidentityaddressprofile');
                Route::post('/employ/saveemploydata', [\App\Http\Controllers\EmployController::class, 'saveeditemploydata']);#->name('employ.storeidentityaddressprofile');
                ##Akhir Edit Di profile User
                #Time off
                Route::get('/timeoffops/cobacekcuti', [\App\Http\Controllers\TimeOffController::class, 'cobacekcuti']);
                Route::get('/timeoffops', [\App\Http\Controllers\TimeOffController::class, 'index_timeoff_ops']);#->name('timeoff.index');
                Route::get('/timeoffops/readall', [\App\Http\Controllers\TimeOffController::class, 'read_timeoff_ops']);#->name('timeoff.readall');
                Route::get('/timeoffops/readallreject', [\App\Http\Controllers\TimeOffController::class, 'reject_timeoff_ops']);#->name('timeoff.readall');
                Route::get('/timeoffops/readallapprove', [\App\Http\Controllers\TimeOffController::class, 'approve_timeoff_ops']);#->name('timeoff.readall');


                Route::get('/get-status-by-type/{type}',  [\App\Http\Controllers\TimeOffController::class, 'index']);

                
                Route::get('/timeoff', [\App\Http\Controllers\TimeOffController::class, 'index'])->name('timeoff.index');
                Route::get('/timeoff/reqtimeoff/{id}', [\App\Http\Controllers\TimeOffController::class, 'reqtimeoff'])->name('timeoff.reqtimeoff');
                Route::get('/timeoff/create', [\App\Http\Controllers\TimeOffController::class, 'create'])->name('timeoff.create');
                Route::post('/timeoff/store', [\App\Http\Controllers\TimeOffController::class, 'store'])->name('timeoff.store');
                Route::get('/timeoff/read/{id}', [\App\Http\Controllers\TimeOffController::class, 'read'])->name('timeoff.read');
                Route::get('/timeoff/readall', [\App\Http\Controllers\TimeOffController::class, 'readall'])->name('timeoff.readall');
                Route::get('/timeoff/readallapprove', [\App\Http\Controllers\TimeOffController::class, 'readallapprove'])->name('timeoff.readallapprove');
                Route::get('/timeoff/readallreject', [\App\Http\Controllers\TimeOffController::class, 'readallreject'])->name('timeoff.readallreject');
                Route::get('/timeoff/showupdate/{id}', [\App\Http\Controllers\TimeOffController::class, 'showupdate'])->name('timeoff.showupdate');
                Route::POST('/timeoff/approve/{id}', [\App\Http\Controllers\TimeOffController::class, 'approve'])->name('timeoff.approve');
                Route::get('/timeoff/showreject/{id}', [\App\Http\Controllers\TimeOffController::class, 'showreject'])->name('timeoff.showreject');
                Route::POST('/timeoff/reject/{id}', [\App\Http\Controllers\TimeOffController::class, 'reject'])->name('timeoff.reject');
                Route::get('/timeoff/levjab', [\App\Http\Controllers\TimeOffController::class, 'levjab'])->name('timeoff.levjab');
                ###PARAM CABANG UNTUK APPROVAL DAN KEDEPANNYA UNTUK PRESENSI JUGA
                Route::get('/parcab', [\App\Http\Controllers\ParamCabangController::class, 'index']);#->name('parcab.index');
                Route::get('/parcab/readdata', [\App\Http\Controllers\ParamCabangController::class, 'readdata']);#->name('parcab.index');
                Route::get('/parcab/showparam', [\App\Http\Controllers\ParamCabangController::class, 'showparam']);#->name('parcab.index');
                Route::get('/parcab/showedit/{id}', [\App\Http\Controllers\ParamCabangController::class, 'showedit']);#->name('parcab.index');
                Route::get('/parcab/showcreate', [\App\Http\Controllers\ParamCabangController::class, 'create']);#->name('parcab.index');
                Route::post('/parcab/saveparam', [\App\Http\Controllers\ParamCabangController::class, 'saveparam']);#->name('parcab.index');
                Route::post('/parcab/createallkarparam', [\App\Http\Controllers\ParamCabangController::class, 'createallkarparam']);#->name('parcab.index');createallkarparam
                #ReqAttendance
                Route::get('/reqattendance', [\App\Http\Controllers\PresensiRequestsController::class, 'index'])->name('reqattend.index');
                Route::get('/reqattendkar', [\App\Http\Controllers\PresensiRequestsController::class, 'reqattendkar'])->name('reqattend.reqattendkar');
                Route::get('/reqattend/create', [\App\Http\Controllers\PresensiRequestsController::class, 'create'])->name('reqattend.create');
                Route::post('/reqattend/store', [\App\Http\Controllers\PresensiRequestsController::class, 'store'])->name('reqattend.store');
                Route::get('/reqattend/readdata', [\App\Http\Controllers\PresensiRequestsController::class, 'readdata'])->name('reqattend.readdata');
                Route::get('/reqattend/readkaryawan', [\App\Http\Controllers\PresensiRequestsController::class, 'readkaryawan'])->name('reqattend.readkaryawan');
                Route::get('/reqattend/showupdate/{id}', [\App\Http\Controllers\PresensiRequestsController::class, 'showupdate'])->name('reqattend.showupdate');
                Route::post('/reqattend/approve/{id}', [\App\Http\Controllers\PresensiRequestsController::class, 'approve'])->name('reqattend.approve');
                Route::post('/reqattend/reject/{id}', [\App\Http\Controllers\PresensiRequestsController::class, 'reject'])->name('reqattend.reject');
                Route::get('/reqattend/showreject/{id}', [\App\Http\Controllers\PresensiRequestsController::class, 'showreject'])->name('reqattend.showreject');
                Route::get('/reqattend/showbreaktime', [\App\Http\Controllers\PresensiRequestsController::class, 'showbreaktime'])->name('reqattend.showbreaktime');
                Route::get('/reqattend/readbreaktime', [\App\Http\Controllers\PresensiRequestsController::class, 'readbreaktime'])->name('reqattend.readbreaktime');
                Route::get('/reqattend/addbreaktime', [\App\Http\Controllers\PresensiRequestsController::class, 'addbreaktime'])->name('reqattend.addbreaktime');
                Route::post('/reqattend/savebreak', [\App\Http\Controllers\PresensiRequestsController::class, 'savebreak'])->name('reqattend.savebreak');

                #Log_Request (UNTUK ROLE ADMIN)
                Route::get('/reqattend_admin', [\App\Http\Controllers\PresensiRequestsController::class, 'index_admin'])->name('reqattend.index_admin');
                Route::get('/reqattend/log_attendance_approve', [\App\Http\Controllers\PresensiRequestsController::class, 'log_attendance_approve'])->name('reqattend.log_attendance_approve');
                Route::get('/reqattend/log_attendance_reject', [\App\Http\Controllers\PresensiRequestsController::class, 'log_attendance_reject']);
                Route::get('/reqattend/log_timeoff_approve', [\App\Http\Controllers\TimeOffController::class, 'log_timeoff_approve']);
                Route::get('/reqattend/log_timeoff_reject', [\App\Http\Controllers\TimeOffController::class, 'log_timeoff_reject']);
                Route::get('/reqattend/log_changeshift_approve', [\App\Http\Controllers\ShiftPresensiController::class, 'log_changeshift_approve']);
                Route::get('/reqattend/log_changeshift_reject', [\App\Http\Controllers\ShiftPresensiController::class, 'log_changeshift_reject']);
                Route::get('/reqattend/log_overtime_approve', [\App\Http\Controllers\OverTimeController::class, 'log_overtime_approve']);
                Route::get('/reqattend/log_overtime_reject', [\App\Http\Controllers\OverTimeController::class, 'log_overtime_reject']);
                Route::get('/reqattend/readdata_admin', [\App\Http\Controllers\PresensiRequestsController::class, 'attendance_admin'])->name('reqattend.attendance_admin');
                Route::get('/shift/approvalreqshift_admin', [\App\Http\Controllers\ShiftPresensiController::class, 'approvalreqshift_admin']);
                Route::get('/ovtime/leadindexovertime_admin', [\App\Http\Controllers\OverTimeController::class, 'read_overtime_admin']);





                ##Announcement
                Route::get('/announcement', [\App\Http\Controllers\AnnouncementController::class, 'index'])->name('announcement.index');
                Route::post('/announcement/store', [\App\Http\Controllers\AnnouncementController::class, 'store'])->name('announcement.store');
                Route::get('/announcement/detail/{id}', [\App\Http\Controllers\AnnouncementController::class, 'detail'])->name('announcement.detail');
                Route::post('/announcement/storeedit/{id}', [\App\Http\Controllers\AnnouncementController::class, 'storeedit'])->name('announcement.storeedit');

                ####resignterminations Karyawan
                Route::get('/resignterm', [\App\Http\Controllers\ResignTerminationController::class, 'index'])->name('resignterm.index');
                Route::get('/resignterm/create', [\App\Http\Controllers\ResignTerminationController::class, 'create'])->name('resignterm.create');
                Route::post('/resignterm/storeresign', [\App\Http\Controllers\ResignTerminationController::class, 'storeresign'])->name('resignterm.storeresign');
                Route::get('/resignterm/readpersonal', [\App\Http\Controllers\ResignTerminationController::class, 'readpersonal'])->name('resignterm.readpersonal');

                #pasal
                Route::get('/pasal', [\App\Http\Controllers\PasalPelanggaranController::class, 'index'])->name('pasal.index');
                Route::get('/pasal/readpasal', [\App\Http\Controllers\PasalPelanggaranController::class, 'readpasal'])->name('pasal.readpasal');
                Route::get('/pasal/create', [\App\Http\Controllers\PasalPelanggaranController::class, 'create'])->name('pasal.create');
                Route::post('/pasal/store', [\App\Http\Controllers\PasalPelanggaranController::class, 'store'])->name('pasal.store');
                Route::post('/pasal/storeedit', [\App\Http\Controllers\PasalPelanggaranController::class, 'storeedit'])->name('pasal.storeedit');
                Route::get('/pasal/edit/{id}', [\App\Http\Controllers\PasalPelanggaranController::class, 'edit'])->name('pasal.edit');
                Route::post('/pasal/update/{id}', [\App\Http\Controllers\PasalPelanggaranController::class, 'update'])->name('pasal.update');
                Route::delete('/pasal/delete/{id}',  [\App\Http\Controllers\PasalPelanggaranController::class, 'destroy'])->name('pasal.destroy');
                Route::get('/pasal/showisi/{id}',  [\App\Http\Controllers\PasalPelanggaranController::class, 'showisi'])->name('pasal.showisi');

                #param
                Route::get('/param', [\App\Http\Controllers\ParamPresensiController::class, 'index'])->name('param.index');
                Route::get('/param/readparam', [\App\Http\Controllers\ParamPresensiController::class, 'readparam'])->name('param.readparam');
                Route::get('/param/create', [\App\Http\Controllers\ParamPresensiController::class, 'create'])->name('param.create');
                Route::post('/param/store', [\App\Http\Controllers\ParamPresensiController::class, 'store'])->name('param.store');
                Route::post('/param/storeedit', [\App\Http\Controllers\ParamPresensiController::class, 'storeedit'])->name('param.storeedit');
                Route::get('/param/edit/{id}', [\App\Http\Controllers\ParamPresensiController::class, 'edit'])->name('param.edit');



                ##jabatan
                Route::get('/jabatan', [\App\Http\Controllers\JabatanController::class, 'index'])->name('jabatan.index');
                Route::get('/jabatan/readjabatan', [\App\Http\Controllers\JabatanController::class, 'readjabatan'])->name('jabatan.readjabatan');
                Route::get('/jabatan/create', [\App\Http\Controllers\JabatanController::class, 'create'])->name('jabatan.create');
                Route::post('/jabatan/store', [\App\Http\Controllers\JabatanController::class, 'store'])->name('jabatan.store');
                Route::post('/jabatan/storeedit', [\App\Http\Controllers\JabatanController::class, 'storeedit'])->name('jabatan.storeedit');
                Route::get('/jabatan/edit/{id}', [\App\Http\Controllers\JabatanController::class, 'edit'])->name('jabatan.edit');
                Route::post('/jabatan/update/{id}', [\App\Http\Controllers\JabatanController::class, 'update'])->name('jabatan.update');
                Route::delete('/jabatan/delete/{id}',  [\App\Http\Controllers\JabatanController::class, 'destroy'])->name('jabatan.destroy');
                Route::get('/jabatan/showisi/{id}',  [\App\Http\Controllers\JabatanController::class, 'showisi'])->name('jabatan.showisi');
                Route::get('/jabatan/autofill',  [\App\Http\Controllers\JabatanController::class, 'autofill'])->name('jabatan.autofill');

                ###Fire Base
                Route::get('/firebase/firidex', [App\Http\Controllers\FirebaseController::class, 'firindex'])->name('firebase.firidex');
                Route::post('/send-push-notification', [App\Http\Controllers\PushNotificationController::class, 'sendPushNotification'])->name('send-push-notification');

                ##jabatan
                Route::get('/picapprove', [\App\Http\Controllers\PicApproveController::class, 'index']);#->name('picapprove.index');
                Route::get('/picapprove/readpic', [\App\Http\Controllers\PicApproveController::class, 'readpic']);#->name('picapprove.readpic');              
                Route::get('/picapprove/create', [\App\Http\Controllers\PicApproveController::class, 'create']);#->name('picapprove.create');
                Route::post('/picapprove/storecreate', [\App\Http\Controllers\PicApproveController::class, 'storecreate']);#->name('picapprove.storecreate');
                Route::get('/picapprove/edit/{id}', [\App\Http\Controllers\PicApproveController::class, 'edit']);#->name('picapprove.edit');
                Route::post('/picapprove/storeedit', [\App\Http\Controllers\PicApproveController::class, 'storeedit']);#->name('picapprove.storeedit');


                ##Employ
                Route::get('/employ/index_read', [\App\Http\Controllers\EmployController::class, 'index_read']);
                Route::get('/employ/index_read_external', [\App\Http\Controllers\EmployController::class, 'index_read_external']);
                

                Route::get('/employ', [\App\Http\Controllers\EmployController::class, 'index'])->name('employ.index');
                Route::get('/employ_filter', [\App\Http\Controllers\EmployController::class, 'index'])->name('employ.filter');
                Route::get('/employexternal', [\App\Http\Controllers\EmployController::class, 'index_external'])->name('employ.index_external');
                Route::get('/externalemploy', [\App\Http\Controllers\EmployController::class, 'exportexternal'])->name('employ.exportexternal');
                Route::get('/employ/external', [\App\Http\Controllers\EmployController::class, 'showexternal'])->name('employ.external');
                Route::get('/employ/searchexternal', [\App\Http\Controllers\EmployController::class, 'searchexter'])->name('employ.searchexternal');
                Route::get('/employ/searchinternal', [\App\Http\Controllers\EmployController::class, 'searchinter'])->name('employ.searchinternal');
                Route::post('/employ/sort', [\App\Http\Controllers\EmployController::class, 'sortEmploy'])->name('employ.sort');

                Route::get('/employ/showemploy', [\App\Http\Controllers\EmployController::class, 'showemploy'])->name('employ.showemploy');
                Route::get('/employ/showedit/{id}', [\App\Http\Controllers\EmployController::class, 'showedit'])->name('employ.showedit');
                Route::post('/employ/storeedit', [\App\Http\Controllers\EmployController::class, 'storeedit'])->name('employ.storeedit');
                Route::get('/employ/create', [\App\Http\Controllers\EmployController::class, 'create'])->name('employ.create');
                Route::get('/employ/create_external', [\App\Http\Controllers\EmployController::class, 'create_external'])->name('employ.create_external');
                Route::post('/employ/simpanaa', [\App\Http\Controllers\EmployController::class, 'simpanaa'])->name('employ.simpanaa');
                Route::post('/employ/simpanaa_external', [\App\Http\Controllers\EmployController::class, 'simpanaa_external'])->name('employ.simpanaa_external');
                Route::get('/employ/transfer/{id}', [\App\Http\Controllers\EmployController::class, 'showtransfer'])->name('employ.showtransfer');
                Route::post('/employ/storetransfer', [\App\Http\Controllers\EmployController::class, 'storetransfer'])->name('employ.storetransfer');
                Route::get('/employ/transferbulk/{id}', [\App\Http\Controllers\EmployController::class, 'showtransferbulk'])->name('employ.showtransferbulk');
                Route::post('/employ/storetransferbulk', [\App\Http\Controllers\EmployController::class, 'storetransferbulk'])->name('employ.storetransferbulk');
                Route::get('/employ/kontrak/{id}', [\App\Http\Controllers\EmployController::class, 'kontrak'])->name('employ.kontrak');
                Route::get('/employ/pkwt/{id}', [\App\Http\Controllers\EmployController::class, 'pkwt'])->name('employ.perjanjian');
                Route::get('/employ/bulkupdateinternal', [\App\Http\Controllers\EmployController::class, 'bulkupdateiternal'])->name('employ.bulkupdateiternal');
                Route::get('/employ/bulkupdateexternal', [\App\Http\Controllers\EmployController::class, 'bulkupdateexternal'])->name('employ.bulkupdateexternal');

                Route::get('/employ/readexternal', [\App\Http\Controllers\EmployController::class, 'indexexternal'])->name('employ.readexternal'); ###list external employ

                Route::get('/employ/sp/{id}', [\App\Http\Controllers\EmployController::class, 'sp'])->name('employ.sp');
                Route::get('/employ/showsp/{id}', [\App\Http\Controllers\EmployController::class, 'showsp'])->name('employ.showsp');
                Route::post('/employ/storesp', [\App\Http\Controllers\EmployController::class, 'storesp'])->name('employ.storesp');
                Route::get('/employ/cekpasal/{id}', [\App\Http\Controllers\EmployController::class, 'cekpasal'])->name('employ.cekpasal');
                Route::get('/employ/cek_email', [\App\Http\Controllers\EmployController::class, 'cekEmail']);
                ###Export Template Data Import Karyawan External
                Route::get('/employ/exporteksternal', [\App\Http\Controllers\EmployController::class, 'exporteksternal'])->name('employ.exporteksternal');
                ###Import Data External
                Route::get('/employ/eximindex', [\App\Http\Controllers\EmployController::class, 'eximindex'])->name('employ.eximindex');
                Route::post('/employ/externalimport', [\App\Http\Controllers\EmployController::class, 'externalkaryawanimport'])->name('employ.externalimport');
                ##Edit Bulk External
                Route::get('/employ/tempbulkex', [\App\Http\Controllers\EmployController::class, 'tempbulkex'])->name('employ.tempbulkex');
                Route::post('/employ/eksetempbulkex', [\App\Http\Controllers\EmployController::class, 'eksetempbulkex'])->name('employ.eksetempbulkex');
                Route::post('/employ/editbulkkaryawanexternal', [\App\Http\Controllers\EmployController::class, 'editbulkkaryawanexternal'])->name('employ.editbulkkaryawanexternal');
                ###Export Template Data Import Karyawan Internal
                Route::get('/employ/exportinternal', [\App\Http\Controllers\EmployController::class, 'exportinternal'])->name('employ.exportinternal');
                ##Edit Bulk Internal
                Route::post('/employ/editbulkkaryawaninternal', [\App\Http\Controllers\EmployController::class, 'editbulkkaryawaninternal'])->name('employ.editbulkkaryawaninternal');
                Route::post('/employ/intetempbulkex', [\App\Http\Controllers\EmployController::class, 'intetempbulkex'])->name('employ.intetempbulkex');
                #export internal dan external employ
                Route::post('/employ/exportemployeinternal', [\App\Http\Controllers\EmployController::class, 'exportemployeinternal'])->name('employ.exportemployeinternal');
                Route::post('/employ/exportemployeexternal', [\App\Http\Controllers\EmployController::class, 'exportemployeexternal'])->name('employ.exportemployeexternal');                        ######PARAMETER CUTI BULK
                // Route::get('/employ/bulkcutikar', [\App\Http\Controllers\EmployController::class, 'bulkcutikar'])->name('employ.bulkcutikar');
                Route::get('/cuti/bulkcutikar', [\App\Http\Controllers\CutiController::class, 'index'])->name('cuti.bulkcutikar');
                Route::post('/cuti/eksebulkcutikar', [\App\Http\Controllers\CutiController::class, 'eksebulkcutikar'])->name('cuti.eksebulkcutikar');
                Route::get('/cuti/cutiformatexcel', [\App\Http\Controllers\CutiController::class, 'cutiformatexcel'])->name('cuti.cutiformatexcel');
                Route::get('/cuti/readcuti', [\App\Http\Controllers\CutiController::class, 'readcuti'])->name('cuti.readcuti');
                Route::get('/cuti/create', [\App\Http\Controllers\CutiController::class, 'create'])->name('cuti.create');

                Route::get('/cuti/edit/{id}', [\App\Http\Controllers\CutiController::class, 'edit']);#->name('cuti.edit');            
                Route::post('/cuti/storeedit', [\App\Http\Controllers\CutiController::class, 'storeedit']);#->name('cuti.storeedit');
                ##SUBORDINATE
                Route::get('/employ/subordinate/Karyawan', [\App\Http\Controllers\EmployController::class, 'subkaryawan'])->name('employ.subkaryawan');
                Route::get('/employ/suborabsen', [\App\Http\Controllers\EmployController::class, 'presensisubordinate'])->name('employ.suborabsen');
                Route::get('/employ/subordinate/', [\App\Http\Controllers\EmployController::class, 'subordinate'])->name('employ.subordinate');

                ###TRANSFER KARYAWAN Internal
                Route::get('/trans', [\App\Http\Controllers\TransferKaryawanController::class, 'index']); #->name('trans.index');
                Route::get('/trans/read', [\App\Http\Controllers\TransferKaryawanController::class, 'read']); #->name('trans.read');
                Route::get('/trans/detail/{id}', [\App\Http\Controllers\TransferKaryawanController::class, 'detail']); #->name('trans.detail');
                Route::post('/trans/cancel/{id}', [\App\Http\Controllers\TransferKaryawanController::class, 'canceltransfer']); #->name('trans.detail');
                ###TRANSFER KARYAWAN Exernal
                Route::get('/transext', [\App\Http\Controllers\TransferKaryawanController::class, 'indexext']); #->name('trans.indexext');
                Route::get('/transext/readext', [\App\Http\Controllers\TransferKaryawanController::class, 'readext']); #->name('trans.readext');
                // Route::get('/trans/detail/{id}', [\App\Http\Controllers\TransferKaryawanController::class, 'detail']); #->name('trans.detail');
                // Route::post('/trans/cancel/{id}', [\App\Http\Controllers\TransferKaryawanController::class, 'canceltransfer']); #->name('trans.detail');

                ##untuk Transfer Baru yang employ nanti ga dipake
                Route::get('/trans/transfer/', [\App\Http\Controllers\TransferKaryawanController::class, 'showtransfer']); #->name('trans.showtransfer');
                Route::get('/trans/transferexternal/', [\App\Http\Controllers\TransferKaryawanController::class, 'showtransferexternal']); #->name('trans.showtransfer');
                Route::get('/trans/transferonclick/', [\App\Http\Controllers\TransferKaryawanController::class, 'transferonclick']); #->name('trans.showtransfer');
                Route::get('/trans/cekkartrans/{id}', [\App\Http\Controllers\TransferKaryawanController::class, 'cekkartrans']); #->name('trans.showtransfer');
                Route::post('/trans/storetransfer', [\App\Http\Controllers\TransferKaryawanController::class, 'storetransfer']); #->name('trans.storetransfer');
                Route::post('/trans/storetransferonclick', [\App\Http\Controllers\TransferKaryawanController::class, 'storetransferonclick']); #->name('trans.storetransferonclick');

                Route::get('/trans/getquerycabang/{id}', [\App\Http\Controllers\TransferKaryawanController::class, 'getquerycabang'])->name('trans.getquerycabang');
                ##OTP PASWORD
                Route::get('/showverify', [\App\Http\Controllers\SMSController::class, 'showVerificationForm'])->name('otp.show');
                Route::post('/verify', [\App\Http\Controllers\SMSController::class, 'verify'])->name('otp.verify');
                Route::post('/verify-otp', [\App\Http\Controllers\SMSController::class, 'verifyOTP'])->name('otp.verifyOTP');
                Route::get('/success', [\App\Http\Controllers\SMSController::class, 'showSuccessPage'])->name('otp.success');
                Route::get('/reset-password/{token}', [\App\Http\Controllers\SMSController::class, 'showResetForm'])->name('otp.password');
                Route::post('/reset-password', [\App\Http\Controllers\SMSController::class, 'reset'])->name('otp.resetPassword');

                ##Payroll
                Route::get('/payroll/index', [\App\Http\Controllers\ParamComponenController::class, 'index'])->name('payroll.index');

                ##Param Periode
                Route::get('/parperiode', [\App\Http\Controllers\ParamPeriodeController::class, 'index'])->name('parperiode.index');
                Route::get('/parperiode/readparam', [\App\Http\Controllers\ParamPeriodeController::class, 'readparam'])->name('parperiode.readparam');
                Route::get('/parperiode/create', [\App\Http\Controllers\ParamPeriodeController::class, 'create'])->name('parperiode.create');
                Route::post('/parperiode/store', [\App\Http\Controllers\ParamPeriodeController::class, 'store'])->name('parperiode.store');  
                Route::get('/parperiode/edit/{id}', [\App\Http\Controllers\ParamPeriodeController::class, 'edit'])->name('parperiode.edit');            
                Route::post('/parperiode/storeedit/{id}', [\App\Http\Controllers\ParamPeriodeController::class, 'storeedit'])->name('parperiode.storeedit');

                ##Param Time Off
                Route::get('/paroff', [\App\Http\Controllers\ParamTimeOffController::class, 'index'])->name('paroff.index');
                Route::get('/paroff/readparam', [\App\Http\Controllers\ParamTimeOffController::class, 'readparam'])->name('paroff.readparam');
                Route::get('/paroff/create', [\App\Http\Controllers\ParamTimeOffController::class, 'create'])->name('paroff.create');
                Route::post('/paroff/store', [\App\Http\Controllers\ParamTimeOffController::class, 'store'])->name('paroff.store');  
                Route::get('/paroff/edit/{id}', [\App\Http\Controllers\ParamTimeOffController::class, 'edit'])->name('paroff.edit');            
                Route::post('/paroff/storeedit/{id}', [\App\Http\Controllers\ParamTimeOffController::class, 'storeedit'])->name('paroff.storeedit');

                ###Param Jenis Karawan
                // ParamJenisKaryawanController
                Route::get('/parjeniskar', [\App\Http\Controllers\ParamJenisKaryawanController::class, 'index'])->name('parjeniskar.index');
                Route::get('/parjeniskar/readparam', [\App\Http\Controllers\ParamJenisKaryawanController::class, 'readparam'])->name('parjeniskar.readparam');
                Route::get('/parjeniskar/create', [\App\Http\Controllers\ParamJenisKaryawanController::class, 'create'])->name('parjeniskar.create');
                Route::post('/parjeniskar/store', [\App\Http\Controllers\ParamJenisKaryawanController::class, 'store'])->name('parjeniskar.store');  
                Route::get('/parjeniskar/edit/{id}', [\App\Http\Controllers\ParamJenisKaryawanController::class, 'edit'])->name('parjeniskar.edit');            
                Route::post('/parjeniskar/storeedit', [\App\Http\Controllers\ParamJenisKaryawanController::class, 'storeedit'])->name('parjeniskar.storeedit');

                ##Calender
                Route::get('/calendar', [\App\Http\Controllers\CalendarController::class, 'index'])->name('calender.index');            

                ##SMS Notif
                Route::get('/logsms', [\App\Http\Controllers\SMSController::class, 'showLog'])->name('logsms.sms');
                Route::post('/send-sms', [\App\Http\Controllers\SMSController::class, 'sendSMS'])->name('sms.kirim');

                ####resignterminations Approval
                Route::get('/resignterm/listajuresign', [\App\Http\Controllers\ResignTerminationController::class, 'listajuresign'])->name('resignterm.listajuresign');
                Route::get('/resignterm/listajuresign/external', [\App\Http\Controllers\ResignTerminationController::class, 'listajuresign_external'])->name('resignterm.listajuresign_external');
                Route::get('/resignterm/readallaju', [\App\Http\Controllers\ResignTerminationController::class, 'readallaju'])->name('resignterm.readallaju');
                Route::get('/resignterm/external/readallaju', [\App\Http\Controllers\ResignTerminationController::class, 'readallaju_external'])->name('resignterm.readallaju_external');
                Route::get('/resignterm/approve/{id}', [\App\Http\Controllers\ResignTerminationController::class, 'approve'])->name('resignterm.approve');
                Route::post('/resignterm/storeapprove', [\App\Http\Controllers\ResignTerminationController::class, 'storeapprove'])->name('resignterm.storeapprove');
                Route::get('/resignterm/reject/{id}', [\App\Http\Controllers\ResignTerminationController::class, 'reject'])->name('resignterm.reject');
                Route::post('/resignterm/rejectresign', [\App\Http\Controllers\ResignTerminationController::class, 'rejectresign'])->name('resignterm.rejectresign');
                Route::get('/resignterm/showphk/{id}', [\App\Http\Controllers\ResignTerminationController::class, 'showphk'])->name('resignterm.showphk');
                Route::post('/resignterm/storephk', [\App\Http\Controllers\ResignTerminationController::class, 'storephk'])->name('resignterm.storephk');
                Route::get('/resignterm/readalmostexpired', [\App\Http\Controllers\ResignTerminationController::class, 'readalmostexpired'])->name('resignterm.readalmostexpired');
                Route::get('/resignterm/external/readalmostexpired', [\App\Http\Controllers\ResignTerminationController::class, 'readalmostexpired_external'])->name('resignterm.readalmostexpired_external');
                Route::get('/resignterm/readexpired', [\App\Http\Controllers\ResignTerminationController::class, 'readexpired'])->name('resignterm.readexpired');
                Route::get('/resignterm/external/readexpired', [\App\Http\Controllers\ResignTerminationController::class, 'readexpired_external'])->name('resignterm.readexpired_external');
                Route::get('/resignterm/qpi/{id}', [\App\Http\Controllers\ResignTerminationController::class, 'qpi'])->name('resignterm.qpi');
                Route::get('/resignterm/sphk/{id}', [\App\Http\Controllers\ResignTerminationController::class, 'sphk'])->name('resignterm.sphk');
                Route::get('/resignterm/nonactive', [\App\Http\Controllers\ResignTerminationController::class, 'nonactive'])->name('resignterm.nonactive');
                Route::get('/resignterm/external/nonactive', [\App\Http\Controllers\ResignTerminationController::class, 'nonactive_external'])->name('resignterm.nonactive_external');
                Route::get('/resignterm/nonactiveemploy', [\App\Http\Controllers\ResignTerminationController::class, 'search'])->name('resignterm.search');
                Route::get('/resignterm/searchresign', [\App\Http\Controllers\ResignTerminationController::class, 'searchexpired'])->name('resignterm.searchexpired');
                Route::get('/resignterm/searchalmostexpired', [\App\Http\Controllers\ResignTerminationController::class, 'searchalmostexpired'])->name('resignterm.searchalmostexpired');

                #SP(SURAT PERINGATAN)
                Route::get('/sp', [\App\Http\Controllers\PeringatanController::class, 'index']);
                Route::get('/sp/approve', [\App\Http\Controllers\PeringatanController::class, 'read_approve']);
                Route::get('/sp/reject', [\App\Http\Controllers\PeringatanController::class, 'read_reject']);
                Route::get('/sp/readsp', [\App\Http\Controllers\PeringatanController::class, 'readsp']);
                Route::get('/sp/showapprove/{id}', [\App\Http\Controllers\PeringatanController::class, 'showapprove']);
                Route::post('/sp/storeapprovesp', [\App\Http\Controllers\PeringatanController::class, 'storeapprovesp']);
                Route::get('/sp/showreject/{id}', [\App\Http\Controllers\PeringatanController::class, 'showreject']);
                Route::post('/sp/storerejectsp', [\App\Http\Controllers\PeringatanController::class, 'storerejectsp']);


                #ParamComponen
                Route::get('/parcom', [\App\Http\Controllers\ParamComponenController::class, 'index'])->name('parcom.index');
                Route::get('/parcom/readparam', [\App\Http\Controllers\ParamComponenController::class, 'readparam'])->name('parcom.readparam');
                Route::get('/parcom/create', [\App\Http\Controllers\ParamComponenController::class, 'create'])->name('parcom.create');
                Route::get('/parcom/createcomponen', [\App\Http\Controllers\ParamComponenController::class, 'createcomponen'])->name('parcom.createcomponen');
                Route::post('/parcom/store', [\App\Http\Controllers\ParamComponenController::class, 'store'])->name('parcom.store');
                #Route::post('/parcom/storeedit', [\App\Http\Controllers\ParamComponenController::class, 'storeedit'])->name('parcom.storeedit');
                #Route::get('/parcom/edit/{id}', [\App\Http\Controllers\ParamComponenController::class, 'edit'])->name('parcom.edit');
                #Route::get('/parcom/cekinputparcom', [\App\Http\Controllers\ParamComponenController::class, 'cekinputparcom'])->name('parcom.cekinputparcom');
                Route::post('/parcom/storeedit/{id}', [\App\Http\Controllers\ParamComponenController::class, 'storeedit'])->name('parcom.storeedit');


                #Setting Parameter
                Route::get('/settings', [\App\Http\Controllers\SettingParamController::class, 'index'])->name('settings.index');

                ##Dokumen Karyawan
                Route::get('/dokar', [\App\Http\Controllers\DokumenKaryawanController::class, 'index'])->name('dokar.index');
                Route::get('/dokar/read', [\App\Http\Controllers\DokumenKaryawanController::class, 'read'])->name('dokar.read');
                Route::get('/dokar/create', [\App\Http\Controllers\DokumenKaryawanController::class, 'create'])->name('dokar.create');
                Route::get('/dokar/edit/{id}', [\App\Http\Controllers\DokumenKaryawanController::class, 'edit'])->name('dokar.edit');
                Route::post('/dokar/storecreate', [\App\Http\Controllers\DokumenKaryawanController::class, 'storecreate'])->name('dokar.storecreate');
                Route::post('/dokar/storeedit', [\App\Http\Controllers\DokumenKaryawanController::class, 'storeedit'])->name('dokar.storeedit');


                #Tunjangan Karyawan
                Route::get('/tunkar', [\App\Http\Controllers\TunjanganKaryawanController::class, 'index'])->name('tunkar.index');
                Route::get('/tunkar/create', [\App\Http\Controllers\TunjanganKaryawanController::class, 'create'])->name('tunkar.create');
                Route::post('/tunkar/store', [\App\Http\Controllers\TunjanganKaryawanController::class, 'store'])->name('tunkar.store');
                Route::get('/tunkar/readparam', [\App\Http\Controllers\TunjanganKaryawanController::class, 'readparam'])->name('tunkar.readparam');
                Route::get('/tunkar/autocomplete', [\App\Http\Controllers\TunjanganKaryawanController::class, 'autocomplete'])->name('tunkar.autocomplete');
                Route::get('/tunkar/cekkomponen/{id}', [\App\Http\Controllers\TunjanganKaryawanController::class, 'cekkomponen'])->name('tunkar.cekkomponen');

                #Rehire
                Route::get('/rehire', [\App\Http\Controllers\RehireController::class, 'index'])->name('rehire.index');
                Route::get('/rehire/readparam/{id}', [\App\Http\Controllers\RehireController::class, 'readparam'])->name('rehire.readparam');
                Route::get('/rehire/create/{id}', [\App\Http\Controllers\RehireController::class, 'create'])->name('rehire.create');
                Route::post('/rehire/store/', [\App\Http\Controllers\RehireController::class, 'store'])->name('rehire.store');
                Route::get('/rehire/getCounter', [\App\Http\Controllers\RehireController::class, 'getCounter']);


                #OverTime
                Route::get('/ovtime', [\App\Http\Controllers\OverTimeController::class, 'index'])->name('ovtime.index');
                Route::get('/ovtime/readdata', [\App\Http\Controllers\OverTimeController::class, 'readdata'])->name('ovtime.readdata');
                Route::get('/ovtime/detail/{id}', [\App\Http\Controllers\OverTimeController::class, 'detail'])->name('ovtime.detail');
                Route::get('/ovtime/create', [\App\Http\Controllers\OverTimeController::class, 'create'])->name('ovtime.create');
                Route::post('/ovtime/storeovertime/{id}', [\App\Http\Controllers\OverTimeController::class, 'storeovertime'])->name('ovtime.storeovertime');

                Route::get('/ovtime/ovtimekar', [\App\Http\Controllers\OverTimeController::class, 'ovtimekar'])->name('ovtime.ovtimekar');
                Route::get('/ovtime/bacadatakar', [\App\Http\Controllers\OverTimeController::class, 'bacadatakar'])->name('ovtime.bacadatakar');
                Route::get('/ovtime/createovertimekar', [\App\Http\Controllers\OverTimeController::class, 'createovertimekar'])->name('ovtime.createovertimekar');
                Route::post('/ovtime/storeovertimekar', [\App\Http\Controllers\OverTimeController::class, 'storeovertimekar'])->name('ovtime.storeovertimekar');
                Route::get('/ovtime/leadindexovertime', [\App\Http\Controllers\OverTimeController::class, 'read_lead_index_overtime'])->name('ovtime.leadindexovertime');
                Route::get('/ovtime/showupdate/{id}', [\App\Http\Controllers\OverTimeController::class, 'showupdate'])->name('ovtime.showupdate');
                Route::get('/ovtime/showreject/{id}', [\App\Http\Controllers\OverTimeController::class, 'showreject'])->name('ovtime.showreject');
                Route::post('/ovtime/overtimeapproval/{id}', [\App\Http\Controllers\OverTimeController::class, 'overtimeapproval'])->name('ovtime.overtimeapproval');
                
                ###COBA PRESENSI
                
                Route::get('/cobapresensi', [\App\Http\Controllers\CobaPresensiController::class, 'index']);#->name('ovtime.ovtimekar');             
                Route::get('/cobapresensi/cobacountindex', [\App\Http\Controllers\CobaPresensiController::class, 'cobacountindex']);#->name('ovtime.ovtimekar');             


                Route::get('/import', [\App\Http\Controllers\TesImportController::class, 'index']);
                Route::post('/import/preview', [\App\Http\Controllers\TesImportController::class, 'preview']);#->name('import.preview');

                /**
                 * User Routes
                 */
                Route::group(['prefix' => 'users'], function () {
                        Route::get('/', 'UsersController@index')->name('users.index');
                        Route::get('/create', 'UsersController@create')->name('users.create');
                        Route::post('/create', 'UsersController@store')->name('users.store');
                        Route::get('/{user}/show', 'UsersController@show')->name('users.show');
                        Route::get('/{user}/edit', 'UsersController@edit')->name('users.edit');
                        Route::patch('/{user}/update', 'UsersController@update')->name('users.update');
                        Route::delete('/{user}/delete', 'UsersController@destroy')->name('users.destroy');
                });
                Route::resource('roles', RolesController::class);
                Route::resource('permissions', PermissionsController::class);
                #Route::resource('/employ', \App\Http\Controllers\EmployController::class);
                Route::resource('/announcement', \App\Http\Controllers\AnnouncementController::class);
                Route::get('/presensi', [\App\Http\Controllers\PresensiController::class, 'index']);
                Route::get('/presensi/external', [\App\Http\Controllers\PresensiController::class, 'index_external'])->name('presensi.index_external');
                Route::get('/presensi/read', [\App\Http\Controllers\PresensiController::class, 'readpresensi'])->name('presensi.read');
                Route::get('/presensi/read/external', [\App\Http\Controllers\PresensiController::class, 'readpresensi_external'])->name('presensi.read_external');
                Route::get('/presensi/countindex', [\App\Http\Controllers\PresensiController::class, 'countindex'])->name('presensi.countindex');
                Route::get('/presensi/countindex/external', [\App\Http\Controllers\PresensiController::class, 'countindex_external'])->name('presensi.countindex_external');

                Route::get('/presensi/readpresensifilterview', [\App\Http\Controllers\PresensiController::class, 'readpresensifilterview'])->name('presensi.readpresensifilterview');
                Route::get('/presensi/readpresensifilterview_external', [\App\Http\Controllers\PresensiController::class, 'readpresensifilterview_external'])->name('presensi.readpresensifilterview_external');
                // Route::get('/presensi/kehadiran', [\App\Http\Controllers\PresensiController::class, 'kehadiran']);#->name('presensi.kehadiran');
                // kehadiran di shift
                Route::get('/shift/shiftexportkehadiran', [\App\Http\Controllers\ShiftPresensiController::class, 'shiftexportkehadiran'])->name('shift.shiftexportkehadiran');
                Route::get('/shift/export/syis', [\App\Http\Controllers\ShiftPresensiController::class, 'shiftExportKehadiranSyis'])->name('shift.shiftexportkehadiransyis');
                
                //RouteModalDailyAttend
                Route::get('/presensi/earlyin', [\App\Http\Controllers\PresensiController::class, 'earlyin']);
                Route::get('/presensi/ontime', [\App\Http\Controllers\PresensiController::class, 'ontime']);
                Route::get('/presensi/latein', [\App\Http\Controllers\PresensiController::class, 'latein']);
                Route::get('/presensi/attendin', [\App\Http\Controllers\PresensiController::class, 'attendin']);
                Route::get('/presensi/timeoff', [\App\Http\Controllers\PresensiController::class, 'timeoff']);
                Route::get('/presensi/dayoff', [\App\Http\Controllers\PresensiController::class, 'dayoff']);
                Route::get('/presensi/absen', [\App\Http\Controllers\PresensiController::class, 'absen']);
                Route::get('/presensi/noclockin', [\App\Http\Controllers\PresensiController::class, 'noclockin']);
                Route::get('/presensi/noclockout', [\App\Http\Controllers\PresensiController::class, 'noclockout']);
                Route::get('/logpresensi/{id}', [\App\Http\Controllers\PresensiController::class, 'logpresensikar'])->name('presensi.logpresensikar');
                Route::get('/breaktime', [\App\Http\Controllers\PresensiController::class, 'breaktime'])->name('presensi.breaktime');
                Route::get('/presensi/foto', [\App\Http\Controllers\PresensiController::class, 'showcapture'])->name('presensi.foto');
                Route::post('/presensi/capturestore', [\App\Http\Controllers\PresensiController::class, 'capturestore'])->name('presensi.capturestore');
                Route::get('/presensi/exportmodal', [\App\Http\Controllers\PresensiController::class, 'exportmodal'])->name('presensi.exportmodal');
                Route::get('/presensi/exportmodal_external', [\App\Http\Controllers\PresensiController::class, 'exportmodal_external'])->name('presensi.exportmodal_external');
                Route::get('/presensi/showedit/{id}', [\App\Http\Controllers\PresensiController::class, 'showedit'])->name('presensi.showedit');
                Route::post('/presensi/edit/{id}', [\App\Http\Controllers\PresensiController::class, 'editpresensi'])->name('presensi.edit');
                Route::get('/presensi/detail/{id}', [\App\Http\Controllers\PresensiController::class, 'indexdetailpresensi'])->name('presensi.detail');
                Route::get('/presensi/detail/external/{id}', [\App\Http\Controllers\PresensiController::class, 'indexdetailpresensi_external'])->name('presensi.indexdetailpresensi_external');
                Route::get('/presensi/readdetail/{id}', [\App\Http\Controllers\PresensiController::class, 'readdatadetail'])->name('presensi.readdetail');
                Route::get('/presensi/readdetail/external/{id}', [\App\Http\Controllers\PresensiController::class, 'readdatadetail_external'])->name('presensi.readdatadetail_external');
                Route::get('/presensi/countdetail/{id}', [\App\Http\Controllers\PresensiController::class, 'countdetail'])->name('presensi.countdetail');
                Route::get('/presensi/countdetail/external/{id}', [\App\Http\Controllers\PresensiController::class, 'countdetail_external'])->name('presensi.countdetail_external');
                // Route::get('/presensi/counter', [\App\Http\Controllers\PresensiController::class, 'counter'])->name('presensi.counter');

                ## Detail Modal Daily Internal
                Route::get('/presensi/detail/internal/earlyin', [\App\Http\Controllers\PresensiController::class, 'earlyin']);
                Route::get('/presensi/detail/internal/ontime', [\App\Http\Controllers\PresensiController::class, 'ontime']);
                Route::get('/presensi/detail/internal/latein', [\App\Http\Controllers\PresensiController::class, 'latein']);
                Route::get('/presensi/detail/internal/attend', [\App\Http\Controllers\PresensiController::class, 'attendin']);
                Route::get('/presensi/detail/internal/timeoff', [\App\Http\Controllers\PresensiController::class, 'timeoff']);
                Route::get('/presensi/detail/internal/dayoff', [\App\Http\Controllers\PresensiController::class, 'dayoff']);
                Route::get('/presensi/detail/internal/absen', [\App\Http\Controllers\PresensiController::class, 'absen']);
                Route::get('/presensi/detail/internal/noclockin', [\App\Http\Controllers\PresensiController::class, 'absen']);
                Route::get('/presensi/detail/internal/noclockout', [\App\Http\Controllers\PresensiController::class, 'absen']);
 
                ## Detail Modal Daily External
                Route::get('/presensi/detail/external/earlyin', [\App\Http\Controllers\PresensiController::class, 'earlyin']);
                Route::get('/presensi/detail/external/ontime', [\App\Http\Controllers\PresensiController::class, 'ontime']);
                Route::get('/presensi/detail/external/latein', [\App\Http\Controllers\PresensiController::class, 'latein']);
                Route::get('/presensi/detail/external/attend', [\App\Http\Controllers\PresensiController::class, 'attendin']);
                Route::get('/presensi/detail/external/timeoff', [\App\Http\Controllers\PresensiController::class, 'timeoff']);
                Route::get('/presensi/detail/external/dayoff', [\App\Http\Controllers\PresensiController::class, 'dayoff']);
                Route::get('/presensi/detail/external/absen', [\App\Http\Controllers\PresensiController::class, 'absen']);
                Route::get('/presensi/detail/external/noclockin', [\App\Http\Controllers\PresensiController::class, 'absen']);
                Route::get('/presensi/detail/external/noclockout', [\App\Http\Controllers\PresensiController::class, 'absen']);

                Route::get('/show-image-from-ftp', [\App\Http\Controllers\PresensiController::class, 'showImageFromFTP']);
                Route::get('/presensi/createshift', [\App\Http\Controllers\PresensiController::class, 'createshift']);
                Route::post('/presensi/eksekusicreateshift', [\App\Http\Controllers\PresensiController::class, 'eksekusicreateshift']);#->name('presensi.capturestore');


                Route::get('/presensi/tesupdatepresensi', [\App\Http\Controllers\PresensiController::class, 'tesupdatepresensi']);
                
                ##Setting Parameter



                


   


                Route::controller(UserController::class)->group(function () {
                        Route::get('eximp', 'eximp')->name('eximp');
                        Route::get('export', 'export')->name('export');
                        Route::post('import', 'import')->name('import');



                });
        });

});



Route::get('webcam', [WebcamController::class, 'index']);
Route::post('webcam', [WebcamController::class, 'store'])->name('webcam.capture');
Route::get('/member', [MemberShipController::class, 'index'])->name('member');
Route::get('/member/create', [MemberShipController::class, 'create'])->name('member.create');
Route::post('/member/store', [MemberShipController::class, 'store'])->name('member.store');
Route::get('/member/detail/{id}', [MemberShipController::class, 'detail'])->name('member.detail');
Route::get('/member/edit/{id}', [MemberShipController::class, 'edit'])->name('member.edit');
Route::post('/member/storeedit/{id}', [MemberShipController::class, 'storeedit'])->name('member.storeedit');

##COBA FIREBASE
Route::get('get-firebase-data', [FirebaseController::class, 'index'])->name('firebase.index');

Route::post('/fire/save-token', [App\Http\Controllers\FirebaseController::class, 'saveToken'])->name('firebase.save-token');
Route::post('/fire/send-notification', [App\Http\Controllers\FirebaseController::class, 'sendNotification'])->name('firebase.notification');

###MOBILE NOTIF
Route::get('/employ/shownotif', [\App\Http\Controllers\EmployController::class, 'indexfire'])->name('employ.shownotif');


Route::get('/gettoken', [FirebaseController::class, 'getToken'])->name('firebase.getToken');
