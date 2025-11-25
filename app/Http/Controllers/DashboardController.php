<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalTasks = Task::count();
        $completed = Task::where('status', 'done')->count();
        $pending = Task::where('status', 'pending')->count();
        $inProgress = Task::where('status', 'in_progress')->count();

        $chartData = Task::selectRaw('DATE(created_at) as date, COUNT(*) as total')
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->take(7)
            ->get();

        return view('dashboard', compact(
            'totalTasks',
            'completed',
            'pending',
            'inProgress',
            'chartData'
        ));
    }
}
