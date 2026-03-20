<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class MigrateAgentData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:migrate-agent-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migrates agent JSON fields (user_types, insurance_companies) into relational tables.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info("Starting migration of agent JSON fields...");

        $agents = DB::table('agents')->get();
        $this->info("Processing " . $agents->count() . " agents.");

        $bar = $this->output->createProgressBar($agents->count());
        $bar->start();

        foreach ($agents as $agent) {
            // 1. Process User Types
            $this->processUserTypes($agent);

            // 2. Process Insurance Companies
            $this->processInsuranceCompanies($agent);

            $bar->advance();
        }

        $bar->finish();
        $this->newLine(2);
        $this->info("Migration completed successfully!");
    }

    private function processUserTypes($agent)
    {
        if (empty($agent->user_types)) return;

        $types = json_decode($agent->user_types, true) ?? [];
        if (!is_array($types)) {
            // Handle possibility of string being single value
            $types = [$agent->user_types];
        }

        foreach ($types as $typeSlug) {
            if (empty($typeSlug)) continue;

            $typeSlug = trim(strtolower($typeSlug));
            $name = ucwords(str_replace('_', ' ', $typeSlug));

            // Ensure user type exists in reference table
            DB::table('user_types')->updateOrInsert(
                ['slug' => $typeSlug],
                ['name' => $name, 'updated_at' => now(), 'created_at' => now()]
            );

            $id = DB::table('user_types')->where('slug', $typeSlug)->value('id');

            // Insert into pivot
            DB::table('agent_user_type')->insertOrIgnore([
                'agent_id' => $agent->id,
                'user_type_id' => $id
            ]);
        }
    }

    private function processInsuranceCompanies($agent)
    {
        if (empty($agent->insurance_companies)) return;

        $companies = json_decode($agent->insurance_companies, true) ?? [];
        if (!is_array($companies)) {
            $companies = [$agent->insurance_companies];
        }

        foreach ($companies as $compName) {
            if (empty($compName)) continue;

            $compName = trim($compName);
            $compSlug = Str::slug($compName);

            // Ensure company exists in reference table
            DB::table('insurance_companies')->updateOrInsert(
                ['slug' => $compSlug],
                ['name' => $compName, 'updated_at' => now(), 'created_at' => now()]
            );

            $id = DB::table('insurance_companies')->where('slug', $compSlug)->value('id');

            // Insert into pivot
            DB::table('agent_insurance_company')->insertOrIgnore([
                'agent_id' => $agent->id,
                'insurance_company_id' => $id
            ]);
        }
    }
}
