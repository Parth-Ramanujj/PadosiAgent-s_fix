<?php
use Illuminate\Support\Facades\DB;

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$tables = DB::select('SHOW TABLES');
echo "Searching " . count($tables) . " tables...\n";
foreach ($tables as $t) {
    $tableName = array_values((array)$t)[0];
    try {
        $data = DB::table($tableName)->limit(500)->get();
        foreach ($data as $row) {
            if (stripos(json_encode($row), 'Ravi') !== false) {
                echo "Found match in table: $tableName\n";
                print_r($row);
                break;
            }
        }
    } catch (\Exception $e) {}
}
