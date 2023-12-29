<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    
    protected $table = 'booking';

    protected $fillable = [
        'status_booking', 'pax', 'date', 'id_customer', 'id_staff', 'id_transaction', 'created_at', 'updated_at'
    ];
}
