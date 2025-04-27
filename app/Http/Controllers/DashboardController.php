<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Reminder;
use App\Models\InteractionLog;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $clientCount = $user->clients()->count();
        $projectCount = Project::whereIn('client_id', $user->clients->pluck('id'))->count();

        $statusSummary = Project::whereIn('client_id', $user->clients->pluck('id'))
            ->select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->get();

        // ✅ Add this block to fetch upcoming projects
        $upcomingProjects = Project::whereIn('client_id', $user->clients->pluck('id'))
            ->whereDate('deadline', '>=', now())
            ->orderBy('deadline')
            ->take(5)
            ->get();

        $upcomingReminders = Reminder::where('user_id', $user->id)
            ->whereBetween('due_date', [now(), now()->addDays(7)])
            ->orderBy('due_date')
            ->get();

        $recentInteractions = InteractionLog::where('user_id', $user->id)
            ->latest('interaction_date')
            ->with('client')
            ->take(5)
            ->get();    

        return view('dashboard', compact(
                'clientCount',
                'projectCount',
                'statusSummary',
                'upcomingProjects',
                'upcomingReminders',
                'recentInteractions' // ✅ Pass to view
            ));
    }

}
