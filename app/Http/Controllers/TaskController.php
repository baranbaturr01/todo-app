<?php

namespace App\Http\Controllers;

use App\Services\TaskDistributor;

class TaskController extends Controller
{


    public function index(TaskDistributor $distributor)
    {
        $assignments = $distributor->distributeTasks();
        return view('assignments', compact('assignments'));
    }
}
