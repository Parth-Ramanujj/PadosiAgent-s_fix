<?php
use Illuminate\Support\Facades\DB;

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$status = DB::select('SHOW TABLE STATUS');
foreach ($status as $s) {
    if ($s->Name == 'agents' || $s->Name == 'users' || $s->Name == 'agent_profiles') {
        echo "Table: {$s->Name}, Engine: {$s->Engine}\n";
    }
}
