@extends('navigation')

@section('content')

<link rel="stylesheet" href="{{ asset('css/profile.css') }}">

<div class="maincon">
    <div class="upperCon flex-row d-flex">
        <div class="container1 d-flex col-9 flex-column">
            <div class="d-flex flex-row" style=" justify-content: center; margin-top: 20px;">
                <input class="title" id="schoolName"  readonly disabled 
                    value="{{$admins->schoolName}}" >
                <i class="bi bi-text-paragraph" id="btnEdit" style="color:white; margin-left: 30px; display: block;"
                    onclick="editProfile()"></i>
                <a class="btnSave" onclick="save()" id="btnSave">
                    Save</a>
            </div>
             <input class="desc" id="address" readonly disabled 
            value="{{$admins->address}}"> 
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
        <i class="bi bi-download icon-dl"  id="capture-button" style="color: white; font-size: 1.5rem;"></i>
        <div class="qr_con col-3" id="downloadableQR"  style="background-image: url('{{ asset('images/QR.png') }}')" >
                
                <h6 style="color: white; margin-top: 220px;">Welcome to</h6>
                 <h4 style="color: white;">{{ $admins->schoolName }}</h4> 
        </div>
    </div>
   <div class="lowerCon d-flex flex-column">
        <div class="MVCon d-flex flex-row" >
            <div class="mission col-6">
                <div class="d-flex flex-row" >
                    <p class="titleMV">Mission</p>
                    <i class="bi bi-text-paragraph" id="btnMEdit" style="color:rgb(2,30,108); margin-left: 30px; display: block;"
                    onclick="Mission()"></i>
                    <a class="btnSave" onclick="saveMission()" id="btnMSave" style="color: blue;"> Save</a>
                </div> 
                 <textarea class="descMV" id="mission" cols="65" rows="8" readonly> {{ $admins->mission }}</textarea>
            </div>
            <div class="vission col-4" >
                <div class="d-flex flex-row" >
                    <p class="titleMV">Vision</p>
                    <i class="bi bi-text-paragraph" id="btnVEdit" style="color:rgb(2,30,108); margin-left: 30px; display: block;"
                    onclick="Vission()"></i>
                    <a class="btnSave" onclick="saveVission()" id="btnVSave" style="color: blue;"> Save</a>
                </div> 
                <textarea  class="descMV" id="vission" cols="65" rows="8" readonly> {{ $admins->vision }}</textarea> 
            </div>
        </div>
        <div class="faq">
            <p class="titleFAQ">FAQ - Frequently Asked Question</p>
            <div class="addFAQ d-flex flex-column">
                <div class="tableCon  FAQcon">
                    <table class="tables ">
                        <thead>
                            <tr>
                                <th scope="col">Question</th>
                                <th scope="col">Answer</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($faq as $faq)
                            <tr  id="user-{{$faq->id}}">
                                <td class="question col-3">{{ $faq->question }}</td>
                                <td class="answer col-7">{{ $faq->answer }}</td>
                                <td class="userName col-1 ">
                                    <div class="d-flex flex-column">
                                      
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <form method="POST" action="dashboard/faq" class="FAQcon d-flex flex-column" style="margin-top:100px;" enctype="multipart/form-data">
                    @csrf
                    <div class="d-flex flex-row FAQcon">
                        <div class="form-group d-flex flex-column col-5">
                            <label for="question" style="color: rgb(255, 255, 255);">Question</label>
                            <textarea class="descQA form-control" cols="35" rows="3" id="questin" name="question"></textarea>
                        </div>
                        <div class="form-group d-flex flex-column col-5" style="margin-left: 20px;">
                            <label for="answer" style="color: rgb(255, 255, 255);">Answer</label>
                            <textarea class="descQA form-control" cols="35" rows="3" id="answer" name="answer"></textarea>
                        </div>
                    </div>
                    <button type="submit" class="addbtn">Add FAQ</button>
                </form>
            </div>
        </div>
        <div class="abouts">
            <div class="about col-10">
                <div class="d-flex flex-row" >
                    <p class="titleMV">About</p>
                    <i class="bi bi-text-paragraph" id="btnAEdit" style="color:rgb(2,30,108); margin-left: 30px; display: block;"
                    onclick="About()"></i>
                    <a class="btnSave" onclick="saveAbout()" id="btnASave" style="color: blue;"> Save</a>
                </div> 
                <textarea class="descMV" style="margin-bottom: 50px;" id="about" cols="100" rows="15" readonly> {{ $admins->about }}</textarea>
            </div>
        </div>
   </div>
