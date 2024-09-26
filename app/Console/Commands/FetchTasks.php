<?php

namespace App\Console\Commands;

use App\Factories\TaskProviderFactory;
use App\Models\Task;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

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
     * @throws \Exception
     */
    public function handle()
    {
        $this->info('Fetching tasks from APIs...');
        $this->fetchAndStoreTasks('mock-one', 'value', 'estimated_duration');
        $this->fetchAndStoreTasks('mock-two', 'zorluk', 'sure');
        $this->info('All tasks fetched and stored successfully.');
    }


    /**
     * @throws \Exception
     */
    public function fetchAndStoreTasks($providerName, $valueKey, $durationKey)
    {
        $provider = TaskProviderFactory::create($providerName);
        $tasks = $provider->getTasks();
        if (empty($tasks)) {
            $this->warn("No tasks found from {$providerName}.");
            return;
        }
        foreach ($tasks as $task) {
            Task::create([
                'value' => $task[$valueKey],
                'estimated_duration' => $task[$durationKey],
            ]);
        }
        $this->info("Tasks from {$providerName} fetched and stored successfully.");
    }
}


