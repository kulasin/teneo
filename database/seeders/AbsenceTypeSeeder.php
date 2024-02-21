<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AbsenceType;


class AbsenceTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Define the absence types data
        $absenceTypes = [
            'Authorised',
            'Unplanned',
            'Unauthorised',
            'Sick Leave',
            'Vacation',
        ];

        // Insert absence types into the database
        foreach ($absenceTypes as $type) {
            AbsenceType::create(['name' => $type]);
        }
    }
}
