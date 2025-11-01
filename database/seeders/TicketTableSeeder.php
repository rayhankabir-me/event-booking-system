<?php

namespace Database\Seeders;

use App\Models\Ticket;
use Illuminate\Database\Seeder;

class TicketTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tickets = [

            // Event 1 - Music Concert
            [
                'event_id' => 1,
                'type' => 'VIP',
                'price' => 150.00,
                'quantity' => 50,
            ],
            [
                'event_id' => 1,
                'type' => 'General Admission',
                'price' => 75.00,
                'quantity' => 200,
            ],
            [
                'event_id' => 1,
                'type' => 'Backstage Pass',
                'price' => 250.00,
                'quantity' => 20,
            ],

            // Event 2 - Tech Conference 2024
            [
                'event_id' => 2,
                'type' => 'Early Bird',
                'price' => 50.00,
                'quantity' => 100,
            ],
            [
                'event_id' => 2,
                'type' => 'Regular',
                'price' => 80.00,
                'quantity' => 150,
            ],
            [
                'event_id' => 2,
                'type' => 'VIP Access',
                'price' => 120.00,
                'quantity' => 50,
            ],

            // Event 3 - Art Expo
            [
                'event_id' => 3,
                'type' => 'Standard Entry',
                'price' => 40.00,
                'quantity' => 200,
            ],
            [
                'event_id' => 3,
                'type' => 'Premium Entry',
                'price' => 70.00,
                'quantity' => 100,
            ],
            [
                'event_id' => 3,
                'type' => 'Group Pass',
                'price' => 150.00,
                'quantity' => 30,
            ],

            // Event 4 - Startup Pitch Night
            [
                'event_id' => 4,
                'type' => 'Audience',
                'price' => 60.00,
                'quantity' => 120,
            ],
            [
                'event_id' => 4,
                'type' => 'Investor Pass',
                'price' => 200.00,
                'quantity' => 30,
            ],
            [
                'event_id' => 4,
                'type' => 'Startup Participant',
                'price' => 100.00,
                'quantity' => 50,
            ],

            // Event 5 - Food Festival 2026
            [
                'event_id' => 5,
                'type' => 'General Entry',
                'price' => 30.00,
                'quantity' => 300,
            ],
            [
                'event_id' => 5,
                'type' => 'Family Package',
                'price' => 100.00,
                'quantity' => 80,
            ],
            [
                'event_id' => 5,
                'type' => 'VIP Tasting Experience',
                'price' => 200.00,
                'quantity' => 40,
            ],
        ];

        foreach ($tickets as $ticket) {
            Ticket::create($ticket);
        }
    }
}
