<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CheckRequirements extends Command
{
    protected $signature = 'check:requirements';

    protected $description = 'Verify required PHP extensions are present (e.g. PDO drivers for the configured DB).';

    public function handle(): int
    {
        $db = env('DB_CONNECTION', 'mysql');

        $pdoMap = [
            'mysql' => 'pdo_mysql',
            'mariadb' => 'pdo_mysql',
            'pgsql' => 'pdo_pgsql',
            'sqlsrv' => 'pdo_sqlsrv',
            'sqlite' => null,
        ];

        $required = $pdoMap[$db] ?? null;

        if ($required && !extension_loaded($required)) {
            $this->error("Missing required PHP extension: {$required}");
            $this->line("Current DB connection: {$db}");
            $this->line('Please install the extension and restart your PHP process.');

            return 1;
        }

        $this->info('All required PHP extensions present.');
        return 0;
    }
}
