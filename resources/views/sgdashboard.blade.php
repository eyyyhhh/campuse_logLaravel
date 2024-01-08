<!DOCTYPE html>

<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
        <script src='https://code.jquery.com/jquery-3.2.1.min.js'></script>
    
        <!-- css files -->
        <link rel="stylesheet" href="{{ asset('css/profileSG.css') }}">

        <!-- css files -->
        <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">

        {{-- packages for db table --}}
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.0.0/css/buttons.dataTables.min.css">
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>
        <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

    </head>
    
    <script>
        $(document).ready(function () {
            let minDate, maxDate;
    
            $('#dataTable').DataTable({
                dom: 'Bfrtip',
            
            });
        });
    </script>

    <body>   
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">
            <div class="imageLogo">
                <img class="logo" src="{{ asset('images/final_logo.png') }}">
            </div>
        </a>
        <p class="title-lower" style="margin-left: 200px;">User Logs in STI College Balayan</p> 
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse navcon" id="navbarNav">
        
        </div>
        <div class="dateTime">
            <p style="font-weight: 700; margin-top: 17px;">School Guard | &nbsp;</p>
            <div id="dateTime" style="height: fit-content;"></div> 
        </div>
    </nav>
    <div class="maincon">
        <div class="upperCon flex-row d-flex">
            <div class="container1 d-flex col-9 flex-column">
                <div class="tableCon ">
                    <table id="dataTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th style="display: none">User ID</th>
                                <th>Name</th>
                                <th>User type</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Remarks</th>
                               
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($results as $results)
                                <tr>
                                    <td>{{ $results->id }}</td>
                                    <td style="display: none">{{ $results->userid }}</td>
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
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>  
            </div>
            <i class="bi bi-download icon-dl"  id="capture-button" style="color: white; font-size: 1.5rem;"></i>
            <div class="qr_con col-3" id="downloadableQR"  style="background-image: url('{{ asset('images/QR.png') }}')" >
                <h6 style="color: white; margin-top: 220px;">Welcome to</h6>
                <h4 style="color: white;">{{ $admins->schoolName }}</h4> 
            </div> 
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.3.2/html2canvas.min.js"></script>

    <script>
        
        document.addEventListener('DOMContentLoaded', function () {
        const divContent = document.getElementById('downloadableQR');
        const captureButton = document.getElementById('capture-button');

        // Function to capture and convert the div to PNG
        function captureDivAsPNG() {
            html2canvas(divContent).then(function (canvas) {
                const img = new Image();
                img.src = canvas.toDataURL('image/png');

                const newWindow = window.open();
                newWindow.document.body.appendChild(img);
            });
        }
            captureButton.addEventListener('click', captureDivAsPNG);
        });


        // Function to update the date and time display
        function updateDate() {
            const currentDate = new Date();
            const currentTime = new Date();
            
            const dateElement = document.getElementById("dateTime"); 

            const dateString = currentDate.toLocaleDateString('en-US', {
            year: 'numeric', day: 'numeric', month: 'long',});
            const timeString = currentTime.toLocaleTimeString();

            dateElement.textContent = dateString + " | "  +timeString;

        }

        updateDate();

        setInterval(updateDate, 1000);
    </script>


    </body>
</html>
