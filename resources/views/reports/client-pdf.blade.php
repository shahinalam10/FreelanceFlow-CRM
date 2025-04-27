<!DOCTYPE html>
<html>
<head>
    <title>Client Report - {{ $client->name }}</title>
    <style>
        body { 
            font-family: 'DejaVu Sans', sans-serif;
            margin: 20px;
            font-size: 12px;
        }
        .header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
            border-bottom: 1px solid #eee;
            padding-bottom: 10px;
        }
        .logo {
            font-size: 18px;
            font-weight: bold;
            color: #333;
        }
        .report-title {
            text-align: center;
            margin-bottom: 25px;
        }
        .report-title h2 {
            margin-bottom: 5px;
            color: #2c3e50;
        }
        .report-title h3 {
            margin-top: 0;
            color: #3b7ddd;
        }
        table { 
            width: 100%; 
            margin-top: 15px; 
            border-collapse: collapse; 
            margin-bottom: 25px;
        }
        th, td { 
            border: 1px solid #ddd; 
            padding: 8px; 
            text-align: left; 
        }
        th {
            background-color: #f5f5f5;
            width: 25%;
        }
        .section-title {
            background-color: #f0f0f0;
            padding: 6px 10px;
            margin-top: 25px;
            margin-bottom: 10px;
            font-weight: bold;
            border-left: 4px solid #3b7ddd;
        }
        .sub-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 11px;
        }
        .sub-table th, .sub-table td {
            padding: 6px;
            border: 1px solid #eee;
        }
        .sub-table th {
            background-color: #f9f9f9;
        }
        .badge {
            display: inline-block;
            padding: 3px 6px;
            border-radius: 3px;
            font-size: 11px;
            font-weight: bold;
        }
        .text-muted {
            color: #6c757d;
        }
        .page-break {
            page-break-after: always;
        }
    </style>
</head>
<body>

    <div class="header">
        <div class="date">Generated: {{ now()->format('M d, Y H:i') }}</div>
    </div>

    <div class="report-title">
        <h2>CLIENT DETAILED REPORT</h2>
        <h3>{{ $client->name }}</h3>
    </div>

    <!-- Basic Client Information -->
    <div class="section-title">CLIENT INFORMATION</div>
    <table>
        <tr><th>Name</th><td>{{ $client->name }}</td></tr>
        <tr><th>Email</th><td>{{ $client->email }}</td></tr>
        <tr><th>Phone</th><td>{{ $client->phone }}</td></tr>
        <tr><th>Company</th><td>{{ $client->company ?? 'N/A' }}</td></tr>
        <tr><th>Notes</th><td>{!! nl2br(e($client->notes ?? 'No notes available')) !!}</td></tr>
    </table>

    <!-- Projects Section -->
    <div class="section-title">PROJECTS ({{ $client->projects->count() }})</div>
    @if($client->projects->count() > 0)
    <table class="sub-table">
        <thead>
            <tr>
                <th>Project Name</th>
                <th>Status</th>
                <th>Budget</th>
                <th>Deadline</th>
                <th>Days Remaining</th>
            </tr>
        </thead>
        <tbody>
            @foreach($client->projects as $project)
            <tr>
                <td>{{ $project->title }}</td>
                <td>
                    @php
                        $statusColor = [
                            'Pending' => 'bg-secondary',
                            'Ongoing' => 'bg-warning text-dark',
                            'Completed' => 'bg-success',
                            'Cancelled' => 'bg-danger'
                        ][$project->status] ?? 'bg-info';
                    @endphp
                    <span class="badge {{ $statusColor }}">{{ $project->status }}</span>
                </td>
                <td>${{ number_format($project->budget, 2) }}</td>
                <td>{{ \Carbon\Carbon::parse($project->deadline)->format('M d, Y') }}</td>
                <td>
                    @php
                        $deadline = \Carbon\Carbon::parse($project->deadline);
                        $daysLeft = now()->diffInDays($deadline, false);
                        $daysText = $daysLeft > 0 ? $daysLeft.' days left' : ($daysLeft < 0 ? abs($daysLeft).' days overdue' : 'Today');
                        $daysClass = $daysLeft > 7 ? 'text-success' : ($daysLeft >= 0 ? 'text-warning' : 'text-danger');
                    @endphp
                    <span class="{{ $daysClass }}">{{ $daysText }}</span>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <p class="text-muted">No projects found for this client.</p>
    @endif

    <!-- Interaction Logs Section -->
    <div class="section-title">RECENT INTERACTIONS ({{ $client->interactionLogs->count() }})</div>
    @if($client->interactionLogs->count() > 0)
    <table class="sub-table">
        <thead>
            <tr>
                <th>Date</th>
                <th>Type</th>
                <th>Notes Preview</th>
            </tr>
        </thead>
        <tbody>
            @foreach($client->interactionLogs as $log)
            <tr>
                <td>{{ \Carbon\Carbon::parse($log->interaction_date)->format('M d, Y') }}</td>
                <td>
                    @php
                        $typeColor = [
                            'call' => 'bg-info',
                            'email' => 'bg-primary',
                            'meeting' => 'bg-success'
                        ][$log->type] ?? 'bg-secondary';
                    @endphp
                    <span class="badge {{ $typeColor }}">{{ ucfirst($log->type) }}</span>
                </td>
                <td>{{ \Illuminate\Support\Str::limit($log->notes, 50) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <p class="text-muted">No interaction logs found for this client.</p>
    @endif

    <!-- Reminders Section -->
    <div class="section-title">UPCOMING REMINDERS ({{ $client->reminders->count() }})</div>
    @if($client->reminders->count() > 0)
    <table class="sub-table">
        <thead>
            <tr>
                <th>Due Date</th>
                <th>Title</th>
                <th>Days Remaining</th>
            </tr>
        </thead>
        <tbody>
            @foreach($client->reminders as $reminder)
            <tr>
                <td>{{ \Carbon\Carbon::parse($reminder->due_date)->format('M d, Y') }}</td>
                <td>{{ $reminder->title }}</td>
                <td>
                    @php
                        $dueDate = \Carbon\Carbon::parse($reminder->due_date);
                        $daysLeft = now()->diffInDays($dueDate, false);
                        $daysText = $daysLeft > 0 ? $daysLeft.' days' : ($daysLeft < 0 ? abs($daysLeft).' days ago' : 'Today');
                        $daysClass = $daysLeft > 3 ? 'text-success' : ($daysLeft >= 0 ? 'text-warning' : 'text-danger');
                    @endphp
                    <span class="{{ $daysClass }}">{{ $daysText }}</span>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <p class="text-muted">No upcoming reminders for this client.</p>
    @endif

    <!-- Summary Section -->
    <div class="section-title">SUMMARY</div>
    <table class="sub-table">
        <tr><th>Total Projects</th><td>{{ $client->projects->count() }}</td></tr>
        <tr><th>Active Projects</th><td>{{ $client->projects->where('status', 'Ongoing')->count() }}</td></tr>
        <tr><th>Completed Projects</th><td>{{ $client->projects->where('status', 'Completed')->count() }}</td></tr>
        <tr><th>Total Interactions</th><td>{{ $client->interactionLogs->count() }}</td></tr>
        <tr><th>Upcoming Reminders</th><td>{{ $client->reminders->count() }}</td></tr>
    </table>

</body>
</html>
