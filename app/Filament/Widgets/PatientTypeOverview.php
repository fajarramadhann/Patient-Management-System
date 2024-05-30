<?php

namespace App\Filament\Widgets;

use App\Models\Patient;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class PatientTypeOverview extends BaseWidget
{
    protected function getStats(): array // bikin method getStats type array buat bikin statistik jumlah
    {
        return [ // Array buat bikin statistik jumlah dari setiap tipe patient
            Stat::make('Cats', Patient::query()->where('type', 'cat')->count()),
            Stat::make('Dogs', Patient::query()->where('type', 'dog')->count()),
            Stat::make('Rabbits', Patient::query()->where('type', 'rabbit')->count()),
            Stat::make('Mammoth', Patient::query()->where('type', 'mammoth')->count()),
        ];
    }
}
