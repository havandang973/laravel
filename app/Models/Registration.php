<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'attendee_id',
        'ticket_id',
        'registration_time'
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function ticket()
    {
        return $this->belongsTo(EventTicket::class);
    }
}
