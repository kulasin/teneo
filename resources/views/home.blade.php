@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Button trigger modal -->
<!-- Button to open the modal -->
<div class="row justify-content-end">
<button class="btn btn-success mb-2" id="openModalBtn" style="float:right; width:15%">+ Add new absence</button>

<!-- The modal -->
<div id="myModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <form id="eventForm" action="{{ route('store-event') }}" method="POST">
        @csrf
                    <div class="form-group">
                        <label for="title">Absence Type</label>
                        <select name="title"  class="form-control" id="eventStatus">
    <option value="authorised">Authorised</option>
    <option value="unplanned">Unplanned</option>
    <option value="unauthorised">Unauthorised</option>
    <option value="sick leave">Sick Leave</option>
</select>

                    </div>
                    <div class="form-group">
                        <label for="date">Date</label>
                        <input type="date" class="form-control" id="date" name="date">
                    </div>
                    <button type="submit" class="btn btn-primary mt-5 w-100">Submit</button>
                </form>
    </div>
</div>
</div>
    <div class="row justify-content-center">
       
            <div class="card">
                <div class="card-header">Calendar</div>

                <div class="card-body">
                <div id='calendar'></div>
                </div>
            </div>
       
    </div>
</div>
@endsection
