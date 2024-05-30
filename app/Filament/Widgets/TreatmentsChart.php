<?php

namespace App\Filament\Widgets;

use App\Models\Treatment;
use Flowframe\Trend\Trend;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\TrendValue;

class TreatmentsChart extends ChartWidget
{
    protected static ?string $heading = 'Treatments';

    protected function getData(): array
    {
            /**
             * Ambil data tren dari model Treatment untuk periode satu tahun terakhir,
             * dipecah per bulan, dan hitung jumlah kejadian setiap bulan
             **/
            
            $data = Trend::model(Treatment::class) // ambil data tren dari model Treatment
                ->between( // menentukan data waktu untuk data tren, dari 1 tahun lalu hingga waktu saat ini
                    start: now()->subYear(),
                    end: now(),
                )
                ->perMonth() // dibagi perbulan
                ->count(); // jumlah perubahan setiap bulan

        return [
            'datasets' => [
                [
                    'label' => 'Treatments', // label buat chart
                    'data' => $data->map(fn (TrendValue $value) => $value->aggregate), // // Data buat dataset, ambil nilai aggregate dari setiap TrendValue
                ],
            ],
            'labels' => $data->map(fn (TrendValue $value) => $value->date), // Label untuk sumbu x pada grafik, mengambil tanggal dari setiap TrendValue
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
