<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    protected
        $table = 'package',
        $fillable = [
            'package_name',
            'package_duration',
            'price',
            'detail',
            'created_at',
            'updated_at'
        ];
}
