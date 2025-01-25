<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use App\Models\Matkul;

class TemplateDosen implements WithMultipleSheets
{
    public function sheets(): array
    {
        $sheets = [];

        // Sheet 1
        $sheets[] = new class implements FromCollection,  WithCustomStartCell, WithStyles, WithTitle
        {
            public function title(): string
            {
                return 'Petunjuk';
            }
            public function collection()
            {
                return collect([
                    ['Petunjuk Umum'],
                    ['1. Gunakan template ini sebagai panduan untuk mengisi data dengan benar.'],
                    ['2. Pastikan untuk tidak mengubah struktur template ini, termasuk urutan kolom dan nama kolom.'],
                    ['3. Untuk Kolom Kode Matkul yang diampu, silakan lihat di halaman mata-kuliah untuk melihat kode dari mata kuliah. Jika data belum ada, kosongkan saja.'],
                    ['4. Untuk kolom No Telepon. Ubah FormatCell dari "General" ke "Text" untuk menampilkan angka 0 di depan nomor telepon.']
                ]);
            }

            public function styles(Worksheet $sheet)
            {
                // Apply bold formatting to specific cells (e.g., A5, B5, C5)
                $sheet->getStyle('A4:A4')->applyFromArray([
                    'font' => [
                        'bold' => true,
                    ],
                ]);
                return [];
            }
            public function startCell(): string
            {
                return 'A4';
            }
        };

        // Sheet 2 (Add more sheets as needed)
        $sheets[] = new class implements FromCollection, WithHeadings, WithTitle, WithStyles, ShouldAutoSize
        {
            public function title(): string
            {
                return 'Template';
            }
            public function collection()
            {
                return collect();
            }

            public function headings(): array
            {
                return ['no', 'nama', 'pendidikan','no_telp','kode_matkul'];
            }

            public function styles(Worksheet $sheet)
            {
                // Apply bold formatting to specific cells in each sheet
                $sheet->getStyle('A1:E1')->applyFromArray([
                    'font' => [
                        'bold' => true,
                    ],
                ]);
        
                return [];
            }
        };

        $sheets[] = new class implements FromCollection, WithHeadings, WithTitle, WithStyles, ShouldAutoSize
        {
            public function title(): string
            {
                return 'Data_Matkul';
            }
            public function collection()
            {
                $matkul = Matkul::select('code','matkul')->get();
                return $matkul;
            }

            public function headings(): array
            {
                return ['Kode', 'Mata Kuliah'];
            }

            public function styles(Worksheet $sheet)
            {
                // Apply bold formatting to specific cells in each sheet
                $sheet->getStyle('A1:B1')->applyFromArray([
                    'font' => [
                        'bold' => true,
                    ],
                ]);
        
                return [];
            }
        };
        return $sheets;
    }
}
