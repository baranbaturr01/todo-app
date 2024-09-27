<?php

namespace App\Providers;

interface TaskProviderInterface
{
    public function getTasks(): array;
}
