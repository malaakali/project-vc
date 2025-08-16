<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Room;

class RoomTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define the room types we want
        $rooms = [
            [
                'name' => 'Beachfront Bungalow',
                'room_type' => 'Bungalow',
                'max_occupancy' => 2,
                'price_per_night' => 189.00,
                'description' => 'Direct beach access with stunning ocean views and private patio.',
                'amenities' => '1 King Bed',
                'is_available' => true
            ],
            [
                'name' => 'Ocean View Suite',
                'room_type' => 'Suite',
                'max_occupancy' => 2,
                'price_per_night' => 299.00,
                'description' => 'Spacious suite with panoramic ocean views and luxury amenities.',
                'amenities' => '1 King Bed, Lounge Area',
                'is_available' => true
            ],
            [
                'name' => 'Garden Villa',
                'room_type' => 'Villa',
                'max_occupancy' => 4,
                'price_per_night' => 249.00,
                'description' => 'Private villa surrounded by tropical gardens with outdoor shower.',
                'amenities' => '2 Queen Beds, Kitchenette',
                'is_available' => true
            ]
        ];

        // First, mark all existing rooms as unavailable
        Room::where('is_available', true)->update(['is_available' => false]);
        
        // Then updateOrCreate with our defined rooms
        foreach ($rooms as $room) {
            Room::updateOrCreate(
                ['name' => $room['name']],
                $room
            );
        }
    }
}
