<?php

namespace App\Livewire\Customer;

use App\Models\Feedback;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\Attributes\Validate;

use function PHPUnit\Framework\isEmpty;

class Transaction extends Component
{

    public array $payment_status;

    #[Validate('string|nullable|max:255')] 
    public $feedbacktitle = null;
    #[Validate('string|nullable')] 
    public $feedbackmessage = null;
    #[Validate('required|integer|between:1,5')] 
    public $rating = 0;

    public $review = false;
    public $id_booking = null;

    public function feedback()
    {
        $this->validate();
        $table = Feedback::where('id_booking', $this->id_booking);
        if($table){
            $table->update([
                'rate' => $this->rating,
                'title' => $this->feedbacktitle,
                'message' => $this->feedbackmessage,
            ]);
        } else {
            Feedback::create([
                'rate' => $this->rating,
                'title' => $this->feedbacktitle,
                'message' => $this->feedbackmessage,
                'id_booking' => $this->id_booking,
            ]);
        }

        $this->reset();
        $this->review = false;
        $this->dispatch('resetFeedback', 0);
    }
    
    public function openfeedback($id) 
    {
        $this->id_booking = DB::table('booking')->where('external_id', $id)->get()->first()->id;
        $feedback = Feedback::where('id_booking', $this->id_booking)->get()->first();
        if($feedback) {
            $this->dispatch('resetFeedback', $feedback->rate);
            $this->rating = $feedback->rate;
            $this->feedbacktitle = $feedback->title;
            $this->feedbackmessage = $feedback->message;
        }
        $this->review = true;
    }
    public function render()
    {
        $id = DB::table('customer')
        ->where('id_users', Auth::user()->getAuthIdentifier())
        ->get()
        ->first()->id;

        $data = DB::table('booking')
        ->join('rooms', 'rooms.id', '=', 'booking.id_room')
        ->select('booking.*', 'rooms.room_name')
        ->where('id_customer', $id)
        ->orderBy('booking.date', 'desc')
        ->get();

        $feedback = DB::table('feedback')
        ->whereIn('feedback.id_booking', $data->pluck('id'))
        ->get();

        $name = DB::table('order_services')
        ->join('services', 'services.id', '=', 'order_services.id_services')
        ->select(DB::raw('GROUP_CONCAT(services.service_name ORDER BY services.service_name SEPARATOR ", ") as selected_service'))
        ->whereIn('order_services.id_booking', $data->pluck('id'))
        ->groupBy('order_services.id_booking')
        ->get();
        
        $image = DB::table('order_services')
        ->join('services', 'services.id', '=', 'order_services.id_services')
        ->join('image_services', 'services.id', '=', 'image_services.service_id')
        ->select('image_services.imgdir', 'order_services.id_booking')
        ->whereIn('order_services.id_booking', $data->pluck('id'))
        ->get();

        return view('livewire.customer.transaction', compact('data', 'image', 'feedback', 'name'));
    }

}
