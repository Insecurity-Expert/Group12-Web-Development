<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Registration;
use Illuminate\Http\Request;

class CheckInController extends Controller
{
    public function index(Request $request)
    {
        if ($request->user()->role !== 'admin') {
            abort(403, 'Unauthorized.');
        }

        return view('admin.check-in.index');
    }

    public function process(Request $request)
    {
        if ($request->user()->role !== 'admin') {
            abort(403, 'Unauthorized.');
        }

        $request->validate([
            'registration_code' => 'required|string',
        ]);

        $code = $request->input('registration_code');

        $registration = Registration::with(['user', 'event'])
            ->where('registration_code', $code)
            ->first();

        if (!$registration) {
            return redirect()
                ->route('admin.check-in.index')
                ->with('error', "Registration code '{$code}' not found.");
        }

        if ($registration->is_checked_in) {
            return redirect()
                ->route('admin.check-in.index')
                ->with('info', "Attendee {$registration->user->name} is already checked in for {$registration->event->title}.");
        }

        $registration->is_checked_in = true;
        $registration->save();

        return redirect()
                    ->route('admin.check-in.index')
                    ->with('success', "Successfully checked in {$registration->user->name} for {$registration->event->title}!");
    }
}
