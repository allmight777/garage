<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

echo '<pre>';

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);

// Commandes artisan à exécuter
$commands = [
    'storage:link',
    'config:clear',
    'cache:clear',
    'view:clear'
];

foreach ($commands as $cmd) {
    echo "Running: php artisan $cmd\n";
    $kernel->call($cmd);
    echo $kernel->output() . "\n";
}

echo "All done!";
echo '</pre>';
