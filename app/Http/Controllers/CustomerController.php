<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use App\Models\Order;
use App\Models\Booking;
use App\Models\Customer;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Encoders\WebpEncoder;
use Intervention\Image\ImageManager;

class CustomerController extends Controller
{
    public function dashboard()
    {
        $user = auth()->user();
        // Get detail booking data
        $data = Booking::select('booking.*', 'customer.*', 'users.*', 'order.*', 'services.*', 'rooms.*')
                        ->join('customer', 'booking.id_customer', '=', 'customer.id')
                        ->join('users', 'customer.id_users', '=', 'users.id')
                        ->join('order', 'booking.id', '=', 'order.id_booking')
                        ->join('services', 'order.id_services', '=', 'services.id')
                        ->join('rooms', 'order.id_room', '=', 'rooms.id')
                        ->where('customer.id_users', $user->id)
                        ->orderBy('booking.id', 'desc')
                        ->get();

        return view('customer.dashboard', compact('data', 'user'));
    }

    public function booking(Request $request)
    {
        // validate request
        $request->validate([
            'date' => 'required',
            'time' => 'required',
            'pax' => 'required',
            'id_room' => 'required',
            'img_receipt' => 'required|image|mimes:jpeg,png,jpg,webp|max:4096',
        ]);

        $user = auth()->user();
        $id_customer = Customer::select('id_users')->where('id_users', $user->id)->first();
        $formattedDate = date("Y-m-d", strtotime($request->date));
        
        // create image file name
        $image = $request->file('img_receipt');

        $filename = $formattedDate . date('_Ymd_His') . '.webp';
        $manager = new ImageManager(Driver::class);
        $img = $manager->read($image);
        $img->scale(width:900);
        $encode = $img->encode(new WebpEncoder(quality:100));
        $encode->save(storage_path('app/public/img/receipt/' . $filename));

        try {
            DB::beginTransaction();
            $transaction = Transaction::create([
                'img_receipt' => $filename,
                'status' => 'unvalidate',
            ]);
            // get id transaction
            $id_transaction = $transaction->id;
            $booking = Booking::create([
                'id_customer' => $id_customer->id_users,
                'date' => $formattedDate . ' ' . $request->time,
                'status_booking' => 'inprogress',
                'pax' => $request->pax,
                'id_transaction' => $id_transaction,
            ]);
            // get id booking
            $id_booking = $booking->id;
            Order::create([
                'id_booking' => $id_booking,
                'id_room' => $request->id_room,
                'id_services' => $request->id_services,
            ]);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            // get error message
            $error = $th->getMessage();
            // redirect and send massage error
            return redirect('/booking')->with('error', $error);
        }

        return redirect()->route('customer.booking')->with('success', 'Booking berhasil');
    }

    
    public function viewReschedule()
    {
        return view('customer.reschedule');
    }

    public function reschedule(Request $request)
    {
        $formattedDate = date("Y-m-d", strtotime($request->date));
        //mencari id customer yang dimiliki oleh user yang sedang login
        $user = auth()->user();
        Booking::where('id', $request->id)->update([
            'date' => $formattedDate . ' ' . $request->time,
            'status_booking' => 'reschedule'
        ]);

        return redirect()->route('customer.transaction')->with('success', 'Reschedule berhasil');
    }

    public function cancel(Request $request)
    {
        Booking::where('id', $request->id)->update([
            'date' => $request->date,
            'status_booking' => 'cancelled',
        ]);

        Transaction::where('id', $request->id)->update([
            'status' => 'denied',
        ]);

        return redirect()->route('customer.transaction')->with('success', 'Cancel berhasil');
    }

    public function transaction()
    {
        $user = auth()->user();
        // select order and booking table
        $data = Order::select('order.*', 'booking.*', 'services.service_name', 'services.price', 'rooms.room_name')
            ->join('booking', 'order.id_booking', '=', 'booking.id')
            ->join('services', 'order.id_services', '=', 'services.id')
            ->join('rooms', 'order.id_room', '=', 'rooms.id')
            ->where('booking.id_customer', $user->id)
            ->orderBy('order.id', 'desc')
            ->get();
        $feedback = Feedback::select('feedback.*')
            ->join('booking', 'feedback.id_booking', '=', 'booking.id')
            ->where('booking.id_customer', $user->id)
            ->get();
        for($i = 0; $i < count($data); $i++){
            // set color for status booking
            $data[$i]->price = (int)$data[$i]->price;
            if($data[$i]->status_booking == 'inprogress'){
                $data[$i]->color = 'bg-yellow-100 text-yellow-800';
            } else if ($data[$i]->status_booking == 'reschedule'){
                $data[$i]->color = 'bg-blue-100 text-blue-800';
            } else if ($data[$i]->status_booking == 'cancelled'){
                $data[$i]->color = 'bg-red-100 text-red-800';
            } else if ($data[$i]->status_booking == 'accepted'){
                $data[$i]->color = 'bg-green-100 text-green-800';
            } else {
                $data[$i]->color = 'bg-teal-100 text-teal-800';
            }
            for($j = 0; $j < count($feedback); $j++){
                if($data[$i]->id == $feedback[$j]->id_booking){
                    $data[$i]->feedback = $feedback[$j];
                }
            }
        }
        return view('customer.transaction', compact('data'));
    }

    public function feedback(Request $request){
        Feedback::create([
            'rate' => $request->rate,
            'text' => $request->text,
            'date' => date("Y-m-d H:i:s"),
            'id_booking' => $request->id_booking,
        ]);

        return redirect()->route('customer.transaction')->with('success', 'Feedback berhasil');
    }
}
