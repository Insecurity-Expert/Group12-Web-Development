<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Registration;
use Illuminate\Http\Request;

class ReportController extends Controller
{
   public function index()
{
    $totalCapacity = Event::sum('capacity');
    $totalRegistrations = Registration::count();
    $totalCheckedIn = Registration::where('is_checked_in', true)->count();

    $events = Event::withCount([
        'registrations',
        'registrations as checked_in_count' => fn($q) => $q->where('is_checked_in', true),
    ])->orderBy('start_date')->get();

    return view('reports.index', compact('totalCapacity','totalRegistrations','totalCheckedIn','events'));
}

}
