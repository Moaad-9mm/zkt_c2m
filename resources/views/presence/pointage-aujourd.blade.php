@extends('layouts.presence')
@section('presencesub','active')
@section('pointage-aujourd','active')
@section('sub-content')
<style>
    .my-table{
        color: #fff ;
    }
    .table .thead-my th {
        color: #fff;
        background-color: #067b84;
        border-color: #067b84;
    }
    .table .thead-my th.active{
        color: #fff;
        background-color: #067b849e;
        border-color: #067b849e;
    }
    .my-td{
        color: #fff;
    }
    .my-td h5{
        color: #fff;
        font-size: 15px;
    }
    .my-td p{
        font-size: 11px;
        margin: 0;
    }
    .my-td.present{
        background-color: #1cbb8c;
    }
    .my-td.absent{
        background-color: #dc3545;
    }.my-td.week{
        background-color: #fcb92c;
    }.my-td.normale{
        background-color: #99bec1;
    }
    #result{
        display: none ;
    }
    .progress {
	background-color: #f5dfdf;
    border-radius: 0px;
    position: relative;
    margin: 0;
    height: 25px;
    width: 528px;
}

.progress-done {
    background: linear-gradient(to left, #068484, #1f995b);
    box-shadow: 0 3px 3px -5px #70f27a, 0 2px 5px #70f286;
    border-radius: 0;
    color: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100%;
    width: 0;
    opacity: 0;
    transition: 1s ease 0.3s;
}
.progress-done-break {
    background: #f5dfdf;
    box-shadow: 0 3px 3px -5px #70f27a, 0 2px 5px #70f286;
    border-radius: 0;
    color: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100%;
    width: 0;
    opacity: 0;
    transition: 1s ease 0.3s;
}



  </style>
<div class="container-fluid p-0">
    <div class="row big-title">
        <div class="col-6">
            <h1 class="h3 mb-3"><strong>Pointage d'aujourd'hui</strong></h1>
        </div>
        
    </div>
    
    <div class="row" >
        <div class="col-12 col-md-12 col-xxl-12 d-flex order-1 order-xxl-1">
            <div class="col-12 col-lg-12 col-xxl-12 d-flex">
                <div class="card flex-fill w-100">
                    <div class="card-body d-flex w-100">
                        <div class="row col-12">
                            <div class="col-10 row">
                                
                                <div class="col-6">
                                    <select class="form-select" id="position_id">
                                        <option value="0">Position...</option>
                                        @foreach ($positions as $position)
                                        <option value="{{$position->id}}" >{{$position->position_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-6">
                                    <select class="form-select" id="departement_id">
                                        <option value="0">Departement...</option>
                                        @foreach ($departements as $departement)
                                        <option value="{{$departement->id}}" >{{$departement->dept_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                {{-- <div class="col-4">
                                    <input type="date" id="date_debut" class="form-control" value="<?php echo date('Y-m-d'); ?>">
                                </div> --}}
                            </div>
                            <div class="col-2 row">
                                <div class="col-8">
                                    <a class="btn btn-primary" onclick="showEmployee()" ><i class="fa-solid fa-magnifying-glass"></i>
                                    </a>
                                </div>
                               
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row" id="result">
        <div class="col-xl-12 col-xxl-12 d-flex">
            <div class="card flex-fill w-100">
                <div class="card-body d-flex">
                    <div class="align-self-center w-100">
                            <table class="table table-bordered text-center my-table" id="aujourd-table">
                                <thead class="thead-my">
                                <tr>
                                    <th scope="col" >Employees</th>
                                    <th scope="col" id="date1">......</th>
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                            <div class="row">
                                <div class="col-6 px-5 row" style="width: 75%!important;">
                                    <div class="col-4 row ">
                                        <div class="col-4" style="background: linear-gradient(to left, #068484, #1f995b) ; color: #1a9464">.</div>
                                        <div class="col-8" style="font-weight: 600;
                                        font-size: 14px;">Present</div>
                                    </div>
                                    <div class="col-4 row">
                                        <div class="col-4" style="background-color: #f5dfdf; color:#f5dfdf">.</div>
                                        <div class="col-8" style="font-weight: 600;
                                        font-size: 14px;">Absent</div>
                                    </div>
                                    {{-- <div class="col-4 row">
                                        <div class="col-4" style="background-color: #dc3545; color:#dc3545">.</div>
                                        <div class="col-8" style="font-weight: 600;
                                        font-size: 14px;">Absent</div>
                                    </div> --}}
                                </div>
                                <div class="col-6"></div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
   
    function showEmployee() {
           position_id =  $('#position_id').val() ;
           departement_id =  $('#departement_id').val() ;
            $.ajax({
                        url: "{{route('search-pointage-aujour')}}",
                        type: 'POST',
                        dataType: 'json', 
                        data : {
                                _token: "{{csrf_token()}}",
                                position_id : position_id ,
                                departement_id : departement_id ,
                            } ,
                        success: function(data) {
                            $('#aujourd-table tbody').empty();
                            $.each(data.employeePresent , function(index , value){
                                // console.log(value) ;
                                clock_in = value.pointage_aujourd[0].clock_in ;
                                clock_out = value.pointage_aujourd[0].clock_out ;
                                id = value.id ;
                                emp_code = value.emp_code ;
                                emp_name = value.first_name+" "+value.last_name;
                                if (value.pointage_aujourd[0].break_out) {
                                    if (value.pointage_aujourd[0].break_in) {
                                        date_cin = new Date(clock_in) ;
                                        date_bout = new Date(value.pointage_aujourd[0].break_out) ;
                                        date_bin = new Date(value.pointage_aujourd[0].break_in) ;
                                        date_cout = new Date(clock_out) ;
                                        duree_cin = ((date_bout.getTime() - date_cin.getTime()) / 1000)/3600 ;
                                        duree_b = ((date_bin.getTime() - date_bout.getTime()) / 1000)/3600;
                                        duree_cout = ((date_cout.getTime() - date_bin.getTime()) / 1000)/3600;

                                        progress = `<div class="progress-done" id="progress-done_${id}_cin" data-done="${(duree_cin*100)/24}">
                                                    </div>
                                                    <div class="progress-done-break" id="progress-done_${id}_b" data-done="${(duree_b*100)/24}">
                                                    </div>
                                                    <div class="progress-done" id="progress-done_${id}_cout" data-done="${(duree_cout*100)/24}">
                                                    </div>` ;
                                        duree = duree_cin + duree_cout ;
                                        in_out = `<h5 class="text-center" style="color :#212529 "><i class="fa-solid fa-door-open" style="color : #1d985c"></i> ${clock_in.substr(11,5)} - ${value.pointage_aujourd[0].break_out.substr(11,5)}  ||  ${value.pointage_aujourd[0].break_in.substr(11,5)} - ${clock_out.substr(11,5)} <i class="fa-solid fa-door-closed" style="color : #981d1d"></i></h5>` ;
                                        var p = 3 ;
                                    } else {
                                        date_cin = new Date(clock_in) ;
                                        date_bout = new Date(value.pointage_aujourd[0].break_out) ;
                                        duree = ((date_bout.getTime() - date_cin.getTime()) / 1000)/3600 ;
                                        progress = `<div class="progress-done" id="progress-done_${id}" data-done="${(duree*100)/24}">
                                                </div>` ;
                                                in_out = `<h5 class="text-center" style="color :#212529 "><i class="fa-solid fa-door-open" style="color : #1d985c"></i> ${clock_in.substr(11,5)} - ${value.pointage_aujourd[0].break_out.substr(11,5)}  ||  ... - ... <i class="fa-solid fa-door-closed" style="color : #981d1d"></i></h5>` ;
                                        var p = 1 ;
                                    }
                                    
                                } else {
                                    date_cin = new Date(value.pointage_aujourd[0].clock_in) ;
                                    date_cout = ((value.pointage_aujourd[0].clock_out) ? new Date(value.pointage_aujourd[0].clock_out) : new Date("2022-01-18 23:00:00"));
                                    duree = ((date_cout.getTime() - date_cin.getTime()) / 1000)/3600 ;
                                    progress = `<div class="progress-done" id="progress-done_${id}" data-done="${(duree*100)/24}">
                                                </div>` ;
                                    in_out = ((value.pointage_aujourd[0].clock_out) ? `<h5 class="text-center" style="color :#212529 "><i class="fa-solid fa-door-open" style="color : #1d985c"></i> ${clock_in.substr(11,5)} - ${clock_out.substr(11,5)} <i class="fa-solid fa-door-closed" style="color : #981d1d"></i></h5>` : `<h5 class="text-center" style="color :#212529 "><i class="fa-solid fa-door-open" style="color : #1d985c"></i> ${clock_in.substr(11,5)} - ... <i class="fa-solid fa-door-closed" style="color : #981d1d"></i></h5>`);
                                        var p = 1 ;
                                }
                                // in_out = `<h5 class="text-center" style="color :#212529 "><i class="fa-solid fa-door-open" style="color : #1d985c"></i> ${clock_in.substr(11,5)} - ${clock_out.substr(11,5)} <i class="fa-solid fa-door-closed" style="color : #981d1d"></i></h5>`;

                                

                                $('#aujourd-table > tbody:last-child').append( `<tr>
                                    <th class="align-middle" scope="row" style="color: #212529" >#${emp_code} <br> ${emp_name}</th>
                                    <td class="my-td " >
                                        <div class="col-8 offset-2 py-0 ">
                                            ${in_out} 
                                            <div class="progress">
                                                ${progress}
                                            </div>
                                            <h5 class="text-center" style="color :#212529; margin-top : 5px">
                                                <i class="fa-solid fa-clock" style="color: #067b84;"></i> ${duree.toFixed(2)} Heures
                                            </h5>
                                            
                                          </div>
                                    </td>
                                </tr>` );
                                if (p == 3 ) {
                                     // progress(`#progress-done_${id}_cin`) ;
                                        progress1 = document.querySelector(`#progress-done_${id}_cin`);
                                        progress1.style.width = progress1.getAttribute('data-done') + '%';
                                        progress1.style.opacity = 1;

                                    // progress(`#progress-done_${id}_b`) ;
                                        progress2 = document.querySelector(`#progress-done_${id}_b`);
                                        progress2.style.width = progress2.getAttribute('data-done') + '%';
                                        progress2.style.opacity = 1;
                                    // progress(`#progress-done_${id}_cout`) ;
                                        progress3 = document.querySelector(`#progress-done_${id}_cout`);
                                        progress3.style.width = progress3.getAttribute('data-done') + '%';
                                        progress3.style.opacity = 1;
                                } else {
                                     // progress(`#progress-done_${id}`) ;
                                        progresss = document.getElementById(`progress-done_${id}`);
                                        progresss.style.width = progresss.getAttribute('data-done') + '%';
                                        progresss.style.opacity = 1;
                                }
                            }) ;
                            $.each(data.employeeAbsent , function(index , value){
                                id = value.id ;
                                emp_code = value.emp_code ;
                                emp_name = value.first_name+" "+value.last_name;
                                in_out = `<h5 class="text-center" style="color :#212529 "><i class="fa-solid fa-user-xmark" style="color : #981d1d"></i> </h5>` ;
                                progress = `<div class="progress-done" id="progress-done_${id}" data-done="0">
                                                </div>` ;
                                $('#aujourd-table > tbody:last-child').append( `<tr>
                                    <th class="align-middle" scope="row" style="color: #212529" >#${emp_code} <br> ${emp_name}</th>
                                    <td class="my-td " >
                                        <div class="col-8 offset-2 py-0 ">
                                            ${in_out} 
                                            <div class="progress">
                                                ${progress}
                                            </div>
                                            <h5 class="text-center" style="color :#212529; margin-top : 5px">
                                                <i class="fa-solid fa-clock" style="color: #067b84;"></i> 0 Heures
                                            </h5>
                                            
                                          </div>
                                    </td>
                                </tr>` );
                                progresss = document.getElementById(`progress-done_${id}`);
                                progresss.style.width = progresss.getAttribute('data-done') + '%';
                                progresss.style.opacity = 1;
                            }) ;
                            if(data.employeePresent.length === 0  && data.employeeAbsent.length === 0) {
                                $('#aujourd-table > tbody:last-child').append( `<tr>
                                                                            <td style="color : black" colspan="2">
                                                                                <strong><i class="rotateme fas fa-frown" style="font-size:25px;color:#067b84"></i> Aucun Employee Trouver !!! </strong>
                                                                            </td>
                                                                        </tr>` );
                            }
                        }
                    });
                    
                    var x = document.getElementById("result");
                    x.style.display = "block"; 
        }
    

</script>

@endsection
