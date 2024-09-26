<?php

namespace App\Facades;

use App\Factories\TaskProviderFactory;
use App\Models\Task;

class TaskFacade
{
    /**
     * @throws \Exception
     */
    public static function fetchTasksFromProviders()
    {
        $providers = [
            'mock-one' => ['value', 'estimated_duration'],
            'mock-two' => ['zorluk', 'sure']
        ];

        foreach ($providers as $providerName => $keys) {
            self::fetchAndStoreTasks($providerName, $keys);
        }
    }

    /**
     * @throws \Exception
     */
    private static function fetchAndStoreTasks($providerName, $keys)
    {
        $providerInstance = TaskProviderFactory::create($providerName);
        $tasks = $providerInstance->getTasks();

        foreach ($tasks as $task) {
            Task::create([
                'value' => $task[$keys[0]],
                'estimated_duration' => $task[$keys[1]],

            ]);
        }
    }
}
