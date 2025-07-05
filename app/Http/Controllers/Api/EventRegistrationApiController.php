<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Event; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventRegistrationApiController extends Controller
{
    public function __construct()
    {
        // Apply Sanctum authentication middleware.
        // This ensures a valid API token is provided.
        $this->middleware('auth:sanctum');

        // Apply your custom role middleware.
        // This ensures only users with the 'admin' role can access these methods.
        $this->middleware('role:admin');
    }

    /**
     * Returns a JSON list of users registered for a specific event.
     *
     * @param  \App\Models\Event  $event  The event instance (Laravel's Route Model Binding)
     * @return \Illuminate\Http\JsonResponse
     */
    public function registrations(Event $event)
    {
        // Retrieve users registered for this specific event.
        // We use the 'users' relationship defined in the Event model.
        // Select specific columns to avoid exposing sensitive user data (like passwords).
        $registeredUsers = $event->users()->select('id', 'name', 'email')->get();

        // Return the data as a JSON response.
        return response()->json([
            'event_id' => $event->id,
            'event_title' => $event->title,
            'registered_users' => $registeredUsers,
        ]);
    }
}
