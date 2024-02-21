@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Button trigger modal -->
<!-- Button to open the modal -->
<div class="row justify-content-end">
<a href="{{ route('home') }}" class="btn btn-primary mb-4"  style="float:right; width:15%"><i class="fas fa-calculator mr-3"></i> Calculator</a>


</div>
    <div class="row justify-content-center">
       
            <div class="card">
     

<div class="card-body">
    <table id="events-table" class="table w-100 text-center table-bordered">
        <thead>
            <tr class="w-100 text-center">
            <th class="text-center">ID</th>
                <th class="text-center">Type</th>
                <th class="text-center">Date of absence</th>
                <th class="text-center">Created at</th>
                <!-- Add other columns as needed -->
            </tr>
        </thead>
        <tbody>
            @foreach($formattedEvents as $event)
                <tr class="w-100 text-center">
                <td class="text-center mr-2">{{ $event['id'] }}</td>
                    <td class="text-center mr-2">{{ $event['title'] }}</td>
                    <td class="text-center">{{ $event['start'] }}</td>
                    <td class="text-center">{{ $event['created_at'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <script>
$(document).ready(function() {
    $('#events-table').DataTable();
});

    </script>
</div>
            </div>
       
    </div>
</div>
@endsection
