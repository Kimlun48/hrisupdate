<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use DateTime;

use Carbon\Carbon;
use Carbon\CarbonPeriod;

use App\Models\KaryawanTransfer;
use App\Models\Karyawan;
use App\Models\LogCrontab;
use Illuminate\Support\Facades\DB;

class AutomationTransefer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'automationtransefer:cron';

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
        
        $trans = KaryawanTransfer::where('status_approval','=',"Pending")->where('tgl_transfer','=',Carbon::now()->format('Y-m-d'))->get();
        $buat = LogCrontab::create(['nama_menu' => "TRANSFER Automatics Start",
                                    'tanggal' => date('Y-m-d'),
                                    'keterangan' => 'Created Success',
                                    'created_at' => date('Y-m-d H:i:s')
                                    ]);
        // return Command::SUCCESS;
        DB::beginTransaction();
        try {
        foreach ($trans as $tran) {
            $kar = Karyawan::find($tran->id_karyawan);
            $kar->fk_cabang               = $tran->fk_cabang;
            $kar->fk_bagian               = $tran->fk_bagian;
            $kar->fk_level_jabatan        = $tran->fk_level_jabatan;
            $kar->status_karyawan         = $tran->status_karyawan;
            $kar->fk_nama_perusahaan      = $tran->fk_nama_perusahaan;
            if ($tran->status_karyawan=="Permanent"){
                $kar->tanggal_pengangkatan    = date($tran->signdate);
                $kar->expired_kontrak         = null;#Carbon::createFromDate(9999, 12, 31);
            }else{
                $kar->tanggal_pengangkatan    = null;#Carbon::createFromDate(9999, 12, 31);
                $kar->expired_kontrak         = date($tran->signdate);
            }
            $kar->save();
            $tran->status_approval = "Approved";
            $tran->save();
            }
          DB::commit();
          $buat = LogCrontab::create(['nama_menu' => "TRANSFER Automatics Finish",
                                    'tanggal' => date('Y-m-d'),
                                    'keterangan' => 'Created Success',
                                    'created_at' => date('Y-m-d H:i:s')
                                    ]);
        } catch (\Exception $e) {
            // Tangani kesalahan jika terjadi kesalahan selama proses penyimpanan
            DB::rollback();
            // Keluarkan pesan error jika ada kesalahan
            $buat = LogCrontab::create(['nama_menu' => "TRANSFER Automatics Finish (Have an Error)",
                                    'tanggal' => date('Y-m-d'),
                                    'keterangan' => 'Created Failed'.$e,
                                    'created_at' => date('Y-m-d H:i:s')
                                ]);
        }
    }
}
