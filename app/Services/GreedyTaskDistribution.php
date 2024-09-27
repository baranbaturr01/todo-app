<?php

namespace App\Services;

class GreedyTaskDistribution implements TaskDistributionStrategy
{
    public function distribute($developers, $tasks)
    {
        $assignments = [];
        $developerWeeks = [];

        foreach ($developers as $developer) {
            $assignments[$developer->id] = [
                'developer' => $developer,
                'tasks' => [],
                'total_hours' => 0,
            ];
            $developerWeeks[$developer->id] = 0; // Başlangıçta her geliştirici için hafta sıfır
        }

        // Zorluk derecesine göre işleri sıralıyorum
        $tasks = $tasks->sortByDesc('value');

        foreach ($tasks as $task) {
            $bestFitDeveloper = null;
            $minTotalHours = PHP_INT_MAX;

            foreach ($assignments as $key => $assignment) {
                $taskHours = $task->estimated_duration / $assignment['developer']->capacity;
                $currentTotalHours = $assignment['total_hours'] + $taskHours;

                // Eğer geliştirici toplam saati haftalık sınırı aşmıyorsa ve mevcut saatler daha azsa
                if ($currentTotalHours <= 45 && $currentTotalHours < $minTotalHours) {
                    $bestFitDeveloper = $key;
                    $minTotalHours = $currentTotalHours;
                }
            }

            // Geliştiriciye işin atandığı kısım
            if ($bestFitDeveloper !== null) {
                $developer = $assignments[$bestFitDeveloper]['developer'];
                $taskHours = $task->estimated_duration / $developer->capacity;

                // taskları Atama işlemi
                $assignments[$bestFitDeveloper]['tasks'][] = $task;
                $assignments[$bestFitDeveloper]['total_hours'] += $taskHours; // Toplam saat güncellemesi

                // Geliştiricinin haftalık çalışma saatini güncelliyorm
                $developerWeeks[$bestFitDeveloper] = ceil($assignments[$bestFitDeveloper]['total_hours'] / 45);
            } else {
                throw new \Exception('No suitable developer found for task: ' . $task->id);
            }
        }

        // Minimum haftayı hesapla
        $minWeeks = max($developerWeeks);
        return ['assignments' => $assignments, 'total_weeks' => $minWeeks];
    }
}
