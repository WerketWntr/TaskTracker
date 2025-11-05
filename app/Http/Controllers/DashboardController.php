<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Подсчёты
        $totalTasks = $user->tasks()->count();
        $completedTasks = $user->tasks()->whereNotNull('completed_at')->count();
        $pendingTasks = $user->tasks()->whereNull('completed_at')->count();
        $completedToday = $user->tasks()
            ->whereDate('completed_at', now()->toDateString())
            ->count();
        $overdueTasks = $user->tasks()
            ->where('due_date', '<', now())
            ->whereNull('completed_at')
            ->count();

        // Предстоящие задачи (сегодня и завтра)
        $upcomingTasks = $user->tasks()
            ->whereDate('due_date', '>=', now()->toDateString())
            ->whereDate('due_date', '<=', now()->addDay()->toDateString())
            ->orderBy('due_date')
            ->get();

        return view('dashboard.index', compact(
            'totalTasks',
            'completedTasks',
            'pendingTasks',
            'completedToday',
            'overdueTasks',
            'upcomingTasks'
        ));
    }
}
