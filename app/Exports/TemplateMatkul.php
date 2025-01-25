<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class TemplateMatkul implements WithMultipleSheets
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
                    ['2. Pastikan untuk tidak mengubah struktur template ini, termasuk urutan kolom dan nama kolom.']
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
        $sheets[] = new class implements FromCollection, WithHeadings, WithTitle
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
                return ['No', 'Kode', 'Nama Matkul'];
            }
        };

        return $sheets;
    }

    /**
     * @return array
     */
    public function styles(Worksheet $sheet)
    {
        // Apply bold formatting to specific cells in each sheet
        $sheet->getStyle('A1:C1')->applyFromArray([
            'font' => [
                'bold' => true,
            ],
        ]);

        return [];
    }
}
