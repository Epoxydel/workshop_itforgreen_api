<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 *  @author UNIECO
 */
class Event extends Model
{
    protected $table = 'events';

    protected $fillable = [
        'titre', 'id_organization', 'description', 'needs', 'date'
    ];
}
