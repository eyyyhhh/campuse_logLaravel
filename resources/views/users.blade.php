@extends('navigation')

@section('content')

<!-- css files -->
<link rel="stylesheet" href="{{ asset('css/users.css') }}">

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
        $('#dataTable').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'print', 'csv', '', 
                {
                    extend: 'pdfHtml5',
                    exportOptions: {
                        columns: ':not(.exclude-pdf)'
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
        $('#myModal').modal({
                backdrop: 'static',
                keyboard: false,
                hide
        });$('#myModals').modal({
                backdrop: 'static',
                keyboard: false,
                hide
        });
    });
</script>
<div class="maincon">
    <div class="container1">
        <div class="d-flex flex-column" style="margin-right: 100px; margin-left: 50px ">
            <h2 style="color: white">Bulk Upload Form</h2>

            @if(session('success'))
                <div style="color: rgb(255, 255, 255);">{{ session('success') }}</div>
            @endif
        
            <form action="/import" method="post" enctype="multipart/form-data"  class="d-flex flex-row">
                @csrf
                <div class="d-flex flex-column" >
                    <label for="file" >Choose Excel or CSV file:</label>
                    <input type="file" name="file" accept=".xlsx, .csv" required class="thirdBtn">
                </div>
                <button class="secBtn" type="submit">Import</button>
            </form>
        </div>
       <div class="d-flex flex-column" >
       
            <div class="box-con d-flex flex-row">
                <div class="box d-flex flex-column">
                    <p class="desc-num"> {{ $student }} </p>
                <p class="title-box"> Total Number of Students</p>
                </div>
                <div class="box d-flex flex-column">
                    <p class="desc-num"> {{ $spersonnel }} </p>
                    <p class="title-box"> Total Number of School Personnel</p>
                </div>
            </div>
       </div>
        <button type="button" class="primaryBtn " data-toggle="modal" data-target="#myModal">
            Add User
        </button>
    </div>
    <div class="container2">
       
        <!-- Table for registered user -->
        <div class="tableCon ">
            <table id="dataTable">
                <thead>
                    <tr>
                        <td class="exclude-pdf" style="display: none "></td>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Age</th>
                        <th>Birthdate</th>
                        <th>Gender</th>
                        <th>User type</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($posts as $post)
                        <tr id="user-{{$post->id}}">
                            <td class="userPass exclude-pdf" style="display: none;">{{ $post->password }}</td>
                                <td class="userNum">{{ $post->usernum }}</td>
                                <td class="userName">{{ $post->username }}</td>
                                <td class="userAge">{{ $post->age }}</td>
                                <td class="userBirthdate">{{ $post->birthdate }}</td>
                                <td class="userGender">{{ $post->gender }}</td>
                                <td class="userUserType">{{ $post->usertype }}</td>
                                <td class="userMobNum">{{ $post->phone }}</td>
                                <td class="userAddress">{{ $post->address }}</td>
                                <td>
                                <a type="button"  data-toggle="modal" data-target="#myModals" onclick="editUser({{ $post->id }})">
                                    <i style="font-size: 12px; color: blue" class="bi bi-pencil-square"></i>
                                </a>
                                <a type="button" href="{{ route('userdelete', ['id' => $post->id]) }}">
                                    <i style="font-size: 12px; color:red" class="bi bi-person-x-fill"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <!-- Display the pagination links -->
            {{ $posts->links() }}
        </div>
    </div>
  
</div>

{{-- Create Modal --}}
<div class="modal" id="myModal" style="display: none">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Modal Title</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
                <form method="POST" action="users/add"  enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="id_name" style="color: black;">School ID:</label>
                        <input type="number" class="form-control" id="usernum" name="usernum">
                    </div>
                    <div class="form-group">
                        <label for="id_name" style="color: black;">Username:</label>
                        <input type="text" class="form-control" id="" name="username">
                    </div>
                    <label for="id_name" style="color: black;">Password:</label>
                    <div class="form-group input-group">
                        <input type="password" class="form-control" id="password" name="password">
                        <span class="input-group-text" id="togglePasswords" onclick="togglePasswords()">
                            <i class="bi bi-eye-slash-fill"></i>
                        </span>
                    </div>
                    <div class="d-flex flex-row">
                        <input type="number" class="form-control" id="age" name="age" style="display: none;">
                        <div class="form-group" style="width: 30%;">
                            <label for="id_name" style="color: black;">Birthdate:</label>
                            <input type="date" class="form-control" id="birthdate" oninput="calculateAge()" name="birthdate">
                        </div>
                        <div class="form-group" style="width: 70%; margin-left: 20px;">
                            <label for="id_name" style="color: black;">Mobile Number:</label>
                            <input type="tel" class="form-control" id="phone" name="phone">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="id_name" style="color: black;">Address:</label>
                        <input type="text" class="form-control" id="address" name="address">
                    </div>
                    <div class="d-flex flex-row " >
                        <div class="form-group" style="width: 50%;">
                            <label for="gender" style="width: 100%; color: black;">Gender:</label>
                            <select id="gender" name="gender" class="dropDown">
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                        </div>
                        <div class="form-group margin-left" style="width: 50%;">
                            <label for="usertype"  style="width: 100%; color: black;">User Type:</label>
                            <select id="usertype" name="usertype" class="dropDown">
                                <option value="Student">Student</option>
                                <option value="School Personnel">School Personnel</option>
                                <option value="Security Guard">Security Guard</option>
                            </select>
                        </div>
                    </div>
                    <button  type="submit" value="Submit"  class="btn btn-primary" style="width: 100%; margin-top: 25px;">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Update Modal --}}
