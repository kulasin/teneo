@extends('layouts.app')

@section('content')

<div class="container">
    <!-- Button trigger modal -->
<!-- Button to open the modal -->
<div class="row justify-content-end">
    <!-- Your view file -->
<form action="{{ route('archive') }}" method="POST" style="width:17%">
    @csrf
    <button type="submit" class="btn mb-4 btn-warning w-100"><i class="fa fa-archive mr-3"></i> Archive Records</button>
</form>

<button class="btn btn-success mb-4" id="openModalBtn" style="float:right; width:15%"><i class="fa fa-plus mr-3"></i> Add new absence</button>

<!-- The modal -->
<div id="myModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
      <!-- Include Axios library -->


<!-- Your form -->
<form id="eventForm">
    @csrf
    <div class="form-group">
        <label for="title">*Absence Type</label>
        <select name="title" class="form-control" id="eventStatus">
        @foreach($absenceTypes as $id => $type)
    <option value="{{ $id }}">{{ $type }}</option>
@endforeach

        </select>
    </div>
    <div class="form-group mt-3">
        <label for="date">*Date from:</label>
        
        <input required type="date" class="form-control" id="date" name="date">
    </div>

    <div class="form-group mt-3">
        <label for="date">Date to:</label>
        
        <input type="date" class="form-control" id="date2" name="date2">
    </div>
    <button type="button" class="btn btn-primary mt-5 w-100" onclick="submitForm()"><i class="fa fa-save mr-3"></i> Submit</button>
</form>


<script>
    var calendar; // Declare the calendar variable globally to make it accessible

    // Function to initialize the calendar
    function initCalendar() {
        var calendarEl = document.getElementById('calendar');
        calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            events: [], // Initialize with empty events
            selectable: true,
            firstDay: 1,
            selectInfo: true
        });
        calendar.render();
    }

    // Function to submit form data and update calendar
    function submitForm() {
    // Get form data
    var formData = {
        title: document.getElementById('eventStatus').value,
        date: document.getElementById('date').value,
        date2: document.getElementById('date2').value
    };

    // Send POST request to the server using Axios
    axios.post('{{ route("store-event") }}', formData)
        .then(function(response) {
            // Handle success response
            console.log(response.data);

                  
            // Extract message and formattedEvents from response data
            var message = response.data.message;
            
            
            // Alert the success message
            alert(message);
            
            // Refresh data without reloading the page
            fetchData(); // Call fetchData to update the calendar
            // Close the modal
            closeModal();
            // Show success message to the user
           
        })
        .catch(function(error) {
            // Handle error response
            console.error(error);
            if (error.response && error.response.data && error.response.data.error) {
                // Display error message to the user
                alert(error.response.data.error);
            } else {
                // Show generic error message if no specific error message is returned from the server
                alert('An error occurred while registering the event.');
            }
        });
}


    // Function to close the modal
    function closeModal() {
        var modal = document.getElementById('myModal');
        modal.style.display = 'none';
    }

    // Function to fetch data from the server and update calendar
// Function to fetch data from the server and update calendar
function fetchData() {
    axios.get('{{ route("fetch-data") }}')
        .then(function(response) {
            console.log("Response data:", response.data); // Log response data
            
            // Extract message and formattedEvents from response data
           
            var formattedEvents = response.data.data;
            
            // Alert the success message
           
            
            // Update the calendar with the new data
            if (calendar) {
                calendar.removeAllEvents(); // Remove existing events if the calendar is initialized
                calendar.addEventSource(formattedEvents); // Add new events
            } else {
                console.error("Calendar is not initialized.");
            }
        })
        .catch(function(error) {
            console.error(error);
        });
}




    // Initialize the calendar and fetch initial event data when the document is loaded
    document.addEventListener('DOMContentLoaded', function() {
        initCalendar(); // Initialize the calendar
        fetchData(); // Fetch initial event data
    });
</script>






    </div>
</div>
</div>
    <div class="row justify-content-center">
       
            <div class="card">
            <div id="successMessage"></div>
                
                <style>
.fc-day-sun, .fc-day-sat { background-color:lightblue; }

    </style>

                <div class="card-body">
                <div id='calendar' class="w-100"></div>
                </div>
            </div>
       
    </div>
</div>
@endsection
