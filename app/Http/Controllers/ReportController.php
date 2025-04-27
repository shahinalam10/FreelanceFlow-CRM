<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function index()
    {
        $clients = Auth::user()->clients()
            ->withCount(['projects', 'interactionLogs', 'reminders'])
            ->latest()
            ->paginate(15); // ✅ paginate instead of get()
            
        return view('reports.index', compact('clients'));
    }


    public function generatePdf(Client $client)
    {
        $this->authorizeClient($client);
        
        // Load relationships with optimized queries
        $client->load([
            'projects' => function($query) {
                $query->select(['id', 'client_id', 'title', 'status', 'budget', 'deadline'])
                    ->orderBy('deadline', 'desc')
                    ->limit(10);
            },
            'interactionLogs' => function($query) {
                $query->select(['id', 'client_id', 'type', 'interaction_date', 'notes'])
                    ->orderBy('interaction_date', 'desc')
                    ->limit(10);
            },
            'reminders' => function($query) {
                $query->select(['id', 'client_id', 'title', 'due_date'])
                    ->where('due_date', '>=', Carbon::today())
                    ->orderBy('due_date', 'asc')
                    ->limit(5);
            }
        ]);

        $pdf = Pdf::loadView('reports.client-pdf', compact('client'));
        return $pdf->stream('client_report_'.$client->id.'.pdf');
    }

    public function downloadPdf(Client $client)
    {
        $this->authorizeClient($client);
        
        // Same loading as generatePdf
        $client->load([
            'projects' => function($query) {
                $query->select(['id', 'client_id', 'title', 'status', 'budget', 'deadline'])
                    ->orderBy('deadline', 'desc')
                    ->limit(10);
            },
            'interactionLogs' => function($query) {
                $query->select(['id', 'client_id', 'type', 'interaction_date', 'notes'])
                    ->orderBy('interaction_date', 'desc')
                    ->limit(10);
            },
            'reminders' => function($query) {
                $query->select(['id', 'client_id', 'title', 'due_date'])
                    ->where('due_date', '>=', Carbon::today())
                    ->orderBy('due_date', 'asc')
                    ->limit(5);
            }
        ]);

        $pdf = Pdf::loadView('reports.client-pdf', compact('client'));
        return $pdf->download('client_report_'.$client->id.'.pdf');
    }

    protected function authorizeClient(Client $client)
    {
        if ($client->user_id !== Auth::id()) {
            abort(403);
        }
    }
}