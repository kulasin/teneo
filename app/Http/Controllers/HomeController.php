<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;
use App\Models\AbsenceType;
use App\Models\Archive;
use Carbon\Carbon;

class HomeController extends Controller
{  public function index()
    {
        // Retrieve the ID of the currently logged-in user
        $userId = Auth::id();
    
        // Retrieve events associated with the logged-in user
        $events = Event::where('user_id', $userId)->get();
    
        // Retrieve absence types
        $absenceTypes = AbsenceType::pluck('name', 'id')->toArray();

    
        // Format events data for FullCalendar
        $formattedEvents = $events->map(function ($event) use ($absenceTypes) {
            return [
                'title' => $this->getEventAbsenceTypeName($event->id), // Get name using absence_type_id
                'start' => $event->date,
                // Add other event properties as needed
            ];
        });
    
        // Pass the formatted events data to the view
        return view('home', compact('formattedEvents', 'absenceTypes'));
    }

    
    

    public function store(Request $request)
    {
        // Check if the request method is POST
        if ($request->isMethod('post')) {
            // Retrieve form data
            $validatedData = $request->validate([
                'title' => 'required|string|max:255',
                'date' => 'required|date',
                'date2' => 'nullable|date', 
            ]);
    
            
    
    // Store the event(s) in the database
if ($validatedData['date2']) {
    // If date2 exists, save events for all dates between date and date2
    $startDate = Carbon::parse($validatedData['date']);
    $endDate = Carbon::parse($validatedData['date2']);

    // Loop through each date between startDate and endDate
    for ($date = $startDate; $date->lte($endDate); $date->addDay()) {
        // Add validation here
        if ($validatedData['title'] === '4') {
            // Check if the user has registered Sick Leave for more than 7 days in the current month
            $user = auth()->user();
            $startOfMonth = strtotime(date('Y-m-01')); // First day of the current month
            $endOfMonth = strtotime(date('Y-m-t')); // Last day of the current month
            
            // Calculate sick leave count
            $sickLeaveCount = $user->events()
                ->where('title', '4')
                ->whereBetween('date', [date('Y-m-d', $startOfMonth), date('Y-m-d', $endOfMonth)])
                ->count();
        
            if ($sickLeaveCount >= 7) {
                return response()->json([
                    'message' => 'You cannot have more then 7 Sick Days in one month.'
                   
                ]);
            }
        } elseif ($validatedData['title'] === '5') {
            // Check if the selected date for Vacation is a weekend
            $dateToCheck = strtotime($date->format('Y-m-d'));
            if (date('N', $dateToCheck) >= 6) { // 6 and 7 represent Saturday and Sunday, respectively
                return response()->json([
                    'message' => 'You cannot register Vacation for a weekend day.'
                   
                ]);
               
            }
        }

        // Create a new Event instance
        $event = new Event();
        $event->title = $validatedData['title'];
        $event->date = $date->format('Y-m-d'); // Format the date as required
        $event->user_id = auth()->user()->id;
        $event->save();
    }
} else {
        if ($validatedData['title'] === '4') {
            // Check if the user has registered Sick Leave for more than 7 days in the current month
            $user = auth()->user();
            $startOfMonth = strtotime(date('Y-m-01')); // First day of the current month
            $endOfMonth = strtotime(date('Y-m-t')); // Last day of the current month
            
            // Calculate sick leave count
            $sickLeaveCount = $user->events()
                ->where('title', '4')
                ->whereBetween('date', [date('Y-m-d', $startOfMonth), date('Y-m-d', $endOfMonth)])
                ->count();
        
            if ($sickLeaveCount >= 7) {
                return response()->json([
                    'message' => 'You cannot have more then 7 Sick Days in one month.'
                   
                ]);
            }
        } elseif ($validatedData['title'] === '5') {
            // Check if the selected date for Vacation is a weekend
            $date = strtotime($validatedData['date']);
            if (date('N', $date) >= 6) { // 6 and 7 represent Saturday and Sunday, respectively

                return response()->json([
                    'message' => 'You cannot register Vacation for a weekend day.'
                   
                ]);
              
            }
        }
        $event = new Event();
        $event->title = $validatedData['title'];
        $event->date = $validatedData['date'];
        $event->user_id = auth()->user()->id;
        $event->save();
    }
    
    
    return response()->json([
        'message' => 'Abcence/s added successfully'
       
    ]);
    
        }
    }


    public function fetch()
    {
        
          // Retrieve the ID of the currently logged-in user
        $userId = Auth::id();
    
        // Retrieve events associated with the logged-in user
        $events = Event::where('user_id', $userId)->get();

        // Format the events into the desired format
        $formattedEvents = $events->map(function ($event) {
            return [
                'title' => $this->getEventAbsenceTypeName($event->id), // Get name using absence_type_id
                'start' => $event->date,
            ];
        });

        
        return response()->json([
           
            'data' => $formattedEvents
        ]);
        
    }

    public function archive()
{
        // Retrieve the ID of the currently logged-in user
        $userId = Auth::id();
    
        // Retrieve events associated with the logged-in user
        $events = Event::where('user_id', $userId)->get();

    // Loop through each event
    foreach ($events as $event) {
        // Check if a similar record already exists in the Archive table
        $existingRecord = Archive::where('title', $event->title)
                                 ->where('date', $event->date)
                                 ->where('user_id', $event->user_id)
                                 ->first();

        // If the record doesn't exist, create a new one
        if (!$existingRecord) {
            Archive::create([
                'title' => $event->title,
                'date' => $event->date,
                'user_id' => $event->user_id
                // Add other required columns
            ]);
        }
    }

    return redirect()->route('archive')->with('success');

}

public function index_arhive()
    {
        // Retrieve the ID of the currently logged-in user
        $userId = Auth::id();

        // Retrieve events associated with the logged-in user
        $events = Archive::where('user_id', $userId)->get();

        $absenceTypes = AbsenceType::pluck('name')->toArray();

        // Format events data for FullCalendar
        $formattedEvents = $events->map(function ($event) {
            return [
                'id' => $event->id,
                'title' => $this->getEventAbsenceTypeName($event->id), // Get name using absence_type_id
                'start' => $event->date,
                'created_at' => $event->created_at,
                // Add other event properties as needed
            ];
        });

        // Pass the formatted events data to the view
        return view('archive', compact('formattedEvents', 'absenceTypes'));

    }

    public function getEventAbsenceTypeName($eventId)
{
    // Retrieve the event by ID
    $event = Event::find($eventId);

    // Check if the event exists and has a valid absence type ID
    if ($event && isset($event->title)) {
        // Retrieve the absence type by ID
        $absenceType = AbsenceType::find($event->title);
        
        // Return the absence type name if found
        if ($absenceType) {
            return $absenceType->name;
        }
    }
    
    // Return a default name if the absence type is not found
    return 'Unknown Absence Type';
}

}