<div class="modal" id="myModals" style="display: none">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Modal Titlesssssss</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal Body -->
            <div class="modal-body">
                <form method="POST" action=""  enctype="multipart/form-data">
                    @csrf
                    <input class="form-control" id="form-id" type="hidden" name="formId"/>
                    <div class="form-group">
                        <label for="id_name" style="color: black;">School ID: </label>
                        <input class="form-control" id="form-num" type="text" name="usernum"/>
                    </div>
                    <div class="form-group">
                        <label for="id_name" style="color: black;">Username:</label>
                        <input type="text" class="form-control" id="form-name">
                    </div>
                    <label for="id_name" style="color: black; margin-top: 15px;">Password:</label>
                    <div class="form-group input-group">
                        <input type="password" class="form-control" id="form-pass" >
                        <span class="input-group-text" id="togglePassword" onclick="togglePassword()">
                            <i class="bi bi-eye-slash-fill"></i>
                        </span>
                    </div>
                    <div class="d-flex flex-row">
                        <input type="number" class="form-control" id="form-age" name="age" style="display: none;">
                        <div class="form-group" style="width: 30%;">
                            <label for="id_name" style="color: black;">Birthdate:</label>
                            <input type="date" class="form-control" id="form-birthdate" oninput="calculateAges()" name="birthdate">
                        </div>
                        <div class="form-group" style="width: 70%; margin-left: 20px;">
                            <label for="id_name" style="color: black;">Mobile Number:</label>
                            <input type="tel" class="form-control" id="form-mobNum" name="phone">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="id_name" style="color: black;">Address:</label>
                        <input type="text" class="form-control" id="form-address" name="address">
                    </div>
                    <div class="d-flex flex-row " >
                        <div class="form-group" style="width: 50%;">
                            <label for="gender" style="width: 100%; color: black;">Gender:</label>
                            <select id="form-gender" name="female" class="dropDown">
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                        </div>
                        <div class="form-group margin-left" style="width: 50%;">
                            <label for="usertype"  style="width: 100%; color: black;">User Type:</label>
                            <select id="form-usertype" name="usertype" class="dropDown">
                                <option value="Student">Student</option>
                                <option value="School Personnel">School Personnel</option>
                                <option value="Security Guard">Security Guard</option>
                            </select>
                        </div>
                    </div>
                    <a onclick="save()" id="btnSave" class="btn btn-primary" style="width: 100%; margin-top: 35px;">Save</a>
                </form>
            </div>

        </div>
    </div>
</div>

<script>
    function togglePasswords() {
        const passwordField = document.getElementById("password");
        const toggleIcon = document.getElementById("togglePasswords");

        if (passwordField.type === "password") {
            passwordField.type = "text";
            toggleIcon.innerHTML = '<i class="bi bi-eye-fill"></i>';
        } else {
            passwordField.type = "password";
            toggleIcon.innerHTML = '<i class="bi bi-eye-slash-fill"></i>';
        }
    }

    function calculateAge() {
        var birthdateInput = document.getElementById("birthdate").value;

        if (birthdateInput) {
           var birthdate = new Date(birthdateInput);
           var currentDate = new Date();
           var age = currentDate.getFullYear() - birthdate.getFullYear();

           if (currentDate.getMonth() < birthdate.getMonth() ||
               (currentDate.getMonth() === birthdate.getMonth() && currentDate.getDate() < birthdate.getDate())) {
               age--;
           }
        }
        var resultElement = document.getElementById("age");
        resultElement.value= age;
    }
    
     // Update Django Ajax Call
    function editUser(id) {
        tr_id = "#user-" + id;
        num = $(tr_id).find(".userNum").text();
        name = $(tr_id).find(".userName").text();
        pass = $(tr_id).find(".userPass").text();
        mobNum = $(tr_id).find(".userMobNum").text();
        age = $(tr_id).find(".userAge").text();
        address = $(tr_id).find(".userAddress").text();
        gender = $(tr_id).find(".userGender").text();
        usertype = $(tr_id).find(".userUserType").text();
        birthdate = $(tr_id).find(".userBirthdate").text();

        $('#form-id').val(id);
        $('#form-num').val(num);
        $('#form-name').val(name);
        $('#form-pass').val(pass);
        $('#form-age').val(age);
        $('#form-mobNum').val(mobNum);
        $('#form-address').val(address);
        $('#form-gender').val(gender);
        $('#form-usertype').val(usertype);
        $('#form-birthdate').val(birthdate);
        
    }    
          


</script>

@endsection