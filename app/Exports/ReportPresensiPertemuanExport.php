<?php

namespace App\Exports;

use App\Models\Mahasiswa;
use App\Models\Pertemuan;
use App\Models\PertemuanDetails;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ReportPresensiPertemuanExport implements FromView,ShouldAutoSize
{
    protected $id,$kelas_id;

    function __construct($id,$kelas_id)
    {
        $this->id = $id;
        $this->kelas_id = $kelas_id;
    }
    public function view(): View
    {
        return view('report.report-excel-pertemuan', [
            'pertemuan' => Pertemuan::with('logPertemuan')->findOrFail($this->id),
            'mahasiswa' => PertemuanDetails::where('pertemuan_id',$this->id)->groupBy('user_id')->get(),
        ]);
    }
}
