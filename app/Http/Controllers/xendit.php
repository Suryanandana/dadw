<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Xendit\Invoice\InvoiceApi;
use Xendit\XenditSdkException;
use Illuminate\Support\Facades\DB;
use Xendit\Configuration;
use App\Events\UserPaid;

class xendit extends Controller
{
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
                    'booking_status' => ($request->status == 'PAID' ? 'PAYMENT CONFIRMED' : 'BOOKING EXPIRED'),
                ]);
            }
            DB::commit();
            event(new UserPaid($payment->first()->id_customer));
        } catch (XenditSdkException $e) {          
            DB::rollBack();
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }
    
    public function cancel($id) {
        try {
            Configuration::setXenditKey(env('XENDIT_API_KEY'));
            $apiInstance = new InvoiceApi();
            DB::beginTransaction();
            $booking = DB::table('booking')->where('external_id', $id);
            $booking->update([
                'booking_status' => 'CANCELLED',
                'updated_at' => now(),
            ]);
            $apiInstance->expireInvoice($id);
            DB::commit();

            redirect()->route('/transaction')->with('success', 'Cancel berhasil');
        } catch (XenditSdkException $e) {
            $error = $e->getMessage();
            return response()->json([
                'status' => 'error',
                'message' => $error,
            ], 500);
        }
    }
}
