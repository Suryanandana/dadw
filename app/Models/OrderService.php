<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderService extends Model
{
    use HasFactory;

    protected $table = 'order_services';

    protected $fillable = [
        'id_booking', 'id_services', 'id_room'
    ];
}

