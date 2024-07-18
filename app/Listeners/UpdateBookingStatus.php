<?php

namespace App\Listeners;

use App\Events\PaymentStatusUpdated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdateBookingStatus
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(PaymentStatusUpdated $event)
    {
        $booking = $event->booking;

        // Logika untuk mengatur status booking berdasarkan status pembayaran
        if ($booking->payment_status == "PAID") {
            $booking->booking_status = 'PAYMENT CONFIRMED';
        } elseif ($booking->payment_status == "PENDING") {
            $booking->booking_status = 'BOOKING CONFIRMED';
        }

        // Simpan status booking yang baru
        $booking->save();
    }
}
