<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        // Commands\ParPeriod::class,
        Commands\AutomationShiftKar::class,
        Commands\AutomationCuti::class,
        Commands\AutomationTransefer::class,
        Commands\AutomationCutiKar::class,
        Commands\AutomationNonAktifUser::class,
    ];

    protected function schedule(Schedule $schedule)
    {

        //  Create Shif Otomatis
        $schedule->command('automationshiftkar:cron')
        ->yearlyOn(9, 8, '01:00'); #jalankan setiap tanggal 8 bulan 9 pada jam 01:05
       
        //  Jatah Cuti Otomatis
        $schedule->command('automationcuti:cron')
        ->yearlyOn(9, 8, '02:00'); #jalankan setiap tanggal 14 bulan 12 pada jam 01:05

        //  Transfer Otomatis
        $schedule->command('automationtransefer:cron')
        ->dailyAt('01:30'); #jalankan setiap hari pada jam 01:05
        // ->yearlyOn(9, 8, '01:30'); #jalankan setiap tanggal 14 bulan 12 pada jam 01:05

        //  Jatah Cuti Otomatis Perkaryawan Baru 1 Tahun
        $schedule->command('automationcutikaryawan:cron')
        //->dailyAt('09:34'); #jalankan setiap tanggal 14 bulan 12 pada jam 01:05
        ->dailyAt('14:15'); #jalankan setiap tanggal 14 bulan 12 pada jam 01:05

        // Auto Kunci karyawan yang tidak absen selama 7 hari Otomatis Perkaryawan Baru 1 Tahun
        $schedule->command('automationnonaktifuser:cron')
        ->dailyAt('16:25'); #jalankan setiap tanggal 14 bulan 12 pada jam 01:05
    }

    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
