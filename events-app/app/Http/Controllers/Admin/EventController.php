<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::withCount('registrations')
            ->orderBy('start_date')
            ->get();
        return view('admin.events.index', compact('events'));

    }

    public function create()
    {
        return view('admin.events.create');
    }

    public function store(Request $request)
    {
        $data = $this -> validateEvent($request);
        Event::create($data);
        return redirect()-> route('admin.events.index')
        ->with('success', 'Event created.');
    }

    public function edit(Event $event){
        return view('admin.events.edit', compact('event'));
    }

    public function update(Request $request, Event $event){
        $data = $this->validateEvent($request);
        $event->update($data);
        return redirect()->route('admin.events.index');
    }

    public function destroy(Event $event){
        $event->delete();
        return redirect()->route('admin.events.index')
        ->with('success','Event deleted.');
    }

    private function validateEvent(Request $request): array
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|',
            'location' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'capacity' => 'required|integer|min:1',
            'is_published' => 'nullable|boolean',
        ]);
        $validated['is_published'] = $request->boolean('is_published');
        return $validated;
    }
}
