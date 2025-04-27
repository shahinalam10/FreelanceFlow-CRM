<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $clientIds = Auth::user()->clients->pluck('id');
        $query = Project::whereIn('client_id', $clientIds);

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $projects = $query->latest()->paginate(10)->withQueryString();

        return view('projects.index', compact('projects'));
    }


    public function create()
    {
        $clients = Auth::user()->clients;
        return view('projects.create', compact('clients'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'title' => 'required|string',
            'budget' => 'required|numeric',
            'deadline' => 'required|date',
            'status' => 'required|in:Pending,Ongoing,Completed',
        ]);

        // Check ownership
        $client = Client::findOrFail($request->client_id);
        if ($client->user_id !== Auth::id()) {
            abort(403);
        }

        Project::create($request->all());

        return redirect()->route('projects.index')->with('success', 'Project added successfully!');
    }

    public function edit(Project $project)
    {
        $this->authorizeProject($project);
        $clients = Auth::user()->clients;
        return view('projects.edit', compact('project', 'clients'));
    }

    public function update(Request $request, Project $project)
    {
        $this->authorizeProject($project);

        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'title' => 'required|string',
            'budget' => 'required|numeric',
            'deadline' => 'required|date',
            'status' => 'required|in:Pending,Ongoing,Completed',
        ]);

        $project->update($request->all());

        return redirect()->route('projects.index')->with('success', 'Project updated successfully!');
    }

    public function destroy(Project $project)
    {
        $this->authorizeProject($project);
        $project->delete();

        return redirect()->route('projects.index')->with('success', 'Project deleted!');
    }

    protected function authorizeProject(Project $project)
    {
        if ($project->client->user_id !== Auth::id()) {
            abort(403);
        }
    }
}
