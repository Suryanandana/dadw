<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class TransactionExport implements FromCollection, WithMapping, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    use Exportable;

    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function collection()
    {
        return $this->data;
    }

    public function map($data): array
    {
        return [
            $data->service_name,
            $data->date,
            $data->pax,
            $data->price,
            $data->price * $data->pax,
        ];
    }

    public function headings(): array
    {
        return [
            'Service Name',
            'Order Date',
            'Total Pax',
            'Service Price',
            'Total Revenue',
        ];
    }
}
