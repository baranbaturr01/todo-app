<?php

namespace App\Facades;

use App\Adapters\TaskAdapter;
use App\Factories\TaskProviderFactory;
use App\Models\Task;

class TaskFacade
{
    /**
     * @throws \Exception
     */
    public static function fetchTasksFromProviders(): void
    {
        $providers = ['mock-one', 'mock-two'];

        foreach ($providers as $providerName) {
            self::fetchAndStoreTasks($providerName);
        }
    }

    /**
     * @throws \Exception
     */
    private static function fetchAndStoreTasks($providerName)
    {
        $providerInstance = TaskProviderFactory::create($providerName);
        $tasks = $providerInstance->getTasks();

        foreach ($tasks as $task) {
            $normalizedTask = TaskAdapter::normalizeTask($task, $providerName);

            Task::create([
                'value' => $normalizedTask['difficulty'],
                'estimated_duration' => $normalizedTask['duration'],
            ]);
        }
    }
}
