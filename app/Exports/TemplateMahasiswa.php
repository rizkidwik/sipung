<?php

namespace App\Exports;

use App\Models\Kelas;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;

class TemplateMahasiswa implements WithMultipleSheets
{
    public function sheets(): array
    {
        $sheets = [];

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
                    ['3. Untuk kolom "Kelas", silahkan isi sesuai dengan kelas yang ada di sheet "Data Kelas".'],
                    ['3. Untuk Kolom Tanggal Lahir, silahkan isi dengan format YYYY-MM-DD(ex: 2002-02-20)'],
                    // ['4. Untuk kolom No Telepon. Ubah FormatCell dari "General" ke "Text" untuk menampilkan angka 0 di depan nomor telepon.']
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
        $sheets[] = new class implements FromCollection, WithHeadings, WithTitle, WithStyles, ShouldAutoSize,WithColumnFormatting,WithColumnWidths
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
                return ['No', 'NIM', 'Nama','Kelas','Email','Tanggal Lahir','Jenis Kelamin(L/P)','Alamat','No Telp'];
            }

            public function columnFormats(): array
            {
                return [
                    'F2:F99' => NumberFormat::FORMAT_TEXT,
                    'I2:I99' => NumberFormat::FORMAT_TEXT,
                ];
            }

            public function styles(Worksheet $sheet)
            {
                // Apply bold formatting to specific cells in each sheet
                $sheet->getStyle('A1:I1')->applyFromArray([
                    'font' => [
                        'bold' => true,
                    ],
                ]);
        
                return [];
            }
            public function columnWidths(): array
            {
                return [
                    'B'     =>  10,
                    'C'     =>  15,
                    'E' => 15,
                    'D' => 15,
                    'H' => 10
                ];
            }
        };

        $sheets[] = new class implements FromCollection, WithHeadings, WithTitle, WithStyles, ShouldAutoSize
        {
            public function title(): string
            {
                return 'Data Kelas';
            }
            public function collection()
            {
                $kelasCollection = Kelas::all()->pluck('kelas_nama');
                // Add a sequential 'No' column
                $result = [];
                foreach ($kelasCollection as $index => $kelasNama) {
                    $result[] = [$index + 1, $kelasNama];
                }

                return collect($result);
            }

            public function headings(): array
            {
                return ['No', 'Kelas'];
            }

            public function styles(Worksheet $sheet)
            {
                // Apply bold formatting to specific cells in each sheet
                $sheet->getStyle('A1:H1')->applyFromArray([
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
