<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class SensorDataExport implements FromCollection, WithHeadings, WithMapping, WithStyles, WithColumnWidths
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Return collection of data
     */
    public function collection()
    {
        return $this->data;
    }

    /**
     * Define headings
     */
    public function headings(): array
    {
        return [
            'ID',
            'Waktu',
            'Suhu (°C)',
            'Cahaya (Lux)',
            'Kelembapan (%)',
            'Status',
        ];
    }

    /**
     * Map data for each row
     */
    public function map($sensorData): array
    {
        return [
            $sensorData->id,
            $sensorData->waktu->format('d-m-Y H:i:s'),
            $sensorData->suhu,
            $sensorData->cahaya,
            $sensorData->kelembapan,
            $sensorData->status,
        ];
    }

    /**
     * Apply styles to the worksheet
     */
    public function styles(Worksheet $sheet)
    {
        return [
            // Style for header row
            1 => [
                'font' => [
                    'bold' => true,
                    'color' => ['rgb' => 'FFFFFF'],
                    'size' => 12,
                ],
                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'F97316'], // Orange color
                ],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER,
                ],
            ],
        ];
    }

    /**
     * Define column widths
     */
    public function columnWidths(): array
    {
        return [
            'A' => 8,  // ID
            'B' => 20, // Waktu
            'C' => 12, // Suhu
            'D' => 15, // Cahaya
            'E' => 16, // Kelembapan
            'F' => 12, // Status
        ];
    }
}