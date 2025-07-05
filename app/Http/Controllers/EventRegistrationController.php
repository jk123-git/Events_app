<?php

namespace App\Http\Controllers;
use App\Models\Event; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class EventRegistrationController extends Controller
{
    public function index()
    {
        $events = Event::all(); 
        $registeredEventIds = [];
        if (Auth::check()) { 
            $registeredEventIds = Auth::user()
                                    ->events
                                    ->pluck('id')
                                    ->toArray(); 
        }

        return view('events.index', compact('events', 'registeredEventIds'));
    }

    /**
     * Register the authenticated user for a specific event.
     */
    public function register(Event $event) // Route model binding
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please log in to register for an event.');
        }

        if (Auth::user()->events()->where('event_id', $event->id)->exists()) {
            return redirect()->back()->with('info', 'You are already registered for this event.');
        }

        Auth::user()->events()->attach($event->id);

        return redirect()->back()->with('success', 'Successfully registered for the event!');
    }

    /**
     * Unregister the authenticated user from a specific event.
     */
    public function unregister(Event $event) // Route model binding
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please log in to unregister from an event.');
        }

        if (!Auth::user()->events()->where('event_id', $event->id)->exists()) {
            return redirect()->back()->with('info', 'You are not registered for this event.');
        }

        Auth::user()->events()->detach($event->id);

        return redirect()->back()->with('success', 'Successfully unregistered from the event.');
    }

}
