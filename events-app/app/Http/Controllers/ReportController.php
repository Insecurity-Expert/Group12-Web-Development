<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Registration;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        // Calculate the core metrics
        $totalCapacity = Event::sum('capacity');
        $totalRegistrations = Registration::count();
        $totalCheckedIn = Registration::where('is_checked_in', true)->count();

        // Pass the data to your specific view folder
        return view('reports.index', compact('totalCapacity', 'totalRegistrations', 'totalCheckedIn'));
    }

}
