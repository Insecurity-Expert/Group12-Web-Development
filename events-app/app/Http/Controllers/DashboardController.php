<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Registration;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $isAdmin = Auth::user()->role === 'admin';

        if ($isAdmin) {
            $stats = [
                'events' => Event::count(),
                'registrations' => Registration::count(),
                'checkedIn' => Registration::where('is_checked_in', true)->count(),
                'capacity' => Event::sum('capacity'),
            ];
        } else {
            $stats = [
                'myTickets' => Registration::where('user_id', Auth::id())->count(),
                'checkedIn' => Registration::where('user_id', Auth::id())->where('is_checked_in', true)->count(),
            ];
        }

        $upcoming = Event::where('is_published', true)
            ->where('start_date', '>=', now())
            ->orderBy('start_date')
            ->withCount(['registrations' => fn($q) => $q->where('status', 'confirmed')])
            ->take(4)
            ->get();

        return view('dashboard', compact('isAdmin', 'stats', 'upcoming'));
    }
}
