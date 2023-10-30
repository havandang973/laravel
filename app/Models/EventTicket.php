<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventTicket extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        'event_id',
        'name',
        'cost',
        'special_validity',
    ];
}
