<?php

namespace App\Livewire\PaymentUser;

use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\DB;

class Payment extends Component
{
    public $services;
    public array $service_invoice;
    public $circle = 15.5;
    public $total = 0;
    public $show = false;

    public function mount()
    {
        $this->services = DB::table('services')->get();
    }

    public function klik()
    {
        $this->show = true;
    }

    public function setCircle($circle){
        $this->circle = $circle;
    }    

    #[On('add-service')]
    public function addService($idService)
    {
        // reset total
        $this->total = 0;
        // Cari data layanan berdasarkan id
        $data = DB::table('services')->where('id', $idService)->first();
        // Cari index layanan dalam array service_invoice
        $index = array_search($data, $this->service_invoice);
        // Jika layanan sudah ada dalam array, hapus dari array
        if ($index !== false) {
            unset($this->service_invoice[$index]);
        } else {
            // Jika layanan tidak ada dalam array, tambahkan ke array
            array_push($this->service_invoice, $data);
        }
        // Re-index array service_invoice
        $this->service_invoice = array_values($this->service_invoice);
        // Hitung total harga layanan
        $total = 0;
        foreach ($this->service_invoice as $service) {
            $this->total += $service->price;
        }
        // jika ada layanan next = true
        if (count($this->service_invoice) > 0) {
            $this->dispatch('next', boolean: true);
        } else {
            $this->dispatch('next', boolean: false);
        }
    }

    public function render()
    {
        return view('livewire.payment-user.payment');
    }
}
