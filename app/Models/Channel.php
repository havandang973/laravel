<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'event_id',
        'name'
    ];

    public function sessions()
    {
        return $this->hasManyThrough(Sessions::class, Room::class, 'channel_id', 'room_id');
    }

    public function room()
    {
        return $this->hasMany(Room::class);
    }
}
