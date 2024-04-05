<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use App\Models\Order;
use App\Models\Booking;
use App\Models\Customer;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Xendit\Configuration;
use Xendit\Invoice\InvoiceApi;
use Xendit\XenditSdkException;

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

    public function payment()
    {
        return view('customer.payment');
    }

    public function booking(Request $request)
    {
        
        try {
            // validate request
            $request->validate([
                'date' => 'required',
                'time' => 'required',
                'pax' => 'required',
                'id_room' => 'required',
            ]);
            
            DB::beginTransaction();
            // $user = auth()->user();
            // $id_customer = Customer::where('id_users', $user->id)->value('id');
            $formattedDate = date("Y-m-d", strtotime($request->date));
            $price = 0;
            if (!empty($request->id_services)) {
                $price += DB::table('services')->whereIn('id', $request->id_services)->sum('price');
            } elseif(!empty($request->id_package)) {
                $price += DB::table('package')->whereIn('id', $request->id_package)->sum('price');
            }
            $total = $price * $request->pax;
            $external_id = 'ENV-' . date('Ymd') .'-'. uniqid();
            $result = $this->newinvoice($external_id, $total);

            DB::table('booking')->insert([
                'id_customer' => 1,
                'total' => $total,
                'date' => $formattedDate . ' ' . $request->time,
                'payment_status' => $result['status'],
                'booking_status' => 'ONGOING',
                'external_id' => $external_id,
                'payment_url' => $result['invoice_url'],
                'id_room' => $request->id_room,
                'pax' => $request->pax,
            ]);

            DB::commit();

            return printf($result);
            // return redirect()->route('customer.booking')->with('success', 'Booking berhasil');

        } catch (XenditSdkException $e) {
            DB::rollBack();
            $error = $e->getMessage();
            // return redirect('/booking')->with('error', $error);
            return printf($error);
        } 
    }

    public function expire($id) {
        try {
            Configuration::setXenditKey(env('XENDIT_API_KEY'));
            $apiInstance = new InvoiceApi();
            $apiInstance->expireInvoice($id);
        } catch (XenditSdkException $e) {
            $error = $e->getMessage();
            return response()->json([
                'status' => 'error',
                'message' => $error,
            ], 500);
        }
    }

    public function callback(Request $request) {
        if($request->header('x-callback-token') !== env('XENDIT_CALLBACK_TOKEN')) {
            return response()->json([
                'status' => 'error',
                'message' => 'invalid callback token',
            ], 400);
        } 
        try {
            DB::beginTransaction();
            $payment = DB::table('booking')->where('external_id', $request->external_id);
            if ($payment) {
                $payment->update([
                    'payment_status' => $request->status,
                ]);
            }
            DB::commit();
        } catch (XenditSdkException $e) {          
            DB::rollBack();

            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
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
