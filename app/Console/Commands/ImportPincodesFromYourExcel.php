<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Pincode;
use Illuminate\Support\Facades\DB;

class ImportPincodesFromYourExcel extends Command
{
    protected $signature = 'pincodes:import-excel 
                           {file=storage/app/all_india_pincodes.csv : CSV file path}
                           {--state= : Filter by state (e.g., GUJARAT)}
                           {--test : Test with first 100 records}
                           {--chunk=5000 : Batch size}';

    protected $description = 'Import pincodes from your Excel CSV';

    public function handle()
    {
        $file = $this->argument('file');

        if (!file_exists($file)) {
            $this->error("❌ File not found: {$file}");
            $this->info("💡 Save your Excel as CSV and place at: {$file}");
            $this->info("   Format should match your sample columns.");
            return 1;
        }

        $this->info("📊 Importing from: {$file}");
        $this->info("📋 Column format detected:");
        $this->info("   circlename, regionname, divisionname, officename, pincode, officetype, delivery, district, statename, latitude, longitude");

        $handle = fopen($file, 'r');
        if (!$handle) {
            $this->error("Failed to open file");
            return 1;
        }

        // Read and skip header
        $header = fgetcsv($handle);
        $this->info("✅ Header: " . implode(', ', $header));

        $batch = [];
        $imported = 0;
        $skipped = 0;
        $total = 0;

        $this->output->progressStart($this->estimateTotal($file));

        while (($row = fgetcsv($handle)) !== false) {
            $total++;

            // Test mode limit
            if ($this->option('test') && $total > 100) {
                break;
            }

            // Map columns based on your sample
            $data = $this->mapRow($row);

            // Filter by state if specified
            if ($this->option('state')) {
                $targetState = strtoupper($this->option('state'));
                if (strtoupper($data['state']) !== $targetState) {
                    $skipped++;
                    continue;
                }
            }

            // Skip if no coordinates
            if ($data['latitude'] === null || $data['longitude'] === null) {
                $skipped++;
                continue;
            }

            // Skip duplicates
            if (Pincode::where('pincode', $data['pincode'])->exists()) {
                $skipped++;
                continue;
            }

            $batch[] = $data;

            // Insert in batches
            if (count($batch) >= $this->option('chunk')) {
                $this->insertBatch($batch);
                $imported += count($batch);
                $batch = [];
                $this->output->progressAdvance($this->option('chunk'));
            }
        }

        fclose($handle);

        // Insert remaining
        if (!empty($batch)) {
            $this->insertBatch($batch);
            $imported += count($batch);
        }

        $this->output->progressFinish();

        $this->showResults($total, $imported, $skipped);

        return 0;
    }

    private function mapRow(array $row): array
    {
        // Your CSV columns:
        // 0: circlename, 1: regionname, 2: divisionname, 3: officename, 
        // 4: pincode, 5: officetype, 6: delivery, 7: district, 
        // 8: statename, 9: latitude, 10: longitude

        $pincode = $this->cleanPincode($row[4] ?? '');

        // Handle "NA" values for coordinates
        $latitude = strtoupper(trim($row[9] ?? '')) === 'NA' ? null : $row[9];
        $longitude = strtoupper(trim($row[10] ?? '')) === 'NA' ? null : $row[10];

        return [
            'pincode'     => $pincode,
            'office_name' => $row[3] ?? 'Unknown',
            'district'    => $row[7] ?? 'Unknown',
            'state'       => $row[8] ?? 'Unknown',
            'latitude'    => $this->parseCoordinate($latitude),
            'longitude'   => $this->parseCoordinate($longitude),
            'division'    => $row[2] ?? null,
            'region'      => $row[1] ?? null,
            'circle'      => $row[0] ?? null,
            'taluk'       => null, // Not in your sample
            'created_at'  => now(),
            'updated_at'  => now(),
        ];
    }

    private function insertBatch(array $batch)
    {
        try {
            DB::table('pincodes')->insert($batch);
        } catch (\Exception $e) {
            // Fallback: insert one by one
            foreach ($batch as $item) {
                try {
                    Pincode::create($item);
                } catch (\Exception $e) {
                    // Skip problematic records
                    continue;
                }
            }
        }
    }

    private function cleanPincode($pincode): string
    {
        $clean = preg_replace('/[^0-9]/', '', (string)$pincode);
        return str_pad(substr($clean, 0, 6), 6, '0', STR_PAD_LEFT);
    }

    private function parseCoordinate($coord): ?float
    {
        if (empty($coord) || strtoupper($coord) === 'NA') {
            return null;
        }

        $coord = trim($coord);
        if (!is_numeric($coord)) {
            return null;
        }

        return (float) $coord;
    }

    private function estimateTotal($file): int
    {
        $lineCount = 0;
        $handle = fopen($file, 'r');
        while (fgets($handle) !== false) {
            $lineCount++;
        }
        fclose($handle);

        // Subtract header
        return max(0, $lineCount - 1);
    }

    private function showResults($total, $imported, $skipped)
    {
        $this->info("\n✅ IMPORT COMPLETE!");
        $this->table(
            ['Metric', 'Count', 'Percentage'],
            [
                ['Total Records', $total, '100%'],
                ['Imported', $imported, round(($imported / $total) * 100, 1) . '%'],
                ['Skipped', $skipped, round(($skipped / $total) * 100, 1) . '%'],
                ['Database Total', Pincode::count(), '-']
            ]
        );

        // Show state distribution
        $this->info("\n📊 State Distribution:");
        $states = Pincode::select('state', DB::raw('count(*) as count'))
            ->groupBy('state')
            ->orderBy('count', 'desc')
            ->limit(10)
            ->get();

        $this->table(
            ['State', 'Pincodes'],
            $states->map(function ($item) {
                return [$item->state, $item->count];
            })->toArray()
        );
    }
}
