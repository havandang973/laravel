<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'organizer_id',
        'name',
        'slug',
        'date',
    ];

    public function ticket()
    {
        return $this->hasMany(EventTicket::class);
    }

    public function registration()
    {
        return $this->hasManyThrough(Registration::class, EventTicket::class, 'event_id', 'ticket_id');
    }

}
