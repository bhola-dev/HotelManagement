<?php

namespace Database\Seeders;

use App\Models\Feature;
use App\Models\Room;
use App\Models\RoomFeature;
use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $rooms = [
            [
                "room_no" => 101,
                "status" => true,
                "price" => 500,
                "guest_capacity" => 2,
            ],
            [
                "room_no" => 102,
                "status" => true,
                "price" => 700,
                "guest_capacity" => 2,
            ],
            [
                "room_no" => 103,
                "status" => true,
                "price" => 500,
                "guest_capacity" => 2,
            ],
            [
                "room_no" => 104,
                "status" => true,
                "price" => 500,
                "guest_capacity" => 1,
            ],
            [
                "room_no" => 105,
                "status" => true,
                "price" => 500,
                "guest_capacity" => 1,
            ],
            [
                "room_no" => 106,
                "status" => true,
                "price" => 900,
                "guest_capacity" => 1,
            ],
            [
                "room_no" => 107,
                "status" => true,
                "price" => 900,
                "guest_capacity" => 1,
            ],
            [
                "room_no" => 108,
                "status" => true,
                "price" => 1500,
                "guest_capacity" => 2,
            ],
            [
                "room_no" => 109,
                "status" => true,
                "price" => 1500,
                "guest_capacity" => 2,
            ],
            [
                "room_no" => 110,
                "status" => true,
                "price" => 1500,
                "guest_capacity" => 2,
            ],
            [
                "room_no" => 201,
                "status" => true,
                "price" => 1500,
                "guest_capacity" => 2,
            ],
            [
                "room_no" => 202,
                "status" => true,
                "price" => 1500,
                "guest_capacity" => 2,
            ],
            [
                "room_no" => 203,
                "status" => true,
                "price" => 1500,
                "guest_capacity" => 2,
            ],
            [
                "room_no" => 203,
                "status" => true,
                "price" => 1500,
                "guest_capacity" => 2,
            ],
            [
                "room_no" => 204,
                "status" => true,
                "price" => 2000,
                "guest_capacity" => 1,
            ],
            [
                "room_no" => 205,
                "status" => true,
                "price" => 2000,
                "guest_capacity" => 1,
            ],
            [
                "room_no" => 206,
                "status" => true,
                "price" => 2000,
                "guest_capacity" => 1,
            ],
        ];
        foreach ($rooms as $roomItem) {
            $room = Room::updateOrCreate(["room_no" => $roomItem['room_no']], $roomItem);
            $limit = rand(1, 11);
            $features = Feature::inRandomOrder()->limit($limit)->get();
            foreach ($features as $feature) {
                $data = [
                    "room_id" => $room->id,
                    "feature_id" => $feature->id,
                    "feature_name" => $feature->feature_name,
                    "icon_url" => $feature->feature_url,
                ];
                RoomFeature::updateOrCreate(['room_id' => $feature->room_id, 'feature_id' => $feature->feature_id], $data);
            }

        }

    }
}
