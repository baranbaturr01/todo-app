<?php

namespace App\Adapters;

class TaskAdapter
{
    /**
     * @throws \Exception
     */
    public static function normalizeTask($task, $providerName)
    {
        return match ($providerName) {
            'mock-one' => [
                'difficulty' => $task['value'],
                'duration' => $task['estimated_duration'],
            ],
            'mock-two' => [
                'difficulty' => $task['zorluk'],
                'duration' => $task['sure'],
            ],
            default => throw new \Exception("Unknown provider: {$providerName}"),
        };
    }
}
