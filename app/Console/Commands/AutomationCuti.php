<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use App\Models\Karyawan;
use App\Models\CutiKaryawan;
use App\Models\LogCrontab;
use Illuminate\Support\Facades\DB;

class AutomationCuti extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'automationcuti:cron';

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
        $tes = Carbon::now()->addYear(1);
        $tahundepan = $tes->format('Y');
        $mulai = new Carbon($tahundepan . '-01-01');
        $akhir = new Carbon($tahundepan . '-12-31');
        $kar = Karyawan::whereIn('status_karyawan',["Contract","K3","Permanent","PHL","Probation","AKTIF"])->get();
        
        $buat = LogCrontab::create(['nama_menu' => "CUTI Automatics Start",
                                    'tanggal' => date('Y-m-d'),
                                    'keterangan' => 'Created Success',
                                    'created_at' => date('Y-m-d H:i:s')
                                    ]);
        DB::beginTransaction();
        try {
        foreach ($kar as $kar) {
            $mk = $kar->get_masakerja();
            $parts = explode(' ', $mk);
            $year = (int)$parts[0];
            if($year >= 1){
                $cr = CutiKaryawan::create(['mulai_cuti' => $mulai,'id_kar' => $kar->id,
                    'akhir_cuti' => $akhir, 'jumlah_cuti' => 12,'sisa_cuti' => 12,'tahun' =>$tahundepan]);
                    }
            }
          DB::commit();
          $buat = LogCrontab::create(['nama_menu' => "CUTI Automatics Finish",
                                    'tanggal' => date('Y-m-d'),
                                    'keterangan' => 'Created Success',
                                    'created_at' => date('Y-m-d H:i:s')
                                    ]);
        } catch (\Exception $e) {
            // Tangani kesalahan jika terjadi kesalahan selama proses penyimpanan
            DB::rollback();
            // Keluarkan pesan error jika ada kesalahan
            $buat = LogCrontab::create(['nama_menu' => "CUTI Automatics Finish (Have an Error)",
                                    'tanggal' => date('Y-m-d'),
                                    'keterangan' => 'Created Failed',
                                    'created_at' => date('Y-m-d H:i:s')
                                ]);
        }
    }
}
