<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Channel;
use App\Models\Room;
class Sessions extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'room_id',
        'title',
        'description',
        'speaker',
        'start',
        'end',
        'type',
        'cost'
    ];

    public function channel()
    {
        return $this->belongsTo(Channel::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

}
