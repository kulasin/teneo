<?php

use Illuminate\Database\Seeder;
use App\Models\Event;

class EventsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Array of event data
        $events = [
            ['title' => 'sick leave', 'date' => '2024-02-14', 'user_id' => 1],
            ['title' => 'authorised', 'date' => '2024-02-10', 'user_id' => 1],
            ['title' => 'sick leave', 'date' => '2024-02-25', 'user_id' => 1],
            ['title' => 'authorised', 'date' => '2024-02-25', 'user_id' => 1],
            ['title' => 'unplanned', 'date' => '2024-02-23', 'user_id' => 1],
            ['title' => 'unauthorised', 'date' => '2024-02-07', 'user_id' => 1],
        ];

        // Loop through the event data and create records in the database
        foreach ($events as $event) {
            Event::create([
                'title' => $event['title'],
                'date' => $event['date'],
                'user_id' => $event['user_id'],
            ]);
        }
    }
}

