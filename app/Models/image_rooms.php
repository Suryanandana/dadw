<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class image_rooms extends Model
{
    use HasFactory;
    protected $fillable = [
        'imgdir', 'id_room', 
    ];
}
