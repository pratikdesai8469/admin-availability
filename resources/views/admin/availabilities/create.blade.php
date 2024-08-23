@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create Availability</div>

                <div class="card-body">
                    <form action="{{ route('availability.store') }}" method="POST" id="availabilityForm">
                        @csrf
                        <div class="form-group">
                            <label for="category">Category</label>
                            <select name="category_id" id="category" class="form-control" required>
                                <option value="" disabled {{ old('category_id') ? '' : 'selected' }}>Select Category</option>
                                @foreach (config('categories') as $id => $name)
                                    <option value="{{ $id }}" {{ old('category_id') == $id ? 'selected' : '' }}>{{ $name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="date">Date</label>
                            <input type="date" name="date" id="date" class="form-control" value="{{ old('date') }}" required>
                            @error('date')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="start_time">Start Time</label>
                            <input type="time" name="start_time" id="start_time" class="form-control" value="{{ old('start_time') }}" required>
                            @error('start_time')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                            @if(session('error'))
                                <div class="text-danger">{{ session('error') }}</div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="end_time">End Time</label>
                            <input type="time" name="end_time" id="end_time" class="form-control" value="{{ old('end_time') }}" required>
                            @error('end_time')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="interval">Interval (minutes)</label>
                            <input type="number" name="interval" id="interval" class="form-control" value="{{ old('interval') }}" required min="1" max="60">
                            @error('interval')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mt-3">
                            <button type="submit" class="btn btn-primary">Save</button>
                            <a href="{{ route('availability.index') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
