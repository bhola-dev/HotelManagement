<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoomFeature extends Model
{
    protected $fillable = [
        "room_id",
        "feature_id",
        "feature_name",
        "icon_url",
    ];
}
