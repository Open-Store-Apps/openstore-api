<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;

class ServeCommand extends Command {

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'serve';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Serve the application on the PHP development server";

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle(): void
    {
        $base = $this->laravel->basePath();
        $host = $this->input->getOption('host');
        $port = $this->input->getOption('port');

        $this->info("Lumen development server started on http://{$host}:{$port}/");

        passthru('"' . PHP_BINARY . '"' . " -S {$host}:{$port} -t \"{$base}/public\"");
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions(): array
    {
        $url = env('APP_URL', '');
        $host = parse_url($url, PHP_URL_HOST);
        $port = parse_url($url, PHP_URL_PORT);

        // Defaults
        $host = $host ?? 'localhost';
        $port = $port ?? 8080;

        return [
            ['host', null, InputOption::VALUE_OPTIONAL, 'The host address to serve the application on.', $host],
            ['port', null, InputOption::VALUE_OPTIONAL, 'The port to serve the application on.', $port],
        ];
    }

}
