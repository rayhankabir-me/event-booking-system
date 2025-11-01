<?php

namespace Database\Seeders;

use App\Models\Booking;
use Illuminate\Database\Seeder;

class BookingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bookings = [
            [
                'user_id' => 6,
                'ticket_id' => 1,
                'quantity' => 2,
            ],
            [
                'user_id' => 7,
                'ticket_id' => 4,
                'quantity' => 1,
            ],
            [
                'user_id' => 6,
                'ticket_id' => 7,
                'quantity' => 3,
            ],
            [
                'user_id' => 7,
                'ticket_id' => 10,
                'quantity' => 2,
            ],
            [
                'user_id' => 6,
                'ticket_id' => 13,
                'quantity' => 1,
            ],
            [
                'user_id' => 8,
                'ticket_id' => 2,
                'quantity' => 2,
            ],
            [
                'user_id' => 9,
                'ticket_id' => 3,
                'quantity' => 1,
            ],
            [
                'user_id' => 10,
                'ticket_id' => 5,
                'quantity' => 3,
            ],
            [
                'user_id' => 11,
                'ticket_id' => 6,
                'quantity' => 2,
            ],
            [
                'user_id' => 12,
                'ticket_id' => 8,
                'quantity' => 1,
            ],
            [
                'user_id' => 13,
                'ticket_id' => 9,
                'quantity' => 4,
            ],
            [
                'user_id' => 14,
                'ticket_id' => 11,
                'quantity' => 1,
            ],
            [
                'user_id' => 15,
                'ticket_id' => 12,
                'quantity' => 2,
            ],
            [
                'user_id' => 8,
                'ticket_id' => 14,
                'quantity' => 3,
            ],
            [
                'user_id' => 9,
                'ticket_id' => 15,
                'quantity' => 1,
            ],
            [
                'user_id' => 10,
                'ticket_id' => 1,
                'quantity' => 1,
            ],
            [
                'user_id' => 11,
                'ticket_id' => 5,
                'quantity' => 2,
            ],
            [
                'user_id' => 12,
                'ticket_id' => 8,
                'quantity' => 3,
            ],
            [
                'user_id' => 13,
                'ticket_id' => 10,
                'quantity' => 2,
            ],
            [
                'user_id' => 15,
                'ticket_id' => 13,
                'quantity' => 1,
            ],
        ];

        foreach ($bookings as $booking) {
            Booking::create($booking);
        }

    }
}
