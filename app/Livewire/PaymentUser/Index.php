<?php

namespace App\Livewire\PaymentUser;

use DateTime;
use App\Models\User;
use Livewire\Component;
use Xendit\Configuration;
use Livewire\Attributes\On;
use Xendit\Invoice\InvoiceApi;
use Xendit\XenditSdkException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Auth\Events\Registered;

class Index extends Component
{
    public $circle = 15.5;
    public $show = false;
    public $customer;

    public function mount()
    {
        if (Auth::check()) {
            $name = Auth::user()->name;
            $email = Auth::user()->email;
            $validationEmailRule = 'email|required|';
            $customer = DB::table('customer')->where('id_users', Auth::id())->select('country', 'address', 'phone')->first();
            if ($customer) {
                $country = $customer->country;
                $address = $customer->address;
                $phone = $customer->phone;
            }
            $this->customer = [
                'name' => $name,
                'email' => $email,
                'country' => $country,
                'address' => $address,
                'phone' => $phone,
                'validationEmailRule' => $validationEmailRule,
            ];
        }
    }

    #[On('save-form')]
    public function saveForm($customer)
    {
        try {
            // start transaction
            DB::beginTransaction();
            $user = DB::table('users')->select('id')->where('email', $customer['email'])->first();
            if ($user) {
                // Update user if email exists (user login with email)
                $this->updateIfEmailExists($customer, $user->id);
            } else {
                // Insert new user if email doesn't exist
                $this->insertIfEmailNotExists($customer);
            }
            // commit transaction
            DB::commit();
            // dispatch complete for next step
            $this->dispatch('complete', true);
            // create invoice
            $external_id = 'ENV-' . date('Ymd') .'-'. uniqid();
            $result = $this->newinvoice($external_id, $customer['total']);
            // dispatch invoice_url to payment page
            $this->dispatch('invoice_url', $result['invoice_url']);
            // get id customer base on id_users
            $id_customer = DB::table('customer')->where('id_users', auth()->id())->value('id');
            // insert booking
            DB::table('booking')->insert([
                'id_customer' => $id_customer,
                'total' => $customer['total'],
                'date' => $customer['date'],
                'payment_status' => $result['status'],
                'booking_status' => 'ONGOING',
                'external_id' => $external_id,
                'payment_url' => $result['invoice_url'],
                'id_room' => 1,
                'pax' => $customer['pax'],
            ]);
        } catch (\Exception $e) {
            // return error message with session
            session()->flash('error', $e->getMessage());
            dd($e->getMessage());
        }
    }

    public function updateIfEmailExists($customer, $id_user)
    {
        DB::table('users')
            ->where('email', $customer['email'])
            ->update([
                'name' => $customer['name'],
            ]);
        DB::table('customer')
            ->where('id_users', $id_user)
            ->update([
                'country' => $customer['country'],
                'address' => $customer['address'],
                'phone' => $customer['phone']
            ]);
        // send email notification base on email if email_verified_at is null
        $user = User::find($id_user);
        if (!$user->email_verified_at) {
            event(new Registered($user));
            $this->dispatch('next', false);
        } else {
            $this->dispatch('next', true);
        }
    }

    public function insertIfEmailNotExists($customer)
    {
        // generate random password
        $password = substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 10);
        $user = User::create([
            'name' => $customer['name'],
            'email' => $customer['email'],
            'level' => 'customer',
            'password' => bcrypt($password),
        ]);
        DB::table('customer')->insert([
            'id_users' => $user->id,
            'country' => $customer['country'],
            'address' => $customer['address'],
            'phone' => $customer['phone']
        ]);
        // send email notification base on email
        event(new Registered($user));
        Auth::login($user);
        // refresh navbar
        $this->dispatch('refreshNavbar');
        // dispatch set user_id
        $this->dispatch('setUserId', $user->id);
        // dispatch next
        $this->dispatch('next', false);
    }

    public function newinvoice($external_id, $price) {
        Configuration::setXenditKey(env('XENDIT_API_KEY'));
        $apiInstance = new InvoiceApi();

        $create_invoice_request = new \Xendit\Invoice\CreateInvoiceRequest([
            'external_id' => $external_id,
            'description' => "Invoice of The Cajuput Spa",
            'amount' => $price,
            'currency' => 'IDR',
            'reminder_time' => 1,
        ]); 
        return $apiInstance->createInvoice($create_invoice_request);
    }

    public function klik()
    {
        $this->show = true;
    }

    public function setCircle($circle)
    {
        $this->circle = $circle;
    }

    public function render()
    {
        return view('livewire.payment-user.index');
    }
}