</div>



<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.3.2/html2canvas.min.js"></script>

<script>
    
    function saveFAQ(){
           
           var btn = document.getElementById("btnSaved");
           var userid = document.getElementById("form-id").value;
           var question= document.getElementById("form-question").value;
           var answer = document.getElementById("form-answer").value;
                 
           var urlss =
           "{% url 'updateFAQ'  'id' 'question' 'answer'  %}".replace('id', userid).replace('question', question).replace('answer', answer);
           btn.href = urlss;
           
      }
   
    // Update Django Ajax Call
    function editUser(id) {
        if (id) {
            tr_id = "#user-" + id;
            question = $(tr_id).find(".question").text();
            answer = $(tr_id).find(".answer").text();
            $('#form-id').val(id);
            $('#form-question').val(question);
            $('#form-answer').val(answer);
            }
        else{
            alert("di nagana");
            }
        }    
    
    document.addEventListener('DOMContentLoaded', function () {
    const divContent = document.getElementById('downloadableQR');
    const captureButton = document.getElementById('capture-button');

    // Function to capture and convert the div to PNG
    function captureDivAsPNG() {
        html2canvas(divContent).then(function (canvas) {
            // Create a new image element with the captured content
            const img = new Image();
            img.src = canvas.toDataURL('image/png');

            // Open the image in a new window or save it as needed
            const newWindow = window.open();
            newWindow.document.body.appendChild(img);
        });
    }

    // Attach a click event to the capture button
    captureButton.addEventListener('click', captureDivAsPNG);
    });

    function saveVission(){
        var btn = document.getElementById("btnVSave");
        var vision = document.getElementById("vission").value;
        var urls ='{{ route('update.vision',['vision'=> "vision"] )}}';

        urls = urls.replace('vision', vision);

        btn.href = urls;
    }
    function saveMission(){
        var btn = document.getElementById("btnMSave");
        var mission = document.getElementById("mission").value;
        var urls ='{{ route('update.mission',['mission'=> "mission"] )}}';

        urls = urls.replace('mission', mission);

        btn.href = urls;
    }
    function saveAbout(){
        var btn = document.getElementById("btnASave");
        var about = document.getElementById("about").value;
        var urls ='{{ route('update.about',['about'=> "about"] )}}';

        urls = urls.replace('about', about);

        btn.href = urls;
    }
    function save(){
        var btn = document.getElementById("btnSave");
        var name = document.getElementById("schoolName").value;
        var address = document.getElementById("address").value;
        var urls ='{{ route('update.profile',['schoolName'=> "schoolName", 'address'=> "address",] )}}';

        urls = urls.replace('schoolName', name);
        urls = urls.replace('address', address);

        btn.href = urls;
    }

    var mission =  document.getElementById("mission");
    var msave = document.getElementById("btnMSave");
    var medit = document.getElementById("btnMEdit");
    var vission =  document.getElementById("vission");
    var vsave = document.getElementById("btnVSave");
    var vedit = document.getElementById("btnVEdit");
    var about =  document.getElementById("about");
    var asave = document.getElementById("btnASave");
    var aedit = document.getElementById("btnAEdit");

    function Mission(){

        editMV(mission, msave, medit)
    }
    function Vission(){

        editMV(vission, vsave, vedit)
    }

    function About(){

    editMV(about, asave, aedit)
    }


    function editMV(text, btnsave, btnedit){
        text.removeAttribute("disabled");
        text.removeAttribute("readonly");

        text.classList.add("line");

        btnsave.style.display="block";
        btnedit.style.display="none";
    }

    function editProfile(){
        var schoolName =  document.getElementById("schoolName");
        var address = document.getElementById("address");
        var save = document.getElementById("btnSave");
        var edit = document.getElementById("btnEdit");

        schoolName.removeAttribute("disabled");
        schoolName.removeAttribute("readonly");
        address.removeAttribute("disabled");
        address.removeAttribute("readonly");

        schoolName.classList.add("line");
        address.classList.add("line");

        save.style.display="block";
        edit.style.display="none";
    }
</script>
@endsection