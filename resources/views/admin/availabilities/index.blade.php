@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <!-- Display success message -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="d-flex justify-content-between mb-3">
        <h2>Availability List</h2>
        <a href="{{ url('admin/availability/create') }}" class="btn btn-sm btn-primary">Create New Availability</a>
    </div>

    <div class="card">
        <div class="card-body">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Category</th>
                        <th>Date</th>
                        <th>Start Time</th>
                        <th>End Time</th>
                        <th>Interval (Minutes)</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($availabilities as $availability)
                        <tr>
                            <td>{{ config('categories')[$availability->category_id] }}</td>
                            <td>{{ $availability->date }}</td>
                            <td>{{ \Carbon\Carbon::parse($availability->start_time)->format('g:i A') }}</td>
                            <td>{{ \Carbon\Carbon::parse($availability->end_time)->format('g:i A') }}</td>
                            <td>{{ $availability->interval }}</td>
                            <td>
                                <form action="{{ route('availability.destroy', $availability->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this item?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">No availabilities found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="d-flex justify-content-center mt-3">
                {{ $availabilities->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
</div>
@endsection
