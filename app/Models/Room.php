<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable = ['room_no', 'price', 'guest_capacity', 'status'];

    public function features()
    {
        return $this->hasMany(RoomFeature::class, "room_id", 'id');
    }
}
