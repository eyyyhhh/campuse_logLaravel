@extends('navigation')

@section('content')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.3.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.0.0-rc.5/html2canvas.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.3.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.0.0-rc.5/html2canvas.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>

{{-- packages for db table --}}
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.0.0/css/buttons.dataTables.min.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.0.0/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.html5.min.js"></script>

<!-- Include the daterangepicker CSS -->
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker@3.1.0/daterangepicker.css" />

<!-- Include the moment.js library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

<!-- Include the daterangepicker JS -->
<script src="https://cdn.jsdelivr.net/npm/daterangepicker@3.1.0/daterangepicker.js"></script>

<!-- css files -->
<link rel="stylesheet" href="{{ asset('css/userslogs.css') }}">
 
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.0.0/css/buttons.dataTables.min.css">

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>

<!-- Bootstrap JavaScript and dependencies -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-wDpX4ZF5Ll9IBk4RBAKc8RHz+7OrDZagQF+6LcIM8nXx2givczdGqLMI8DlO2K5" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8sh+WyK8aIaZl9tiPqVc8/9aH1ta59S7Y1xl" crossorigin="anonymous"></script>
<!-- Add these lines to the head section of your layout file -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script>
    $(document).ready(function () {
        let minDate, maxDate;
        var userTypeFilter = ''; // Variable to store the selected user type filter
    var remarksFilter = '';
 
        var table =$('#dataTable').DataTable({
            "columnDefs": [
            { "targets": 5, "type": "date" } // Assuming the date column is at index 5
        ],
            dom: 'Bfrtip',
            buttons: [
                'copy', 'print', 'csv', '', 
                {
                    extend: 'pdfHtml5',
                    exportOptions: {
                        columns: ':not(.exclude-pdf)'
                    },
                    customize: function (doc) {
                        var hasFilters = userTypeFilter || remarksFilter;
                    // Add additional information to the PDF
                    var currentDate = new Date().toLocaleDateString();
                    var currentTime = new Date().toLocaleTimeString();
                    var headertext =  "";
                    if (hasFilters) {
                        headertext = '\n' + '\n' +'User Type: ' + userTypeFilter + '\n' +'Remarks: ' +  remarksFilter;
                        }

                    doc.content.unshift({
                        text: "Date: " + currentDate + " |  Time: " + currentTime + headertext,
                        style: 'header'
                        });
                    }
                },
                {
                    extend: 'excelHtml5',
                    exportOptions: {
                        columns: ':not(.exclude-pdf)'
                    }
                }
            ]
        });
        // Filter
    $('#usertype').on('change', function () {
        userTypeFilter = $(this).val();
        $('#dataTable').DataTable().column(3).search(userTypeFilter).draw();
    });
       // Filter by Remarks
    $('#remarks').on('change', function () {
        remarksFilter = $(this).val();
        $('#dataTable').DataTable().column(6).search(remarksFilter, true, false).draw();
    });
    // Date range filtering
    $('.date-filter').on('change', function () {
        var startDate = $('#startDate').val();
        var endDate = $('#endDate').val();

        // Perform date range filtering
        table.column(4).search('12/01/2023 - 01/18/2024').draw();
    });
 });
  
 </script>

<div class="maincon">
    <div class="container1">

        <!-- Backup Button -->
    <form action="{{ route('backup') }}" method="get">
        @csrf
        <button type="submit">Backup</button>
    </form>

    <!-- Restore Button -->
    <form action="{{ route('restore') }}" method="get">
        @csrf
        <button type="submit">Restore</button>
    </form>
<div>
    <label for="startDate">From:</label>
    <input type="date" id="startDate" class="date-filter">
</div>

<div>
    <label for="endDate">To:</label>
    <input type="date" id="endDate" class="date-filter">
</div>
        <!-- Search Container -->
        <div class="d-flex search-con">
            <div style="width: fit-content; margin-right: 30px; ">
                <label for="usertype">User Type</label>
                <select name="usertype" class="drop-down" id="usertype" >
                    <option class="value" value="" >Show All</option>
                    <option class="value" value="Student">Student</option>
                    <option class="value" value="School Personnel">School Personnel</option>
                    <option class="value" value="Security Guard">Security Guard</option>
                    <option class="value" value="Visitor">Visitor</option>
                </select>
            </div>
            <div style="width: fit-content; margin-right: 30px;">
                <label for="usertypes">Remarks</label>
                <select name="remarks" class="drop-down" id="remarks" >
                    <option class="value" value="" >Show All</option>
                    <option class="value" value="Valid">Valid Pass</option>
                    <option class="value" value="Mask Required">Mask Required</option>
                    <option class="value" value="Invalid">Invalid Pass</option>
                </select>
            </div>
            <div style="width: fit-content; margin-right: 30px;">
                <label for="usertype">Date From</label>
                <div  class="primaryBtn">
                    <input type="date" id="startDate" class="datePicker ">
                </div>
            </div>
            <div style="width: fit-content;">
                <label for="usertype">Date To</label>    
                <div type="button" class="primaryBtn">
                    <input type="date" id="endDate"  class="datePicker">
                </div>
            </div>
        </div>
    </div>
    <div class="container2">
        <div class="tableCon ">
            <table id="dataTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th >User number</th>
                        <th>Name</th>
                        <th>User type</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Remarks</th>
                        <th>User Address</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($results as $results)
                        <tr>
                            <td>{{ $results->id }}</td>
                            <td >{{ $results->usernum }}</td>
                            <td>{{ $results->name }}</td>
                            <td>{{ $results->usertype }}</td>
                            <td>{{ $results->date }}</td>
                            <td>{{ $results->time }}</td>
                            <td>
                                @if($results->remarks == 0)
                                    Valid
                                @elseif($results->remarks == 1)
                                    Mask Required
                                @elseif($results->remarks == 2)
                                    Invalid
                                @endif
                            </td> 
                            <td>{{ $results->address }}</td>
                            <td col-1>
                                <a href="{{ url('/viewlogs', [ $results->userid, $results->schoolid,  $results->id,$results->pid]) }}"><i class="bi bi-eye-fill"></i></a>
                            </td>
                          
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div> 
   <script src="https://unpkg.com/jspdf-invoice-template@1.4.0/dist/index.js"></script> 

@endsection