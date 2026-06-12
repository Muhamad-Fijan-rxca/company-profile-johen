<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$cols = DB::select("PRAGMA table_info('konten_digital')");
foreach ($cols as $c) {
    echo "{$c->name} ({$c->type}) nullable=" . ($c->notnull ? 'NO' : 'YES') . PHP_EOL;
}
