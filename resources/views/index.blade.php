<!DOCTYPE html>

<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="">
    </head>
    <body>
        
        <!-- css files -->
        <link rel="stylesheet" href="{{ asset('css/login.css') }}">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
        <!-- Option 1: Include in HTML -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">

        <div class="mainCon">
            <div class="centerCon d-flex flex-row">
                <div class="rightCon col-6">
                    <img class="logo" src="{{ asset('images/log.png') }}">
                </div>
                <div class="leftCon col-6">
                    <p class="school" >Login</p>
                    <div class="infoCon">
                        <form method="POST" action="/login">
                            @csrf <!-- Add CSRF token for security -->
                            <div class="form-groups">
                                <label for="id_name" style="color: black;">Username </label>
                                <input class="form-control" id="username" type="text" name="user" required>
                            </div>
                            <div class="form-groups">    
                                <label for="id_name" style="color: black; margin-top: 20px;">Password</label>
                                <div class="form-group input-group">
                                    <input type="password" class="form-control" id="password" name="password" required>
                                    <span class="input-group-text" id="pass" onclick="togglePassword()">
                                        <i class="bi bi-eye-slash-fill" style="width: 20px;"></i>
                                    </span>
                                </div>
                            </div>
                            <button type="submit" id="btnSave" class=" primaryBtn" style="width: 100%; margin-top: 35px;">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>

    <script>
         function save(){
            var btn = document.getElementById("btnSave");
            var name = document.getElementById("username").value;
            var address = document.getElementById("password").value;
                var url =
                "{% url 'log'  'name' 'address' %}".replace('name', name). replace('address',address);
            btn.href = url;
        }
        function togglePassword() {
            const passwordField = document.getElementById("password");
            const toggleIcon = document.getElementById("pass");
            if (passwordField.type === "password") {
                passwordField.type = "text";
                
                toggleIcon.innerHTML = '<i class="bi bi-eye-fill"></i>';
            } else {
                passwordField.type = "password";
                toggleIcon.innerHTML = '<i class="bi bi-eye-slash-fill"></i>';
            }
        }
    </script>
</html>