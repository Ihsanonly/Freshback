<?php

namespace App\Http\Controllers;

use App\Models\Food;
use Illuminate\Support\Collection;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $foods = Food::query()
            ->orderByDesc('purchase_date')
            ->orderBy('name')
            ->get();

        $sortedFoods = $this->sortFoods($foods);

        return view('dashboard', [
            'totalFoods' => $foods->count(),
            'highPriorityCount' => $foods->where('priority', 1)->count(),
            'mediumPriorityCount' => $foods->where('priority', 2)->count(),
            'safeCount' => $foods->where('priority', 3)->count(),
            'expiredCount' => $foods->where('priority', 0)->count(),
            'priorityFoods' => $sortedFoods
                ->filter(fn (Food $food) => $food->priority > 0)
                ->take(5),
        ]);
    }

    private function sortFoods(Collection $foods): Collection
    {
        return $foods
            ->sort(function (Food $a, Food $b) {
                $priorityA = $a->priority;
                $priorityB = $b->priority;

                $sortA = $priorityA === 0 ? 99 : $priorityA;
                $sortB = $priorityB === 0 ? 99 : $priorityB;

                if ($sortA !== $sortB) {
                    return $sortA <=> $sortB;
                }

                $daysA = $a->days_remaining ?? PHP_INT_MAX;
                $daysB = $b->days_remaining ?? PHP_INT_MAX;

                if ($daysA !== $daysB) {
                    return $daysA <=> $daysB;
                }

                return strcasecmp($a->name, $b->name);
            })
            ->values();
    }
}
