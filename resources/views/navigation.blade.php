<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Campus e-log</title>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
        <script src='https://code.jquery.com/jquery-3.2.1.min.js'></script>
        <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>
    
        <!-- Styles -->
        <style>
            
        </style>
    </head>
    <body class="antialiased">
        {{-- navigation --}}
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#">
            <div class="imageLogo">
                <img class="logo" src="{{ asset('images/final_logo.png') }}">
            </div>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse navcon" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item ">
                    <a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('logs') }}">Logs</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('users') }}">Users</a>
                </li>
            </ul>
            </div>
            <div class="dateTime">
            <p style="font-weight: 700; margin-top: 17px;">System Administrator | &nbsp;</p>
            <div id="dateTime" style="height: fit-content;"></div> 
            </div>
        </nav>
        {{-- dashboard --}}
        <div class="home-content">
            @yield('content')
        </div>
    </body>
    <script>

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
</html>
