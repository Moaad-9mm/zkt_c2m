@extends('layouts.presence')
@section('presencesub','active')
@section('presence-semaine','active')
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
   
  </style>
<div class="container-fluid p-0">
    <div class="row big-title">
        <div class="col-6">
            <h1 class="h3 mb-3"><strong>Presence de la semaine</strong></h1>
        </div>
        
    </div>
    
    <div class="row" >
        <div class="col-12 col-md-12 col-xxl-12 d-flex order-1 order-xxl-1">
            <div class="col-12 col-lg-12 col-xxl-12 d-flex">
                <div class="card flex-fill w-100">
                    <div class="card-body d-flex w-100">
                        <div class="row col-12">
                            <div class="col-10 row">
                                {{-- <div class="col-3">
                                    <select class="form-select" id="area_id">
                                        <option value="0">Zone...</option>
                                        @foreach ($zones as $zone)
                                        <option value="{{$zone->id}}" >{{$zone->area_name}}</option>
                                        @endforeach
                                    </select>
                                </div> --}}
                                <div class="col-4">
                                    <select class="form-select" id="position_id">
                                        <option value="0">Position...</option>
                                        @foreach ($positions as $position)
                                        <option value="{{$position->id}}" >{{$position->position_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-4">
                                    <select class="form-select" id="departement_id">
                                        <option value="0">Departement...</option>
                                        @foreach ($departements as $departement)
                                        <option value="{{$departement->id}}" >{{$departement->dept_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-4">
                                    <input type="date" id="date_debut" class="form-control" value="<?php echo date('Y-m-d'); ?>">
                                </div>
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
                            <table class="table table-bordered text-center my-table" id="semaine-table">
                                <thead class="thead-my">
                                <tr>
                                    <th scope="col" >Employees</th>
                                    <th scope="col" id="date1"></th>
                                    <th scope="col" id="date2" ></th>
                                    <th scope="col" id="date3"></th>
                                    <th scope="col" id="date4"></th>
                                    <th scope="col" id="date5"></th>
                                    <th scope="col" id="date6"></th>
                                    <th scope="col" id="date7"></th>
                                </tr>
                                </thead>
                                <tbody>
                                {{-- <tr>
                                    <th class="align-middle" scope="row" style="color: #212529" >Employe 1</th>
                                    <td class="my-td present" >
                                    <h5 >08:00 - 17:00</h5>
                                    <p > 8 Heures </p>
                                    </td>
                                    <td class="my-td absent" >
                                        <h5 >A</h5>
                                        <p > 0 Heures </p>
                                    </td>
                                    <td class="my-td present" >
                                        <h5 >08:00 - 17:00</h5>
                                        <p > 8 Heures </p>
                                    </td>
                                    <td class="my-td present" >
                                        <h5 >08:00 - 17:00</h5>
                                        <p > 8 Heures </p>
                                    </td>
                                    <td class="my-td normale" >
                                        <h5 >-</h5>
                                        <p > 0 Heures </p>
                                    </td>
                                    <td class="my-td week" >
                                        <h5 >W</h5>
                                        <p > 0 Heures </p>
                                    </td>
                                    <td class="my-td week" >
                                        <h5 >W</h5>
                                        <p > 0 Heures </p>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="align-middle" scope="row" style="color: #212529" >Employe 2</th>
                                    <td class="my-td present" >
                                    <h5 >08:00 - 17:00</h5>
                                    <p > 8 Heures </p>
                                    </td>
                                    <td class="my-td present" >
                                        <h5 >08:00 - 17:00</h5>
                                        <p > 8 Heures </p>
                                    </td>
                                    <td class="my-td present" >
                                        <h5 >08:00 - 17:00</h5>
                                        <p > 8 Heures </p>
                                    </td>
                                    <td class="my-td present" >
                                        <h5 >08:00 - 17:00</h5>
                                        <p > 8 Heures </p>
                                    </td>
                                    <td class="my-td normale" >
                                        <h5 >-</h5>
                                        <p > 0 Heures </p>
                                    </td>
                                    <td class="my-td week" >
                                        <h5 >W</h5>
                                        <p > 0 Heures </p>
                                    </td>
                                    <td class="my-td week" >
                                        <h5 >W</h5>
                                        <p > 0 Heures </p>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="align-middle" scope="row" style="color: #212529">Employe 3</th>
                                    <td class="my-td present" >
                                    <h5 >08:00 - 17:00</h5>
                                    <p > 8 Heures </p>
                                    </td>
                                    <td class="my-td absent" >
                                        <h5 >A</h5>
                                        <p > 0 Heures </p>
                                    </td>
                                    <td class="my-td present" >
                                        <h5 >08:00 - 17:00</h5>
                                        <p > 8 Heures </p>
                                    </td>
                                    <td class="my-td absent" >
                                        <h5 >A</h5>
                                        <p > 0 Heures </p>
                                    </td>
                                    <td class="my-td normale" >
                                        <h5 >-</h5>
                                        <p > 0 Heures </p>
                                    </td>
                                    <td class="my-td week" >
                                        <h5 >W</h5>
                                        <p > 0 Heures </p>
                                    </td>
                                    <td class="my-td week" >
                                        <h5 >W</h5>
                                        <p > 0 Heures </p>
                                    </td>
                                </tr> --}}
                                </tbody>
                            </table>
                            <div class="row">
                                <div class="col-6 px-5 row" style="width: 75%!important;">
                                    <div class="col-4 row ">
                                        <div class="col-4" style="background-color: #1cbb8c; color:#1cbb8c">.</div>
                                        <div class="col-8" style="font-weight: 600;
                                        font-size: 14px;">Present</div>
                                    </div>
                                    <div class="col-4 row">
                                        <div class="col-4" style="background-color: #fcb92c; color:#fcb92c">.</div>
                                        <div class="col-8" style="font-weight: 600;
                                        font-size: 14px;">Weekend</div>
                                    </div>
                                    <div class="col-4 row">
                                        <div class="col-4" style="background-color: #dc3545; color:#dc3545">.</div>
                                        <div class="col-8" style="font-weight: 600;
                                        font-size: 14px;">Absent</div>
                                    </div>
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
        if ($('#date_debut').val() == '') {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: `Quelque chose s'est mal passé !` ,
            }) 
        } 
        else{
           date_debut =  $('#date_debut').val() ;
           position_id =  $('#position_id').val() ;
           departement_id =  $('#departement_id').val() ;
            $.ajax({
                        url: "{{route('search-paring')}}",
                        type: 'POST',
                        dataType: 'json', 
                        data : {
                                _token: "{{csrf_token()}}",
                                date_debut : date_debut ,
                                position_id : position_id ,
                                departement_id : departement_id ,
                            } ,
                        success: function(data) {
                            // $('#semaine-table').detach();
                            $('#semaine-table tbody').empty();
                            var today = new Date();
                            var ndate1 = new Date(data.date_debut) ;
                            var ndate2 = new Date(data.date1) ;
                            var ndate3 = new Date(data.date2) ;
                            var ndate4 = new Date(data.date3) ;
                            var ndate5 = new Date(data.date4) ;
                            var ndate6 = new Date(data.date5) ;
                            var ndate7 = new Date(data.date_fin) ;
                            $('#date1').html(data.date_debut) ;
                            $('#date2').html(data.date1) ;
                            $('#date3').html(data.date2) ;
                            $('#date4').html(data.date3) ;
                            $('#date5').html(data.date4) ;
                            $('#date6').html(data.date5) ;
                            $('#date7').html(data.date_fin) ;
                            
                            $.each( data.employeePresent, function( index, value ) {
                                var id = value.id ;
                                var emp_code = value.emp_code ;
                                // la date 1 
                                if (ndate1 > today) {
                                    date1_content = `<h5>N</h5>
                                                     <p>0 Heures </p>` ;
                                    date1_class = 'normale' ;
                                } else {
                                    if (ndate1.getDay() === 0 || ndate1.getDay() === 6   ) {
                                        date1_content = `<h5>W</h5>
                                                        <p>0 Heures </p>` ;
                                        date1_class = 'week' ;
                                    } else {
                                        if (value.loadparing.length === 0 || !value.loadparing[0]) {
                                            date1_content = `<h5>A</h5>
                                                             <p>0 Heures </p>` ;
                                            date1_class = 'absent' ;
                                        } else {
                                            date1_content = `<h5>${value.loadparing[0].in_time.substr(0,5)} - ${value.loadparing[0].out_time.substr(0,5)}</h5>
                                                            <p> ${(value.loadparing[0].duration / 3600).toFixed(2)} Heures </p> ` ;
                                            date1_class = 'present' ;
                                        }
                                    }
                                }
                                
                                 // la date 2 
                                 if (ndate2 > today) {
                                    date2_content = `<h5>N</h5>
                                                     <p>0 Heures </p>` ;
                                    date2_class = 'normale' ;
                                } else {
                                    if (ndate2.getDay() === 0 || ndate2.getDay() === 6   ) {
                                        date2_content = `<h5>W</h5>
                                                        <p>0 Heures </p>` ;
                                        date2_class = 'week' ;
                                    } else {
                                        if (value.loadparing.length === 0 || !value.loadparing[1]) {
                                            date2_content = `<h5>A</h5>
                                                             <p>0 Heures </p>` ;
                                            date2_class = 'absent' ;
                                        } else {
                                            date2_content = `<h5>${value.loadparing[1].in_time.substr(0,5)} - ${value.loadparing[1].out_time.substr(0,5)}</h5>
                                                            <p> ${(value.loadparing[1].duration / 3600).toFixed(2)} Heures </p> ` ;
                                            date2_class = 'present' ;
                                        }
                                    }
                                }
                                
                                 // la date 3 
                                 if (ndate3 > today) {
                                    date3_content = `<h5>N</h5>
                                                     <p>0 Heures </p>` ;
                                    date3_class = 'normale' ;
                                } else {
                                    if (ndate3.getDay() === 0 || ndate3.getDay() === 6   ) {
                                        date3_content = `<h5>W</h5>
                                                        <p>0 Heures </p>` ;
                                        date3_class = 'week' ;
                                    } else {
                                        if (value.loadparing.length === 0 || !value.loadparing[2]) {
                                            date3_content = `<h5>A</h5>
                                                             <p>0 Heures </p>` ;
                                            date3_class = 'absent' ;
                                        } else {
                                            date3_content = `<h5>${value.loadparing[2].in_time.substr(0,5)} - ${value.loadparing[2].out_time.substr(0,5)}</h5>
                                                            <p> ${(value.loadparing[2].duration / 3600).toFixed(2)} Heures </p> ` ;
                                            date3_class = 'present' ;
                                        }
                                    }
                                }
                               
                                 // la date 4 
                                 if (ndate4 > today) {
                                    date4_content = `<h5>N</h5>
                                                     <p>0 Heures </p>` ;
                                    date4_class = 'normale' ;
                                } else {
                                    if (ndate4.getDay() === 0 || ndate4.getDay() === 6   ) {
                                        date4_content = `<h5>W</h5>
                                                        <p>0 Heures </p>` ;
                                        date4_class = 'week' ;
                                    } else {
                                        if (value.loadparing.length === 0 || !value.loadparing[3]) {
                                            date4_content = `<h5>A</h5>
                                                             <p>0 Heures </p>` ;
                                            date4_class = 'absent' ;
                                        } else {
                                            date4_content = `<h5>${value.loadparing[3].in_time.substr(0,5)} - ${value.loadparing[3].out_time.substr(0,5)}</h5>
                                                            <p> ${(value.loadparing[3].duration / 3600).toFixed(2)} Heures </p> ` ;
                                            date4_class = 'present' ;
                                        }
                                    }
                                }
                                
                                 // la date 5 
                                 if (ndate5 > today) {
                                    date5_content = `<h5>N</h5>
                                                     <p>0 Heures </p>` ;
                                    date5_class = 'normale' ;
                                } else {
                                    if (ndate5.getDay() === 0 || ndate5.getDay() === 6   ) {
                                        date5_content = `<h5>W</h5>
                                                        <p>0 Heures </p>` ;
                                        date5_class = 'week' ;
                                    } else {
                                        if (value.loadparing.length === 0 || !value.loadparing[4]) {
                                            date5_content = `<h5>A</h5>
                                                             <p>0 Heures </p>` ;
                                            date5_class = 'absent' ;
                                        } else {
                                            date5_content = `<h5>${value.loadparing[4].in_time.substr(0,5)} - ${value.loadparing[4].out_time.substr(0,5)}</h5>
                                                            <p> ${(value.loadparing[4].duration / 3600).toFixed(2)} Heures </p> ` ;
                                            date5_class = 'present' ;
                                        }
                                    }
                                }
                                
                                 // la date 6 
                                 if (ndate6 > today) {
                                    date6_content = `<h5>N</h5>
                                                     <p>0 Heures </p>` ;
                                    date6_class = 'normale' ;
                                } else {5
                                    if (ndate6.getDay() === 0 || ndate6.getDay() === 6   ) {
                                        date6_content = `<h5>W</h5>
                                                        <p>0 Heures </p>` ;
                                        date6_class = 'week' ;
                                    } else {
                                        if (value.loadparing.length === 0 || !value.loadparing[5]) {
                                            date6_content = `<h5>A</h5>
                                                             <p>0 Heures </p>` ;
                                            date6_class = 'absent' ;
                                        } else {
                                            date6_content = `<h5>${value.loadparing[5].in_time.substr(0,5)} - ${value.loadparing[5].out_time.substr(0,5)}</h5>
                                                            <p> ${(value.loadparing[5].duration / 3600).toFixed(2)} Heures </p> ` ;
                                            date6_class = 'present' ;
                                        }
                                    }
                                }
                                
                                 // la date 7 
                                 if (ndate7 > today) {
                                    date7_content = `<h5>N</h5>
                                                     <p>0 Heures </p>` ;
                                    date7_class = 'normale' ;
                                } else {
                                    if (ndate7.getDay() === 0 || ndate7.getDay() === 6   ) {
                                        date7_content = `<h5>W</h5>
                                                        <p>0 Heures </p>` ;
                                        date7_class = 'week' ;
                                    } else {
                                        if (value.loadparing.length === 0 || !value.loadparing[6]) {
                                            date7_content = `<h5>A</h5>
                                                             <p>0 Heures </p>` ;
                                            date7_class = 'absent' ;
                                        } else {
                                            date7_content = `<h5>${value.loadparing[6].in_time.substr(0,5)} - ${value.loadparing[6].out_time.substr(0,5)}</h5>
                                                            <p> ${(value.loadparing[6].duration / 3600).toFixed(2)} Heures </p> ` ;
                                            date7_class = 'present' ;
                                        }
                                    }
                                }
                                
                                $('#semaine-table > tbody:last-child').append( `<tr id="employee_${id}">
                                    <th id="employee_${id}_code" class="align-middle" scope="row" style="color: #212529" >${emp_code}</th>
                                    <td class="my-td ${date1_class}" id="employee_${id}_date1" >
                                       ${date1_content}
                                    </td>
                                    <td class="my-td ${date2_class}"  id="employee_${id}_date2">
                                        ${date2_content}
                                    </td>
                                    <td class="my-td ${date3_class}" id="employee_${id}_date3">
                                        ${date3_content}
                                    </td>
                                    <td class="my-td ${date4_class}" id="employee_${id}_date4">
                                        ${date4_content}
                                    </td>
                                    <td class="my-td ${date5_class}" id="employee_${id}_date5">
                                        ${date5_content}
                                    </td>
                                    <td class="my-td ${date6_class}" id="employee_${id}_date6">
                                        ${date6_content}
                                    </td>
                                    <td class="my-td ${date7_class}" id="employee_${id}_date7" >
                                        ${date7_content}
                                    </td>
                                </tr>` );
                                // console.log(value.loadparing.length)
                                // if (value.loadparing.length === 0) {
                                    console.log(value) ;
                                // }else{
                                //     console.log("gg") ;
                                // }
                                
                            });
                            // console.log(data.employeePresent) ;
                            $.each( data.employeeAbsent, function( index, value ) {
                                var id = value.id ;
                                var emp_code = value.emp_code ;
                                // la date1 
                                if (ndate1 > today) {
                                    date1_content = `<h5>N</h5>
                                                     <p>0 Heures </p>` ;
                                    date1_class = 'normale' ;
                                } else { 
                                    if (ndate1.getDay() === 0 || ndate1.getDay() === 6   ) {
                                        date1_content = `<h5>W</h5>
                                                        <p>0 Heures </p>` ;
                                        date1_class = 'week' ;
                                    } else {
                                        date1_content = `<h5>A</h5>
                                                             <p>0 Heures </p>` ;
                                            date1_class = 'absent' ;
                                    }
                                }

                                // la date2 
                                if (ndate2 > today) {
                                    date2_content = `<h5>N</h5>
                                                     <p>0 Heures </p>` ;
                                    date2_class = 'normale' ;
                                } else { 
                                    if (ndate2.getDay() === 0 || ndate2.getDay() === 6   ) {
                                        date2_content = `<h5>W</h5>
                                                        <p>0 Heures </p>` ;
                                        date2_class = 'week' ;
                                    } else {
                                        date2_content = `<h5>A</h5>
                                                             <p>0 Heures </p>` ;
                                            date2_class = 'absent' ;
                                    }
                                }

                                // la date3 
                                if (ndate3 > today) {
                                    date3_content = `<h5>N</h5>
                                                     <p>0 Heures </p>` ;
                                    date3_class = 'normale' ;
                                } else { 
                                    if (ndate3.getDay() === 0 || ndate3.getDay() === 6   ) {
                                        date3_content = `<h5>W</h5>
                                                        <p>0 Heures </p>` ;
                                        date3_class = 'week' ;
                                    } else {
                                        date3_content = `<h5>A</h5>
                                                             <p>0 Heures </p>` ;
                                            date3_class = 'absent' ;
                                    }
                                }

                                // la date4 
                                if (ndate4 > today) {
                                    date4_content = `<h5>N</h5>
                                                     <p>0 Heures </p>` ;
                                    date4_class = 'normale' ;
                                } else { 
                                    if (ndate4.getDay() === 0 || ndate4.getDay() === 6   ) {
                                        date4_content = `<h5>W</h5>
                                                        <p>0 Heures </p>` ;
                                        date4_class = 'week' ;
                                    } else {
                                        date4_content = `<h5>A</h5>
                                                             <p>0 Heures </p>` ;
                                            date4_class = 'absent' ;
                                    }
                                }

                                // la date5 
                                if (ndate5 > today) {
                                    date5_content = `<h5>N</h5>
                                                     <p>0 Heures </p>` ;
                                    date5_class = 'normale' ;
                                } else { 
                                    if (ndate5.getDay() === 0 || ndate5.getDay() === 6   ) {
                                        date5_content = `<h5>W</h5>
                                                        <p>0 Heures </p>` ;
                                        date5_class = 'week' ;
                                    } else {
                                        date5_content = `<h5>A</h5>
                                                             <p>0 Heures </p>` ;
                                            date5_class = 'absent' ;
                                    }
                                }

                                // la date6 
                                if (ndate6 > today) {
                                    date6_content = `<h5>N</h5>
                                                     <p>0 Heures </p>` ;
                                    date6_class = 'normale' ;
                                } else { 
                                    if (ndate6.getDay() === 0 || ndate6.getDay() === 6   ) {
                                        date6_content = `<h5>W</h5>
                                                        <p>0 Heures </p>` ;
                                        date6_class = 'week' ;
                                    } else {
                                        date6_content = `<h5>A</h5>
                                                             <p>0 Heures </p>` ;
                                            date6_class = 'absent' ;
                                    }
                                }

                                // la date7 
                                if (ndate7 > today) {
                                    date7_content = `<h5>N</h5>
                                                     <p>0 Heures </p>` ;
                                    date7_class = 'normale' ;
                                } else { 
                                    if (ndate7.getDay() === 0 || ndate7.getDay() === 6   ) {
                                        date7_content = `<h5>W</h5>
                                                        <p>0 Heures </p>` ;
                                        date7_class = 'week' ;
                                    } else {
                                        date7_content = `<h5>A</h5>
                                                             <p>0 Heures </p>` ;
                                            date7_class = 'absent' ;
                                    }
                                }

                                
                                $('#semaine-table > tbody:last-child').append( `<tr id="employee_${id}">
                                    <th id="employee_${id}_code" class="align-middle" scope="row" style="color: #212529" >${emp_code}</th>
                                    <td class="my-td ${date1_class}" id="employee_${id}_date1" >
                                       ${date1_content}
                                    </td>
                                    <td class="my-td ${date2_class}"  id="employee_${id}_date2">
                                        ${date2_content}
                                    </td>
                                    <td class="my-td ${date3_class}" id="employee_${id}_date3">
                                        ${date3_content}
                                    </td>
                                    <td class="my-td ${date4_class}" id="employee_${id}_date4">
                                        ${date4_content}
                                    </td>
                                    <td class="my-td ${date5_class}" id="employee_${id}_date5">
                                        ${date5_content}
                                    </td>
                                    <td class="my-td ${date6_class}" id="employee_${id}_date6">
                                        ${date6_content}
                                    </td>
                                    <td class="my-td ${date7_class}" id="employee_${id}_date7" >
                                        ${date7_content}
                                    </td>
                                </tr>` );
                            });
                            if(data.employeePresent.length === 0  && data.employeeAbsent.length === 0) {
                                $('#semaine-table > tbody:last-child').append( `<tr>
                                                                            <td class="rotatemychild" style="color : black" colspan="8">
                                                                                <strong> <i class="rotateme fas fa-frown" style="font-size:25px;color:#067b84"></i> Aucun Employee Trouver !!! </strong>
                                                                            </td>
                                                                        </tr>` );
                            }

                        }
                    });
                    var x = document.getElementById("result");
                    x.style.display = "block"; }
        }
</script>
@endsection
