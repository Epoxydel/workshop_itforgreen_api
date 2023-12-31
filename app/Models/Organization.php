<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    protected $table = 'organizations';

    protected $fillable = [
        'title', 'address', 'city', 'zip', 'status', 'type', 'description', 'image'
    ];
}
