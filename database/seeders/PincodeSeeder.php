<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pincode;

class PincodeSeeder extends Seeder
{
    public function run()
    {
        // Seed critical pincodes for Ahmedabad
        $pincodes = [
            [
                'pincode' => '382424',
                'office_name' => 'Chandkheda S.O',
                'district' => 'Ahmedabad',
                'state' => 'Gujarat',
                'latitude' => 23.0875,
                'longitude' => 72.5361,
            ],
            [
                'pincode' => '382481',
                'office_name' => 'Sabarmati H.O',
                'district' => 'Ahmedabad',
                'state' => 'Gujarat',
                'latitude' => 23.0718,
                'longitude' => 72.5791,
            ],
        ];

        foreach ($pincodes as $pincode) {
            Pincode::create($pincode);
        }

        $this->command->info('✅ Seeded 2 essential pincodes for testing');
    }
}
