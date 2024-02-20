<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{  public function index()
    {
        // Retrieve the ID of the currently logged-in user
        $userId = Auth::id();

        // Retrieve events associated with the logged-in user
        $events = Event::where('user_id', $userId)->get();

        // Format events data for FullCalendar
        $formattedEvents = $events->map(function ($event) {
            return [
                'title' => $event->title,
                'start' => $event->date,
                // Add other event properties as needed
            ];
        });

        // Pass the formatted events data to the view
        return view('home', compact('formattedEvents'));
    }

    public function store(Request $request)
    {
        // Check if the request method is POST
        if ($request->isMethod('post')) {
            // Retrieve form data
            $validatedData = $request->validate([
                'title' => 'required|string|max:255',
                'date' => 'required|date',
            ]);

            // Store the event in the database
            $event = new Event();
            $event->title = $validatedData['title'];
            $event->date = $validatedData['date'];
            $event->user_id = auth()->user()->id;
            $event->save();

            return redirect()->back()->with('success', 'Event added successfully');
        }
    }
}
