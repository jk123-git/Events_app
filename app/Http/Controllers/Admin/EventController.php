<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    { 
        
        $events = Event::all(); 
        // return $events;
        return view('admin.events.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.events.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'location' => 'required|string|max:255',
            'banner_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->except('_token'); 

        // uploadfile
        if ($request->hasFile('banner_image')) {
            // $imagePath = $request->file('banner_image')->store('public/events');
            // $data['banner_image'] = Storage::url($imagePath);

             $imagePath = $request->file('banner_image')->store('events', 'public'); 
                     
             $data['banner_image'] = Storage::url($imagePath);
        }
       

        Event::create($data);
        return redirect()->route('admin.events.index')->with('success', 'Event created successfully!');
    
    }

   public function show(Event $event) 
    {
        return view('admin.events.show', compact('event'));
    }


    public function edit(Event $event) 
    {
        // return $event;

        return view('admin.events.edit', compact('event'));
    }

   
    public function update(Request $request, Event $event) 
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'location' => 'required|string|max:255',
            'banner_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->except(['_token', '_method']); 

        if ($request->hasFile('banner_image')) {
            if ($event->banner_image) {
                Storage::delete(str_replace('/storage/', 'public/', $event->banner_image));
            }
            // $imagePath = $request->file('banner_image')->store('public/events');

            $imagePath = $request->file('banner_image')->store('events', 'public'); 
            $data['banner_image'] = Storage::url($imagePath);
        } else if ($request->input('clear_image')) {
             if ($event->banner_image) {
                Storage::delete(str_replace('/storage/', 'public/', $event->banner_image));
                $data['banner_image'] = null;
            }
        } else {
            unset($data['banner_image']);
        }

        $event->update($data);
        return redirect()->route('admin.events.index')->with('success', 'Event updated successfully!');
    }

    public function destroy(Event $event) 
    {
        if ($event->banner_image) {
            Storage::delete(str_replace('/storage/', 'public/', $event->banner_image));
        }

        $event->delete();
        return redirect()->route('admin.events.index')->with('success', 'Event deleted successfully!');
    }

}
