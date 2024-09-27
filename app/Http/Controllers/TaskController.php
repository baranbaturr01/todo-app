<?php

namespace App\Http\Controllers;

use App\Services\GreedyTaskDistribution;
use App\Services\TaskDistributor;

class TaskController extends Controller
{

    protected $taskDistributor;

    public function __construct()
    {
        $this->taskDistributor = new TaskDistributor(new GreedyTaskDistribution());
    }

    public function index()
    {
        $result = $this->taskDistributor->distributeTasks();
        $assignments = $result['assignments'];
        $totalWeeks = $result['total_weeks'];
        return view('assignments', compact('assignments', 'totalWeeks'));
    }
}
