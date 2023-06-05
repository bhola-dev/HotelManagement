<?php

namespace App\Models;

use App\Models\Room;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RoomBooking extends Model
{
    use HasFactory;

    protected $fillable = ['room_id', 'guest_id', 'price', 'no_of_guest', 'status', 'start_date', 'end_date'];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}
