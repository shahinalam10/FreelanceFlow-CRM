@extends('includes.master')
@section('title', 'Clients Report')

@section('content')
<main id="main" class="main">

    <div class="container py-4">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0">Clients Report</h2>
            <a href="{{ route('dashboard') }}" class="btn btn-outline-primary btn-sm">
                <i class="bi bi-arrow-left-circle"></i> Back to Dashboard
            </a>
        </div>

        <div class="card shadow-sm border-0">
            <div class="card-body">

                @if ($clients->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col">Client Name</th>
                                    <th scope="col" class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($clients as $client)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div>
                                                    <strong>{{ $client->name }}</strong>
                                                    <div class="small text-muted">{{ $client->email ?? 'No Email' }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('clients.pdf', $client) }}" target="_blank" class="btn btn-sm btn-info me-2">
                                                <i class="bi bi-eye"></i> View PDF
                                            </a>
                                            <a href="{{ route('clients.pdf.download', $client) }}" class="btn btn-sm btn-success">
                                                <i class="bi bi-download"></i> Download PDF
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="d-flex justify-content-center mt-4">
                        {{ $clients->links() }}
                    </div>

                @else
                    <div class="alert alert-warning text-center" role="alert">
                        No clients found.
                    </div>
                @endif

            </div>
        </div>

    </div>

</main>
@endsection
