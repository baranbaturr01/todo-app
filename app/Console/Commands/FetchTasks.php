<?php

namespace App\Console\Commands;

use App\Facades\TaskFacade;
use Illuminate\Console\Command;

class FetchTasks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:fetch-tasks';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch tasks from external APIs and store them in the database';

    /**
     * Execute the console command.
     *
     * @throws \Exception
     */
    public function handle()
    {
        $this->info('Fetching tasks from APIs...');

        try {
            TaskFacade::fetchTasksFromProviders();
            $this->info('All tasks fetched and stored successfully.');
        } catch (\Exception $e) {
            $this->error('Error fetching tasks: ' . $e->getMessage());
            \Log::error('Error fetching tasks: ' . $e->getMessage());
        }
    }
}
