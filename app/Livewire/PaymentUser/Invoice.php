<?php

namespace App\Livewire\PaymentUser;

use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\DB;

class Invoice extends Component
{
    public array $service_invoice;
    public $name;
    public $phone;
    public $email;
    public $country;
    public $date;
    public $address;
    public $pax;
    public $validationEmailRule = 'email|required|unique:users,email';
    public $total = 0;

    public function mount($customer)
    {
        if(isset($customer)){
            $this->name = $customer['name'];
            $this->phone = $customer['phone'];
            $this->email = $customer['email'];
            $this->country = $customer['country'];
            $this->address = $customer['address'];
            $this->validationEmailRule = $customer['validationEmailRule'];
        }
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
        $this->dispatch('total', $this->total);
        $this->dispatch('service-invoice', $this->service_invoice);
        // jika ada layanan next = true
        if (count($this->service_invoice) > 0) {
            $this->dispatch('next', boolean: true);
        } else {
            $this->dispatch('next', boolean: false);
        }
    }

    #[On('format-date')]
    public function addDate($date)
    {
        $this->date = $date;
    }

    #[On('name-updated')]
    public function nameUpdated($name)
    {
        $this->name = $name;
    }

    #[On('email-updated')]
    public function emailUpdated($email)
    {
        $this->email = $email;
    }

    #[On('phone-updated')]
    public function phoneUpdated($phone)
    {
        $this->phone = $phone;
    }

    #[On('pax-updated')]
    public function setPax($pax)
    {
        $this->pax = $pax;
    }

    #[On('country-updated')]
    public function countryUpdated($country)
    {
        $this->country = $country;
    }

    #[On('address-updated')]
    public function addressUpdated($address)
    {
        $this->address = $address;
    }

    #[On('save-form')]
    public function saveForm()
    {

    }

    public function placeholder()
    {
        return view('skeleton.payment-user.invoice');
    }

    public function render()
    {
        return view('livewire.payment-user.invoice');
    }
}
