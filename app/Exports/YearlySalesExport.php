<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;

class YearlySalesExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return DB::table('booking')
            ->select(DB::raw('YEAR(date) as year, SUM(total) as total_sales'))
            ->groupBy(DB::raw('YEAR(date)'))
            ->get();
    }

    public function headings(): array
    {
        return [
            'Year',
            'Total Sales',
        ];
    }
}
