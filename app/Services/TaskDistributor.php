<?php

namespace App\Services;

use App\Models\Developer;
use App\Models\Task;

class TaskDistributor
{

    public function distributeTasks()
    {
        $developers = Developer::all();
        $tasks = Task::all();

        $assignments = [];//atanacak taskları bu arrayde tutuyoruz

        foreach ($developers as $developer) {
            $assignments[$developer->id] = [
                'developer' => $developer,
                'tasks' => [],
                'total_hours' => 0

            ];
        }
        $tasks = $tasks->sortByDesc('value'); //işleri öncesinde zorluk derecesine göre sıraladım

//        tasklari geliştiricilere sırayla paylaştırıyorum
        foreach ($tasks as $task) {
            $bestFitDeveloper = null;

            foreach ($assignments as $key => $assignment) {
                if ($bestFitDeveloper === null || $assignment['total_hours'] < $assignments[$bestFitDeveloper]['total_hours']) {
                    $bestFitDeveloper = $key;
                }
            }

//            Geliştiriciye iş ata
            if ($bestFitDeveloper !== null) {
                $assignments[$bestFitDeveloper]['tasks'][] = $task;
                $assignments[$bestFitDeveloper]['total_hours'] += ($task->estimated_duration / $assignments[$bestFitDeveloper]['developer']->capacity);
            } else {
                throw new \Exception('No suitable developer found for task: ' . $task->id . ' ' . $task->title);
            }
        }
        return $assignments;
    }

}
