
@extends('navigation')

@section('content')

<!-- css files -->
<link rel="stylesheet" href="{{ asset('css/viewPage.css') }}">

<div class="mainCon">
    <div class="upperCon d-flex flex-row">
        <div class="d-flex flex-column col-6">
            <p class="name">{{$userProfile->username}}</p>
            <p class="studentNum" style="margin-top: -20px;">
                @if($userProfile->usernum != 0)
                    {{ $userProfile->usernum }}
                @endif
            </p>
            <p class="value info" style="margin-top: -20px;">&nbsp;
                @if($hostProfile->schoolName == $schoolProfile->schoolName)
                    {{ $userProfile->usertype }}&nbsp;in&nbsp;{{ $schoolProfile->schoolName }}
                @elseif($schoolProfile->schoolName == " ")
                    Visitor
                @else
                    Visitor&nbsp;({{ $userProfile->usertype }}&nbsp;in&nbsp;{{ $schoolProfile->schoolName }})
                @endif
            </p>
        </div>
        <div class="vertical-line"></div>
        <div class="d-flex flex-column col-4">
            <div class="d-flex" style="margin-top: 30px;">
                <p class="value info">{{ $userProfile->age }} &nbsp;years old&nbsp;|</p>
                <p class="value info">&nbsp;{{ $userProfile->gender }}</p>
            </div>
            <div class="d-flex">
                <p class="title info">Mobile Number:</p>
                <p class="value info">&nbsp;0{{ $userProfile->phone }}</p>
            </div>
            <div class="d-flex">
                <p class="title info">Address:</p>
                <p class="value info">&nbsp;{{ $userProfile->address }}</p>
            </div>
        </div>
    </div>
    <div class="lowerCon d-flex">
        <div class="leftCon ">
            <p class="school" style="margin-top: 10px;">{{ $hostProfile->schoolName }}</p>
            <p class="value info2" style="margin-top: -20px;">{{ $hostProfile->address }}</p>
            <hr class="line">
            <div class="d-flex" style="margin-top: 20px;">
                <p class="title info2">Time:</p>
                <p class="value info2">&nbsp;{{ $logsProfile->time }}</p>
            </div>
            <div class="d-flex">
                <p class="title info2">Date:</p>
                <p class="value info2">&nbsp;{{ $logsProfile->date }}</p>
            </div>
            <div class="d-flex" style="margin-top: 20px;">
                <p class="title info2">Remarks:</p>
                <p class="value info2" style="font-weight: bold;">
                    &nbsp;
                    @if($logsProfile->remarks == 0.0)
                        Valid Pass
                    @elseif($logsProfile->remarks == 1.0)
                        Mask Required
                    @else
                        Invalid Pass
                    @endif
                </p>
            </div>
        </div>
        <div class="rightCon d-flex flex-column col-8" >
            <p class="school" style="margin-top: 10px; margin-left: 30px;" >Health Questionnaire</p>
            
            <div class="d-flex" style="margin-left: 30px;"  >
                <p class="title info2" >Temperature:</p>
                <p class="value info2">&nbsp;{{$logsProfile->temperature }}</p>
            </div>
            <hr class="line">
            <div class="d-flex">
                <table class="col-8">
                    <tbody>
                        <tr>
                            <td><input type="checkbox" name="select" value="7" {{ $logsProfile->q1 == "1" ? 'checked' : '' }} disabled></td>
                            <td>Has Covid-19 Symptoms in the past 14 days</td>
                        </tr>
                        <tr>
                            <td><input type="checkbox" name="select" value="4" {{ $logsProfile->q2 == "1" ? 'checked' : '' }} disabled></td>
                            <td>History of close contact with COVID-19 patient</td>
                        </tr>
                        <tr>
                            <td><input type="checkbox" name="select" value="5" {{ $logsProfile->q3 == "1" ? 'checked' : '' }} disabled></td>
                            <td>Travel History internationally or to any high-risk areas in the past 14 days</td>
                        </tr>
                        <tr>
                            <td><input type="checkbox" name="select" value="6" {{ $logsProfile->q4 == "1" ? 'checked' : '' }} disabled></td>
                            <td>Received  Covid-19 Vaccine</td>
                        </tr>
                        <tr>
                            <td><input type="checkbox" name="select" value="4" {{ $logsProfile->q5 == "1" ? 'checked' : '' }} disabled></td>
                            <td>Currently under quarantine or isolation </td>
                        </tr>
                    </tbody>
                </table>
                <table class="col-4">
                    <tbody>
                        <tr>
                            <td><input type="checkbox" name="select" value="5" {{ $logsProfile->q6 == "1" ? 'checked' : '' }} disabled></td>
                            <td> Cough</td>
                        </tr>
                        <tr>
                            <td><input type="checkbox" name="select" value="6" {{ $logsProfile->q7 == "1" ? 'checked' : '' }} disabled></td>
                            <td>Body Pain</td>
                        </tr>
                        <tr>
                            <td><input type="checkbox" name="select" value="8" {{ $logsProfile->q8 == "1" ? 'checked' : '' }} disabled></td>
                            <td> Difficulty in Breathing</td>
                        </tr>
                        <tr>
                            <td><input type="checkbox" name="select" value="7" {{ $logsProfile->q9 == "1" ? 'checked' : '' }} disabled></td>
                            <td>Sore Throat</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection