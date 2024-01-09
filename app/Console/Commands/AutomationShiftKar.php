<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DateTime;

use Carbon\Carbon;
use Carbon\CarbonPeriod;
use App\Models\ParamPresensi;
use App\Models\Presensi;
use App\Models\Karyawan;
use App\Models\LogCrontab;
use Illuminate\Support\Facades\DB;
class AutomationShiftKar extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'automationshiftkar:cron';

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
        $startPeriod = new Carbon($tahundepan.'-01-01');
        $endPeriod = new Carbon($tahundepan.'-12-31');
        $period = CarbonPeriod::create($startPeriod, $endPeriod);
        // dd('ini tahun ya=',$request->tahun,'ini jenis Karyawan ya=',$request->jenis_karyawan, 'ini Periode ya=',$period);
        $kar = Karyawan::whereIn('status_karyawan',["AKTIF","Contract","PHL","Permanent","Probation","K3"])->get();
        $paroff = ParamPresensi::where('jenis_shift','=','Off')->where('status','=','Aktif')->first();
        $parho = ParamPresensi::where('jenis_shift','=','HO')->where('status','=','Aktif')->first();
        $parop1 = ParamPresensi::where('jenis_shift','=','OP1')->where('status','=','Aktif')->first();
        $buat = LogCrontab::create(['nama_menu' => "Shift Automatics Start",
                                    'tanggal' => date('Y-m-d'),
                                    'keterangan' => 'Created Success',
                                    'created_at' => date('Y-m-d H:i:s')
                                    ]);
        // Mulai transaksi database
        DB::beginTransaction();
        try {
            foreach ($kar as $kar) {
                foreach ($period as $dr) {
                $namaHari = $dr->format('l');
                if ($kar->fk_bagian == 2 ){##Untuk Supporting
                    if ($namaHari == "Sunday"){
                    $cr = Presensi::create(['tanggal' => $dr->format('Y-m-d'),'id_karyawan' => $kar->id,
                    'id_user' => 33, 'id_parampresensi' => $paroff->id,'created_at' => date('Y-m-d H:i:s')]);
                    }else{
                    $cr = Presensi::create(['tanggal' => $dr->format('Y-m-d'),'id_karyawan' => $kar->id,
                    'id_user' => 33, 'id_parampresensi' => $parho->id,'created_at' => date('Y-m-d H:i:s')]);
                    }
                }else{ ##Untuk Opertional
                    $cr = Presensi::create(['tanggal' => $dr->format('Y-m-d'),'id_karyawan' => $kar->id,
                    'id_user' => 33, 'id_parampresensi' => $parop1->id,'created_at' => date('Y-m-d H:i:s')]);
                }
                }
            }
            // Commit transaksi jika semuanya berhasil
            DB::commit();
            // Pesan sukses jika semuanya berhasil
            $buat = LogCrontab::create(['nama_menu' => "Shift Automatics Finish",
                                        'tanggal' => date('Y-m-d'),
                                        'keterangan' => 'Created Success',
                                        'created_at' => date('Y-m-d H:i:s')
                                      ]);
            // return response()->json(['message' => 'Data berhasil disimpan ke database']);
        } catch (\Exception $e) {
            // Tangani kesalahan jika terjadi kesalahan selama proses penyimpanan
            DB::rollback();
            // Keluarkan pesan error jika ada kesalahan
            $buat = LogCrontab::create(['nama_menu' => "Shift Automatics Finish (Have an Error)",
                                        'tanggal' => date('Y-m-d'),
                                        'keterangan' => 'Created Failed',
                                        'created_at' => date('Y-m-d H:i:s')
                                    ]);
            // return response()->json(['error' => 'Terjadi kesalahan saat menyimpan data ke database']);
        }
    }
}