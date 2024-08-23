<?php

namespace App\Http\Controllers;

use App\Models\Availability;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function showAvailability(Request $request)
    {
        $date = $request->input('date', now()->format('Y-m-d'));
        $categoryId = $request->input('category');
        $endDate = Carbon::parse($date)->copy()->addDays(2);

        // $availabilities = Availability::whereDate('date', $date)
        //     ->when($categoryId, function ($query) use ($categoryId) {
        //         return $query->where('category_id', $categoryId);
        //     })
        //     ->paginate(10);
        $availabilities = Availability::whereBetween('date', [$date, $endDate])
            ->when($categoryId, function ($query, $categoryId) {
                return $query->where('category_id', $categoryId);
            })
            ->orderBy('date')
            ->get();

        $currentDate = Carbon::parse($date);
        
        return view('frontend.availabilities', compact('availabilities', 'currentDate'));
    }
}
