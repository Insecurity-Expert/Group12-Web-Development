<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Registration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class RegistrationController extends Controller
{
    /**
     * Show all published events an attendee can register for.
     */
    public function index()
    {
        $events = Event::where('is_published', true)
            ->orderBy('start_date')
            ->withCount(['registrations' => function ($query) {
                $query->where('status', 'confirmed');
            }])
            ->get();

        return view('events.index', compact('events'));
    }

    /**
     * Show one event's details + the register button.
     */
    public function show(Event $event)
    {
        $confirmedCount = $event->registrations()->where('status', 'confirmed')->count();
        $slotsLeft = max($event->capacity - $confirmedCount, 0);

        $alreadyRegistered = Registration::where('user_id', Auth::id())
            ->where('event_id', $event->id)
            ->where('status', 'confirmed')
            ->exists();

        return view('events.show', compact('event', 'slotsLeft', 'alreadyRegistered'));
    }

    /**
     * Register the logged-in user for an event.
     */
    public function store(Request $request, Event $event)
    {
        // Stop duplicate sign-ups for the same event.
        $alreadyRegistered = Registration::where('user_id', Auth::id())
            ->where('event_id', $event->id)
            ->where('status', 'confirmed')
            ->exists();

        if ($alreadyRegistered) {
            return redirect()
                ->route('events.show', $event)
                ->with('error', 'You are already registered for this event.');
        }

        // Stop sign-ups once the event is full.
        $confirmedCount = $event->registrations()->where('status', 'confirmed')->count();

        if ($confirmedCount >= $event->capacity) {
            return redirect()
                ->route('events.show', $event)
                ->with('error', 'Sorry, this event is already full.');
        }

        Registration::create([
            'user_id' => Auth::id(),
            'event_id' => $event->id,
            'registration_code' => $this->generateUniqueCode(),
            'status' => 'confirmed',
            'is_checked_in' => false,
        ]);

        return redirect()
            ->route('registrations.mine')
            ->with('success', 'You\'re registered! Your ticket is ready below.');
    }

    /**
     * Show the logged-in user's tickets.
     */
    public function myTickets()
    {
        $registrations = Registration::where('user_id', Auth::id())
            ->with('event')
            ->latest()
            ->get();

        return view('registrations.my-tickets', compact('registrations'));
    }

    /**
     * Make a short, unique, human-readable ticket code, e.g. "EVT-7K2F9Q".
     */
    private function generateUniqueCode(): string
    {
        do {
            $code = 'EVT-' . strtoupper(Str::random(6));
        } while (Registration::where('registration_code', $code)->exists());

        return $code;
    }
}