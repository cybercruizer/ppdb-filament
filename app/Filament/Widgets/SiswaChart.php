<?php

namespace App\Filament\Widgets;

use Carbon\Carbon;
use App\Models\Siswa;
use Filament\Widgets\ChartWidget;

class SiswaChart extends ChartWidget
{
    protected static ?string $heading = 'Grafik Pendaftar';
    
    public ?string $filter = 'current_year';
    protected int | string | array $columnSpan = 'full';
    protected static ?string $maxHeight = '600px';
    
    protected function getFilters(): ?array
    {
        $currentYear = now()->year;
        $filters = [];
        
        // Add year options
        for ($year = $currentYear - 3; $year <= $currentYear; $year++) {
            $filters["year_{$year}"] = "Year {$year}";
        }
        
        // Add current year as default
        $filters['current_year'] = 'Tahun ini';
        
        // Add month options for current year
        for ($month = 1; $month <= 12; $month++) {
            $monthName = Carbon::create()->month($month)->format('F');
            $filters["month_{$month}_{$currentYear}"] = "{$monthName} {$currentYear}";
        }
        
        return $filters;
    }
    
    protected function getData(): array
    {
        $filter = $this->filter ?? 'current_year';
        
        if ($filter === 'current_year' || str_starts_with($filter, 'year_')) {
            return $this->getYearlyData($filter);
        } else {
            return $this->getMonthlyData($filter);
        }
    }
    
    private function getYearlyData(string $filter): array
    {
        if ($filter === 'current_year') {
            $year = now()->year;
        } else {
            $year = (int) str_replace('year_', '', $filter);
        }
        
        $startDate = Carbon::create($year)->startOfYear();
        $endDate = Carbon::create($year)->endOfYear();
        
        $data = Siswa::whereBetween('created_at', [$startDate, $endDate])
            ->selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->groupBy('month')
            ->orderBy('month')
            ->get()
            ->keyBy('month');
        
        $labels = [];
        $chartData = [];
        
        for ($month = 1; $month <= 12; $month++) {
            $labels[] = Carbon::create()->month($month)->format('M');
            $chartData[] = $data->get($month)->count ?? 0;
        }
        
        return [
            'datasets' => [
                [
                    'label' => "Calon siswa terdaftar pada {$year}",
                    'data' => $chartData,
                    'borderColor' => 'rgb(34, 197, 94)',
                    'backgroundColor' => 'rgba(34, 197, 94, 0.1)',
                    'fill' => true,
                    'tension' => 0.4,
                ],
            ],
            'labels' => $labels,
        ];
    }
    
    private function getMonthlyData(string $filter): array
    {
        $parts = explode('_', $filter);
        $month = (int) $parts[1];
        $year = (int) $parts[2];
        
        $startDate = Carbon::create($year, $month)->startOfMonth();
        $endDate = Carbon::create($year, $month)->endOfMonth();
        $daysInMonth = $endDate->day;
        
        $data = Siswa::whereBetween('created_at', [$startDate, $endDate])
            ->selectRaw('DAY(created_at) as day, COUNT(*) as count')
            ->groupBy('day')
            ->orderBy('day')
            ->get()
            ->keyBy('day');
        
        $labels = [];
        $chartData = [];
        
        for ($day = 1; $day <= $daysInMonth; $day++) {
            $labels[] = $day;
            $chartData[] = $data->get($day)->count ?? 0;
        }
        
        $monthName = Carbon::create($year, $month)->format('F Y');
        
        return [
            'datasets' => [
                [
                    'label' => "Pendaftar harian - {$monthName}",
                    'data' => $chartData,
                    'borderColor' => 'rgb(239, 68, 68)',
                    'backgroundColor' => 'rgba(239, 68, 68, 0.1)',
                    'fill' => true,
                    'tension' => 0.3,
                ],
            ],
            'labels' => $labels,
        ];
    }
    
    protected function getType(): string
    {
        return 'line';
    }
    
    
    protected function getOptions(): array
    {
        return [
            'responsive' => true,
            'maintainAspectRatio' => false,
            'scales' => [
                'y' => [
                    'beginAtZero' => true,
                    'ticks' => [
                        'stepSize' => 1,
                    ],
                ],
            ],
            'plugins' => [
                'legend' => [
                    'display' => true,
                ],
            ],
        ];
    }
}
