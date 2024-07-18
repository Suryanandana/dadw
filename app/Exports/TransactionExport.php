<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class TransactionExport implements FromCollection, WithHeadings
{
    protected $start_date;
    protected $end_date;

    public function __construct($start_date, $end_date)
    {
        $this->start_date = $start_date;
        $this->end_date = $end_date;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $query = DB::table('order_services')
            ->join('booking', 'order_services.id_booking', '=', 'booking.id')
            ->join('services', 'order_services.id_services', '=', 'services.id')
            ->select('services.service_name', 'booking.date', 'booking.pax', 'services.price');

        if ($this->start_date && $this->end_date) {
            $query->whereBetween('booking.date', [$this->start_date, $this->end_date]);
        }

        $data = $query->get();

        // Hitung total penjualan
        $total_sales = $data->sum('price');

        // Tambahkan baris total di akhir koleksi
        $data->push([
            'service_name' => '',
            'date' => '',
            'pax' => 'Total Sales',
            'price' => $total_sales,
        ]);

        return $data;
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'Service Name',
            'Date',
            'Pax',
            'Price',
        ];
    }
}
