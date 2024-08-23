<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAvailabilityRequest;
use App\Models\Availability;
use Illuminate\Http\Request;

class AvailabilityController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $availabilities = Availability::paginate(10);

        return view('admin.availabilities.index', compact('availabilities'));
    }

    public function create()
    {
        return view('admin.availabilities.create');
    }

    public function store(StoreAvailabilityRequest $request)
    {
        
        $validated = $request->validated();
    
        $startTime = $validated['start_time'];
        $endTime = $validated['end_time'];
        $date = $validated['date'];

        // Check if the time slot is available
        if (!$this->isTimeSlotAvailable($startTime, $endTime, $date)) {
            return redirect()->back()->withInput()->with('error', 'The time slot is already taken or overlaps with another availability.');
        }

        // Create the availability if the time slot is available
        Availability::create($validated);
        return redirect()->route('availability.index')->with('success', 'Availability created successfully.');
    }

    public function destroy(Availability $availability)
    {
        if ($availability) {
            $availability->delete();
            return redirect()->route('availability.index')->with('success', 'Availability deleted successfully.');
        } else {
            return redirect()->route('availability.index')->with('error', 'Availability not found.');
        }
    }

    public function isTimeSlotAvailable($startTime, $endTime, $date)
    {
        return !Availability::where('date', $date)
            ->where(function ($query) use ($startTime, $endTime) {
                $query->whereBetween('start_time', [$startTime, $endTime])
                    ->orWhereBetween('end_time', [$startTime, $endTime])
                    ->orWhere(function ($query) use ($startTime, $endTime) {
                        $query->where('start_time', '<=', $startTime)
                                ->where('end_time', '>=', $endTime);
                    });
            })
            ->exists();
    }

    
    
}
