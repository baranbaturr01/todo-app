<?php

namespace App\Services;

interface TaskDistributionStrategy
{
    public function distribute($developers, $tasks);
}
