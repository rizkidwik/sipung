<?php

namespace App\Exports;

use App\Models\Mahasiswa;
use App\Models\Pertemuan;
use App\Models\JadwalKuliah;
use App\Models\PertemuanDetails;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ReportPresensiJadwalExport implements FromView,ShouldAutoSize
{
    protected $id,$kelas_id;

    function __construct($id,$kelas_id)
    {
        $this->id = $id;
        $this->kelas_id = $kelas_id;
    }
    public function view(): View
    {
        return view('report.report-excel', [
            'jadwal' => JadwalKuliah::with('mataKuliah')->findOrFail($this->id),
            'pertemuans' => Pertemuan::with('logPertemuan')->where('jadwal_kuliah_id', $this->id)->get(),
            'mahasiswa' => PertemuanDetails::where('jadwal_kuliah_id',$this->id)->groupBy('user_id')->get(),
        ]);
    }
}
