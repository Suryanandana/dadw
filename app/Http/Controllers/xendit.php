<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Xendit\Invoice\InvoiceApi;
use Xendit\XenditSdkException;
use Illuminate\Support\Facades\DB;
use Xendit\Configuration;
use App\Events\UserPaid;
use Illuminate\Support\Facades\Log;

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
            return response()->json([
                'status' => 'success',
                'message' => 'payment status updated',
            ]);
        } catch (XenditSdkException $e) {          
            DB::rollBack();
            // Log the full error
            Log::error('Exception when calling callback', [
                'message' => $e->getMessage(),
                'full_error' => $e->getFullError()
            ]);

            // Return an error response
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to callback',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
    
    public function expire($id) {
        try {
            Configuration::setXenditKey(env('XENDIT_API_KEY'));
            $apiInstance = new InvoiceApi();
            $result = $apiInstance->expireInvoice($id);

            // Return a success response
            return response()->json([
                'status' => 'success',
                'message' => 'Invoice expired successfully',
                'data' => $result,
            ]);
        } catch (XenditSdkException $e) {
            // Log the full error
            Log::error('Exception when calling expireInvoice', [
                'message' => $e->getMessage(),
                'full_error' => $e->getFullError()
            ]);

            // Return an error response
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to expire invoice',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

}
