<?php

namespace App\Http\Controllers;
use App\Models\Karyawan;
use App\Models\Presensi;
use App\Models\TimeOff;

use Illuminate\Http\Request;

class CalendarController extends Controller
{
    public function index()
    {
        $karyawan = Karyawan::all();
        $prs = TimeOff::where('status_approve','=', 'approve' )->get();

        // Ubah data karyawan menjadi format yang sesuai untuk evoCalendar
        $events = [];
        foreach ($karyawan as $k) {
            $dateOfBirth = $k->tgl_lahir;
        
            // Periksa apakah tgl_lahir tidak kosong
            if (!empty($dateOfBirth)) {
                $dateOfBirth = \Carbon\Carbon::parse($dateOfBirth)->format('m/d/Y');
            } else {
                $dateOfBirth = ''; // Atur ke string kosong jika tgl_lahir kosong
            }
        
            // Tentukan rentang tanggal untuk badge
            $badgeText = '02/13 - 02/15'; // Teks yang akan ditampilkan di badge
        
            $events[] = [
                'id' => $k->id,
                'name' => $k->nama_lengkap,
                'date' => $dateOfBirth,
                'type' => 'birthday',
                'description' => "Happy Birthday!!", // Event description
                'everyYear' => true, // Setiap tahun
                'badge' => date('d/m/y', strtotime($dateOfBirth)),
            ];
        }
        

        $presen = [];
        foreach ($prs as $p) {
            $dateOfBirth = $p->tanggal;
        
            // Periksa apakah tgl_lahir tidak kosong
            if (!empty($dateOfBirth)) {
                $dateOfBirth = \Carbon\Carbon::parse($dateOfBirth)->format('m/d/Y');
            } else {
                $dateOfBirth = ''; // Atur ke string kosong jika tgl_lahir kosong
            }
        
            $presen[] = [
                'id' => $p->id,
                'name' => $p->karyawan->nama_lengkap,
                'date' => $dateOfBirth,
                'type' => 'TimeOff',
                'description'=> $p->statusoff, // Event description
                'everyYear' => false, // Setiap tahun
            ];
        }
        


        return view('calendar.index', compact('events','presen'));
    }
}
