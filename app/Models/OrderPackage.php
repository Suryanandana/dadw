<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderPackage extends Model
{
    use HasFactory;

    protected $table = 'order_package';

    protected $fillable = [
        'id_booking', 'id_package', 'id_room'
    ];
}