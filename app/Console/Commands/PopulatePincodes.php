<?php
// app/Console/Commands/PopulatePincodes.php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\PincodeService;

class PopulatePincodes extends Command
{
    protected $signature = 'pincodes:seed 
                           {--pincodes= : Comma-separated pincodes}
                           {--file= : File with pincodes list}';

    protected $description = 'Seed pincodes into database from API';

    public function handle()
    {
        $service = new PincodeService();

        $this->info('🚀 Seeding pincodes from API...');

        // Option 1: Specific pincodes
        if ($pincodes = $this->option('pincodes')) {
            $pincodes = explode(',', $pincodes);
            foreach ($pincodes as $pincode) {
                $this->seedPincode($service, trim($pincode));
            }
        }
        // Option 2: File
        elseif ($file = $this->option('file')) {
            $pincodes = file($file, FILE_IGNORE_NEW_LINES);
            foreach ($pincodes as $pincode) {
                $this->seedPincode($service, trim($pincode));
            }
        }
        // Option 3: Default Ahmedabad pincodes
        else {
            $defaultPincodes = [
                '382424',
                '382481',
                '380001',
                '380015',
                '380009',
                '380013',
                '380016',
                '380019',
                '380006',
                '380007'
            ];

            foreach ($defaultPincodes as $pincode) {
                $this->seedPincode($service, $pincode);
            }
        }

        $this->info('✅ Pincodes seeded successfully!');
        $this->info('Total pincodes: ' . \App\Models\Pincode::count());
    }

    private function seedPincode($service, $pincode)
    {
        $this->line("Processing {$pincode}...");

        $result = $service->getOrCreatePincode($pincode);

        if ($result) {
            $this->info("  ✓ {$pincode}: {$result->office_name}");
        } else {
            $this->error("  ✗ {$pincode}: Failed to fetch");
        }

        sleep(1); // Be nice to the API
    }
}
