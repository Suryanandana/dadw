<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadings;
use DateTime;
use Maatwebsite\Excel\Concerns\FromCollection;

class YearlySalesExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $year;

    public function __construct($year)
    {
        $this->year = $year;
    }

    public function collection()
    {
        return DB::table('booking')
            ->select(DB::raw('MONTH(date) as month, SUM(total) as total_sales'))
            ->whereYear('date', $this->year)
            ->groupBy(DB::raw('MONTH(date)'))
            ->get()
            ->map(function ($item) {
                $item->month = DateTime::createFromFormat('!m', $item->month)->format('F');
                return $item;
            });
    }

    public function headings(): array
    {
        return [
            'Month',
            'Total Sales',
        ];
    }
}
