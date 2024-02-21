<?php

namespace Database\Seeders;

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
            ['title' => '4', 'date' => '2024-02-14', 'user_id' => 1],
            ['title' => '1', 'date' => '2024-02-10', 'user_id' => 1],
            ['title' => '4', 'date' => '2024-02-25', 'user_id' => 1],
            ['title' => '1', 'date' => '2024-02-25', 'user_id' => 1],
            ['title' => '2', 'date' => '2024-02-23', 'user_id' => 1],
            ['title' => '1', 'date' => '2024-02-07', 'user_id' => 1],
            ['title' => '4', 'date' => '2024-02-02', 'user_id' => 1],
    ['title' => '4', 'date' => '2024-02-05', 'user_id' => 1],
    ['title' => '1', 'date' => '2024-02-08', 'user_id' => 1],
    ['title' => '4', 'date' => '2024-02-11', 'user_id' => 1],
    ['title' => '4', 'date' => '2024-02-12', 'user_id' => 1],
    ['title' => '2', 'date' => '2024-02-15', 'user_id' => 1],
    ['title' => '1', 'date' => '2024-02-18', 'user_id' => 1],
    ['title' => '4', 'date' => '2024-02-19', 'user_id' => 1],
    ['title' => '1', 'date' => '2024-02-22', 'user_id' => 1],
    ['title' => '1', 'date' => '2024-02-24', 'user_id' => 1],
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
