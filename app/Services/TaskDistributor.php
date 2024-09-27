<?php

namespace App\Services;

use App\Models\Developer;
use App\Models\Task;

class TaskDistributor
{

    protected $strategy;

    public function __construct(TaskDistributionStrategy $strategy)
    {
        $this->strategy = $strategy;
    }

    public function distributeTasks()
    {
        $developers = Developer::all();
        $tasks = Task::all();

        return $this->strategy->distribute($developers, $tasks);
    }

}
