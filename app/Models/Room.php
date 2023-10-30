<?php

namespace App\Models;

use App\Models\Sessions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Room extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
//        'id',
        'channel_id',
        'name',
        'capacity'
    ];

    public function sessions()
    {
        return $this->hasMany(Sessions::class);
    }

    public function channel()
    {
        return $this->belongsTo(Channel::class);
    }
}
