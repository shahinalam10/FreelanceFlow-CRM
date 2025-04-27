<?php

namespace App\Http\Controllers;

use App\Models\Reminder;
use App\Models\Client;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ReminderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reminders = Reminder::where('user_id', Auth::id())
            ->whereBetween('due_date', [now(), now()->addDays(7)])
            ->orderBy('due_date')
            ->get();

        return view('reminders.index', compact('reminders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clients = Auth::user()->clients;
        $projects = Project::whereIn('client_id', $clients->pluck('id'))->get();
        return view('reminders.create', compact('clients', 'projects'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'due_date' => 'required|date',
            'client_id' => 'nullable|exists:clients,id',
            'project_id' => 'nullable|exists:projects,id',
            'notes' => 'nullable|string',
        ]);

        Reminder::create([
            'user_id' => Auth::id(),
            ...$request->all()
        ]);

        return redirect()->route('reminders.index')->with('success', 'Reminder added successfully!');
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
    public function edit(Reminder $reminder)
    {
        $this->authorizeReminder($reminder);

        $clients = Auth::user()->clients;
        $projects = Project::whereIn('client_id', $clients->pluck('id'))->get();

        return view('reminders.edit', compact('reminder', 'clients', 'projects'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reminder $reminder)
    {
        $this->authorizeReminder($reminder);

        $request->validate([
            'title' => 'required|string',
            'due_date' => 'required|date',
            'client_id' => 'nullable|exists:clients,id',
            'project_id' => 'nullable|exists:projects,id',
            'notes' => 'nullable|string',
        ]);

        $reminder->update($request->all());

        return redirect()->route('reminders.index')->with('success', 'Reminder updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reminder $reminder)
    {
        $this->authorizeReminder($reminder);
    
        $reminder->delete();
    
        return redirect()->route('reminders.index')->with('success', 'Reminder deleted successfully!');
    }
    protected function authorizeReminder(Reminder $reminder)
    {
        if ($reminder->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
    }
}
