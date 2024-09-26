<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Assignments</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1>Weekly Task Assignments</h1>

    @foreach ($assignments as $assignment)
        <div class="card mt-3">
            <div class="card-header">
                {{ $assignment['developer']->name }} - Total Hours: {{ $assignment['total_hours'] }}
            </div>
            <ul class="list-group list-group-flush">
                @foreach ($assignment['tasks'] as $task)
                    <li class="list-group-item">Task ID: {{ $task->id }} - Difficulty: {{ $task->value }} -
                        Duration: {{ $task->estimated_duration }} hours
                    </li>
                @endforeach
            </ul>
        </div>
    @endforeach
</div>
</body>
</html>
