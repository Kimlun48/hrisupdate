<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use App\Models\Karyawan;
use App\Models\User;
use App\Models\LogCrontab;
use App\Models\Presensi;
use Illuminate\Support\Facades\DB;

class AutomationNonAktifUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'automationnonaktifuser:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $kars = Karyawan::whereIn('status_karyawan',["Contract","K3","Permanent","PHL","Probation","AKTIF"])->get();       
        $buat = LogCrontab::create(['nama_menu' => "None Aktif User Automatics Start",
                                    'tanggal' => date('Y-m-d'),
                                    'keterangan' => 'Created Success',
                                    'created_at' => date('Y-m-d H:i:s')
                                    ]);
        // DB::beginTransaction();
        // try {
        // foreach ($kar as $kar) {
        //    $mk = $kar->getAbsensiCount();
        //     if($mk > 7){
        //         // $user = User::find($kar->fk_user)->update(['status_aktif' => "NoneAktif"]);
        //         User::where('id',$kar->fk_user)->update([
        //             'status_aktif' => "NoneAktif"
        //         ]);
        //     }
        //   }
        $minggulalu = date('Y-m-d', strtotime(date('Y-m-d'). ' - 7 days'));
        $skr = date('Y-m-d');

        DB::beginTransaction();
        try {
            foreach ($kars as $kar) {
                $mk = Presensi::where('id_karyawan', $kar->id)->whereBetween('tanggal', [$minggulalu, $skr])
                ->where(function ($query) {
                    $query->whereNull('keterangan')->orWhere('presensi_status', 'off');
                })
                ->count();
                // $mk = $kar->getAbsensiCount();
                if($mk > 7){
                    $user = User::find($kar->fk_user)->update(['status_aktif' => "NoneAktif"]);
                }
            }
          DB::commit();
          $buat = LogCrontab::create(['nama_menu' => "None Aktif User Automatics Finish",
                                    'tanggal' => date('Y-m-d'),
                                    'keterangan' => 'Created Success',
                                    'created_at' => date('Y-m-d H:i:s')
                                    ]);
        } catch (\Exception $e) {
            // Tangani kesalahan jika terjadi kesalahan selama proses penyimpanan
            DB::rollback();
            // Keluarkan pesan error jika ada kesalahan
            $buat = LogCrontab::create(['nama_menu' => "None Aktif User Automatics Finish (Have an Error)",
                                    'tanggal' => date('Y-m-d'),
                                    'keterangan' => 'Created Failed',
                                    'created_at' => date('Y-m-d H:i:s')
                                ]);
        }
    }
}
