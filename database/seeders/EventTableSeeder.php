<?php

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EventTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $events = [
            [
                'title' => 'Music Concert',
                'description' => 'An exhilarating evening of live performances by top artists.',
                'location' => 'Madison Square Garden, NY',
                'date' => '2025-12-15 19:00:00',
                'created_by' => 3,
            ],
            [
                'title' => 'Tech Conference 2024',
                'description' => 'A gathering of tech enthusiasts and professionals to discuss the latest trends in technology.',
                'location' => 'San Francisco Convention Center, CA',
                'date' => '2026-03-10 09:00:00',
                'created_by' => 3,
            ],
            [
                'title' => 'Art Expo',
                'description' => 'An exhibition showcasing contemporary art from around the world.',
                'location' => 'The Art Gallery, LA',
                'date' => '2026-05-05 10:00:00',
                'created_by' => 3,
            ],
            [
                'title' => 'Startup Pitch Night',
                'description' => 'An exciting event where startups present their ideas to investors and industry leaders.',
                'location' => 'Silicon Valley Innovation Hub, CA',
                'date' => '2026-07-22 18:00:00',
                'created_by' => 4,
            ],
            [
                'title' => 'Food Festival 2026',
                'description' => 'A celebration of culinary delights featuring top chefs and local food vendors.',
                'location' => 'Central Park, NY',
                'date' => '2026-09-10 12:00:00',
                'created_by' => 4,
            ],
        ];

        foreach ($events as $event) {
            Event::create($event);
        }
    }
}
