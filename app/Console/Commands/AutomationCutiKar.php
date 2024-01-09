<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use App\Models\Karyawan;
use App\Models\CutiKaryawan;
use App\Models\LogCrontab;
use Illuminate\Support\Facades\DB;
use DateTime;
class AutomationCutiKar extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'automationcutikaryawan:cron';

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
    public function handle(){
        $buat = LogCrontab::create(['nama_menu' => "CUTI Automatics PERKARYAWAN Start",
        'tanggal' => date('Y-m-d'),
        'keterangan' => 'Created Success',
        'created_at' => date('Y-m-d H:i:s')
    ]);
        $kars = Karyawan::whereIn('status_karyawan',["AKTIF","Contract","PHL","Permanent","Probation","K3"])->get();
        //DB::beginTransaction();
        //try {
            ##Tanggal HARI INI (Setahun Dia Kerja dari Tanggal Gabung)
            $tanggalAkhir = Carbon::parse(new DateTime(date('d-m-Y')));
            $tglakhir = $tanggalAkhir->format('m-d');
            $tgl_batas = new Carbon($tanggalAkhir->format('Y'). '-12-31'); //'-12-12');
            foreach ($kars as $kar) {
                ##Tanggal Gabung
                $tanggalAwal = Carbon::parse($kar->tahun_gabung);
                $tglawal = $tanggalAwal->format('m-d');

                #hitung berapa tahun Dia Bekerja
                $perbedaanTahun = $tanggalAwal->diffInYears($tanggalAkhir);

                if($tglawal == $tglakhir && $perbedaanTahun == 1){
                    $hitawal  = new Carbon($tanggalAkhir->format('Y-'). $tglawal);#Carbon::parse(new DateTime(date('d-m-Y')));
                    $hitakhir = new Carbon($tanggalAkhir->format('Y'). '-12-31');
                    $perbedaanbulan = $hitawal->diffInMonths($hitakhir);
                    $cek = CutiKaryawan::where('id_kar' ,'=',$kar->id)->where('tahun' ,'=', $hitakhir->format('Y'))->get()->first();
                    if(!($cek)){
                        $cr = CutiKaryawan::create(['mulai_cuti' => $hitawal,'id_kar' => $kar->id,
                        'akhir_cuti' => $hitakhir, 'jumlah_cuti' => $perbedaanbulan + 1,'sisa_cuti' => $perbedaanbulan + 1,'tahun' =>$hitakhir->format('Y')]);
                    }
                 
                  }
                    if($tglawal == $tglakhir && $perbedaanTahun == 1 && $tanggalAkhir >= $tgl_batas){
                        $taundepan = Carbon::now()->addYear(1);
                        $cek = CutiKaryawan::where('id_kar' ,'=',$kar->id)->where('tahun' ,'=', $taundepan->format('Y'))->get()->first();
                        if(!($cek)){
                            $cr = CutiKaryawan::create(['mulai_cuti' => $taundepan->format('Y-01-01'),'id_kar' => $kar->id,
                            'akhir_cuti' => $taundepan->format('Y-12-31'), 'jumlah_cuti' => 12,'sisa_cuti' => 12,'tahun' =>$taundepan->format('Y')]);
                        }
                 
                }   

            }

          //DB::commit();
          $buat = LogCrontab::create(['nama_menu' => "CUTI Automatics PERKARYAWAN Finish",
                                    'tanggal' => date('Y-m-d'),
                                    'keterangan' => 'Created Success',
                                    'created_at' => date('Y-m-d H:i:s')
                                    ]);
        // } catch (\Exception $e) {
        //     // Tangani kesalahan jika terjadi kesalahan selama proses penyimpanan
        //     DB::rollback();
        //     // Keluarkan pesan error jika ada kesalahan
        //     $buat = LogCrontab::create(['nama_menu' => "CUTI Automatics PERKARYAWAN Finish (Have an Error)",
        //                             'tanggal' => date('Y-m-d'),
        //                             'keterangan' => 'Created Failed',
        //                             'created_at' => date('Y-m-d H:i:s')
        //                         ]);
        // }
    }
}
