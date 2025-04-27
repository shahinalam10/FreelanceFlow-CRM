<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InteractionLog;
use App\Models\Client;
use Illuminate\Support\Facades\Auth;

class InteractionLogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // In your controller
    public function index(Request $request)
    {
        $logs = InteractionLog::with('client')
            ->where('user_id', Auth::id()) // ✅ Only own logs
            ->when($request->search, function($query) use ($request) {
                $query->whereHas('client', function($q) use ($request) {
                    $q->where('name', 'like', '%'.$request->search.'%');
                })
                ->orWhere('notes', 'like', '%'.$request->search.'%');
            })
            ->when($request->type, function($query) use ($request) {
                $query->where('type', $request->type);
            })
            ->when($request->client_id, function($query) use ($request) {
                $query->where('client_id', $request->client_id);
            })
            ->latest()
            ->paginate(10);
    
        $clients = Client::orderBy('name')->get();
    
        return view('interaction_logs.index', compact('logs', 'clients'));	
    }
    
   
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clients = Auth::user()->clients;
        return view('interaction_logs.create', compact('clients'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'type' => 'required|in:call,email,meeting',
            'interaction_date' => 'required|date',
            'notes' => 'nullable|string',
        ]);

        InteractionLog::create([
            'user_id' => Auth::id(),
            ...$request->all()
        ]);

        return redirect()->route('interaction-logs.index')->with('success', 'Interaction log added.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(InteractionLog $interactionLog)
    {
        $this->authorizeLog($interactionLog);

        $clients = Auth::user()->clients;
        return view('interaction_logs.edit', compact('interactionLog', 'clients'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, InteractionLog $interactionLog)
    {
        $this->authorizeLog($interactionLog);
    
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'type' => 'required|in:call,email,meeting',
            'interaction_date' => 'required|date',
            'notes' => 'nullable|string',
        ]);
    
        $interactionLog->update($request->all());
    
        return redirect()->route('interaction-logs.index')->with('success', 'Interaction log updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(InteractionLog $interactionLog)
    {
        $this->authorizeLog($interactionLog);
    
        $interactionLog->delete();
    
        return redirect()->route('interaction-logs.index')->with('success', 'Interaction log deleted.');
    }
    
    protected function authorizeLog(InteractionLog $interactionLog)
    {
        if ($interactionLog->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
    }
}
