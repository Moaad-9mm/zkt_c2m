@extends('layouts.personnel')
@section('employe','active')
@section('Dimissioner','active')
@section('sub-content')
<div class="container-fluid p-0">
    <h1 class="h3 mb-3"><strong>Demissionner</strong></h1>
    <div class="row">
        <div class="col-xl-12 col-xxl-12 d-flex">
            <div class="card flex-fill w-100">
                <div class="card-body d-flex">
                    <div class="align-self-center w-100">
                        <div class="btns row">
                            <div class="col-6">
                                <a class="btn btn-primary" 
                                onclick="showAddDemission()" ><i class="fa-solid fa-plus"></i>
                                    Ajouter</a>
                                <a href="" class="btn btn-primary"><i class="fa-solid fa-download "></i>
                                    Exporter</a>
                            </div>
                        </div>
                        <table class="table table-responsive table-bordered " style="margin-top: 2vh;">
                            <thead>
                                <tr>
                                    <th scope="col">Numero d'employé</th>
                                    <th scope="col">Prenom</th>
                                    <th scope="col">Nom de famille</th>
                                    <th scope="col">Departement</th>
                                    <th scope="col">Position</th>
                                    <th scope="col">Type de demission</th>
                                    <th scope="col">Date de demission</th>
                                    <th scope="col">Presence</th>
                                    <th scope="col">Raison de demission</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody class="text-nowrap">
                                @foreach ($demissionnes as $dem)
                                <tr id="demissionne_{{$dem->id}}">
                                    <th scope="row">{{$dem->employee->emp_code}}</th>
                                    <td>
                                        @if ($dem->employee->first_name)
                                        {{$dem->employee->first_name}}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>
                                        @if ($dem->employee->last_name)
                                        {{$dem->employee->last_name}}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>
                                        @if ($dem->employee->department)
                                        {{$dem->employee->department->dept_name}}
                                    @else
                                        -
                                    @endif
                                    </td>
                                    <td>
                                        @if ($dem->employee->position)
                                        {{$dem->employee->position->position_name}}
                                    @else
                                        -
                                    @endif
                                    </td>
                                    <td>
                                        @switch($dem->resign_type)
                                                @case(1)
                                                    Quitter
                                                    @break
                                                @case(2)
                                                    Renvoyee
                                                    @break
                                                @case(3)
                                                    Dimissionner
                                                    @break
                                                @case(4)
                                                    Transfert
                                                    @break
                                                @case(5)
                                                    Conserver le travail sans salaire
                                                    @break
                                                @default
                                                    -
                                            @endswitch
                                    </td>
                                    <td>{{$dem->resign_date}}</td>
                                    <td>
                                        @if ($dem->disableatt == 0)
                                            Activer
                                        @else
                                            Desactiver
                                        @endif
                                    </td>
                                    <td>
                                        @if ($dem->reason)
                                            {{$dem->reason}}
                                        @else
                                            ----
                                        @endif
                                    </td>
                                    <td>
                                        <a title="Retablir" onclick="retablir({{$dem->id}})">
                                            <i class="fa-solid fa-arrow-rotate-left edit"></i>
                                        </a>
                                        <a onclick="showEditDem({{$dem->id}})">
                                            <i class="fa-solid fa-pen-to-square edit"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ---------------------------------Modals----------------------------------------------------- -->
            <!-- Modal d'ajout -->
            <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header ">
                            <h1 class="h3" style="color: white; font-size: larger; margin-left: 20px;"><i
                                    class="fa-solid fa-square-plus"></i> Ajouter Demissioner</h1>
                        </div>
                        <div class="modal-body">
                            <form class="p-3">
                                <div class="mb-3 row">
                                    <label class="col-form-label col-sm-6 text-sm-start text-nowrap">Employee<span
                                            class="required">*</span> :</label>
                                    <div class="col-sm-6">
                                        <select name="employee_id" id="employee_id" class="form-select " required>
                                            <option value="-1">Emp...</option>
                                            @foreach ($employees as $emp)
                                            <option value="{{$emp->id}}">{{$emp->emp_code}} |
                                                @if ($emp->first_name)
                                                {{$emp->first_name}}
                                                @endif
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-form-label col-sm-6 text-sm-start">Date de demissionne<span
                                        class="required">*</span>:</label>
                                    <div class="col-6 d-grid gap-2 d-md-flex justify-content-md-center">
                                        <input type="date" name="resign_date" id="resign_date" class="form-control" value="<?php echo date('Y-m-d'); ?>" required>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-form-label col-sm-6 text-sm-start text-nowrap">Type de demissione <span
                                            class="required">*</span> :</label>
                                    <div class="col-sm-6">
                                        <select name="resign_type" id="resign_type" class="form-select " required>
                                            <option value="-1">Type...</option>
                                            <option value="1">Quitter</option>
                                            <option value="2">Renvoyee</option>
                                            <option value="3">Dimissionner</option>
                                            <option value="4">Transfert</option>
                                            <option value="5">Conserver le travail sans salaire</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-form-label col-sm-6 text-sm-start text-nowrap">Presence <span
                                            class="required">*</span> :</label>
                                    <div class="col-sm-6">
                                        <select name="disableatt" id="disableatt" class="form-select " required>
                                            <option value="-1">Presence...</option>
                                            <option value="0">Activer</option>
                                            <option value="1">Desactiver</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-form-label col-sm-6 text-sm-start text-nowrap">Raison :</label>
                                    <div class="col-sm-6">
                                        <textarea name="reason" id="reason" class="form-control" rows="2" placeholder="Textarea"></textarea>
                                    </div>
                                </div>
                                <div class="col-12 text-center">
                                    <a type="button" class="btn btn-success" onclick="addDemission()"
                                        style="background-color: #067b84;border-color: #067b84;">Enregistrer</a>
                                </div>
                            </form>
                            
                        </div>
                        <div class="modal-footer">

                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal d'importation -->
            <div class="modal fade" id="importModal" tabindex="-1" role="dialog" aria-labelledby="importModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header ">
                            <h1 class="h3" style="color: white; font-size: larger; margin-left: 20px;"><i
                                    class="fa-solid fa-file-import"></i> Importer Zone </h1>
                        </div>
                        <div class="modal-body">

                            <form class="p-3">
                                <div class="mb-3 row">
                                    <label class="col-form-label col-sm-6 text-sm-start">Telecharger Un Modele :</label>
                                    <div class="col-6 d-grid gap-2 d-md-flex justify-content-md-center">
                                        <a><i class="fa-solid fa-download export"></i> </a>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-form-label col-sm-4 text-sm-start">Fichier <span
                                            class="required">*</span> :</label>
                                    <div class="col-sm-8">
                                        <input type="file">
                                    </div>
                                </div>
                                <div class="">
                                    <h5 class="card-title" style="color:#3c3f43;;"> <span class="required">*</span> Description</h5>
                                    <p class="text-muted" style="font-size: 12px;">
                                        1.L'En-tête dans le modèle de fichier est obligatoire <br>
                                        2.Le code, le nom sont obligatoires <br>
                                        3.Le département supérieur doit être le code du département <br>
                                        4. Toutes les valeurs de colonne doivent être au format texte 
                                    </p>
                                </div>
                                <div class="col-12 text-center">
                                    <button type="button" class="btn btn-success"
                                        style="background-color: #067b84;border-color: #067b84;">Enregistrer</button>
                                </div>
                            </form>
                            
                        </div>
                        <div class="modal-footer">

                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal de modification -->
            <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header ">
                            <h1 class="h3" style="color: white; font-size: larger; margin-left: 20px;"><i
                                    class="fa-solid fa-arrow-right-from-bracket"></i> Demission </h1>
                        </div>
                        <div class="modal-body">
                            <form class="p-3">
                                <input type="hidden" name="e_dem_id" id="e_dem_id">
                                <div class="mb-3 row">
                                    <label class="col-form-label col-sm-6 text-sm-start">Employee<span
                                        class="required">*</span>:</label>
                                    <div class="col-6 d-grid gap-2 d-md-flex justify-content-md-center">
                                        <input type="text" name="e_employee_id" id="e_employee_id" class="form-control" disabled required>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-form-label col-sm-6 text-sm-start">Date de demissionne<span
                                        class="required">*</span>:</label>
                                    <div class="col-6 d-grid gap-2 d-md-flex justify-content-md-center">
                                        <input type="date" name="e_resign_date" id="e_resign_date" class="form-control" required>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-form-label col-sm-6 text-sm-start text-nowrap">Type de demissione <span
                                            class="required">*</span> :</label>
                                    <div class="col-sm-6">
                                        <select name="e_resign_type" id="e_resign_type" class="form-select " required>
                                            <option value="-1">Type...</option>
                                            <option value="1">Quitter</option>
                                            <option value="2">Renvoyee</option>
                                            <option value="3">Dimissionner</option>
                                            <option value="4">Transfert</option>
                                            <option value="5">Conserver le travail sans salaire</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-form-label col-sm-6 text-sm-start text-nowrap">Presence <span
                                            class="required">*</span> :</label>
                                    <div class="col-sm-6">
                                        <select name="e_disableatt" id="e_disableatt" class="form-select" required>
                                            <option value="-1">Presence...</option>
                                            <option value="0">Activer</option>
                                            <option value="1">Desactiver</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-form-label col-sm-6 text-sm-start text-nowrap">Raison :</label>
                                    <div class="col-sm-6">
                                        <textarea name="e_reason" id="e_reason" class="form-control" rows="2" ></textarea>
                                    </div>
                                </div>
                                <div class="col-12 text-center">
                                    <button type="button" class="btn btn-success"  onclick="EditDem()"
                                        style="background-color: #067b84;border-color: #067b84;">Enregistrer</button>
                                </div>
                            </form>
                            
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ---------------------------------End Modals----------------------------------------------------- -->
            <script>
                // l'affichage de l'ajout 
                function showAddDemission() {
                    $('#addModal').modal('show');
                }
                // l'affichage de la modification de demissionne 
                function showEditDem(id) {
                    $.ajax({
                        url: "demissiones/"+id+"/edit ",
                        type: 'GET',
                        dataType: 'json', 
                        success: function(data) {
                            $('#e_dem_id').val(id) ;
                            $('#e_employee_id').val(data.demissionne.employee_id) ;
                            $('#e_resign_date').val(data.demissionne.resign_date) ;
                            $('#e_reason').val(data.demissionne.reason) ;
                            $('#e_disableatt').val(data.demissionne.disableatt) ;
                            $('#e_resign_type').val(data.demissionne.resign_type) ;
                            $('#editModal').modal('show');
                        }
                    });
                }
                // l'ajout de demissione
                function addDemission() {
                    var resign_date = $('#resign_date').val() ;
                    var resign_type = $('#resign_type').val() ;
                    var disableatt = $('#disableatt').val() ;
                    var reason = $('#reason').val() ;
                    var employee_id = $('#employee_id').val() ;
                    if (resign_type == -1 || disableatt == -1 || employee_id == -1) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: `Quelque chose s'est mal passé !` ,
                        }) 
                    } else {
                        $.ajax({
                            type:"POST" ,
                            url : "{{route('demissiones.store')}}",
                            data : {
                                _token: "{{csrf_token()}}",
                                resign_date : resign_date ,
                                resign_type : resign_type ,
                                disableatt : disableatt ,
                                reason : reason ,
                                employee_id : employee_id ,
                                 
                            },
                            success: function(data) {
                                id = data.demissionne.id ;
                                emp_code = data.employee.emp_code ;
                                resign_date = data.demissionne.resign_date ;
                                dept_name = data.dept_name ;
                                position_name = data.position_name ;
                                switch (data.demissionne.resign_type) {
                                    case 1:
                                        resign_type = 'Quitter' ;
                                        break;
                                    case 2:
                                        resign_type = 'Renvoyee' ;
                                        break;
                                    case 3:
                                        resign_type = 'Dimmissionner' ;
                                        break;
                                    case 4:
                                        resign_type = 'Transfert' ;
                                        break;
                                    default:
                                        resign_type = 'Conserver le travail sans salaire' ;
                                        break;
                                        }
                                if (data.demissionne.disableatt == 0) {
                                        disableatt = 'Activer' ;
                                } else {
                                        disableatt = 'Desactiver' ;
                                }
                                if (data.demissionne.reason) {
                                        reason = data.demissionne.reason ;
                                } else {
                                        reason = '----' ;
                                }
                                if (data.employee.first_name) {
                                        first_name = data.employee.first_name ;
                                } else {
                                        first_name = '-' ;
                                }
                                if (data.employee.last_name) {
                                        last_name = data.employee.last_name ;
                                } else {
                                        last_name = '-' ;
                                }
                                
                                $('table tbody').append(`
                                <tr id="demissionne_${id}">
                                    <th scope="row">${emp_code}</th>
                                    <td>${first_name}</td>
                                    <td>${last_name}</td>
                                    <td>${dept_name}</td>
                                    <td>${position_name}</td>
                                    <td>${resign_type}</td>
                                    <td>${resign_date}</td>
                                    <td>${disableatt}</td>
                                    <td>${reason}</td>
                                    <td>
                                        <a title="Retablir" onclick="retablir(${id})">
                                            <i class="fa-solid fa-arrow-rotate-left edit"></i>
                                        </a>
                                        <a data-bs-toggle="modal" data-bs-target="#editModal">
                                            <i class="fa-solid fa-pen-to-square edit"></i>
                                        </a>
                                    </td>
                                </tr>
                                `);
                                Swal.fire(
                                    'Demissionner!',
                                    'Votre Employee a été Demissionnee.',
                                    'success'
                                ) ;

                               
                                $('#addModal').modal('hide');
                                document.getElementById("demissionne_"+id).style.backgroundColor = "#1cbb8c40" ;
                                setTimeout(function(){  
                                    document.getElementById("demissionne_"+id).style.backgroundColor = "transparent" ;
                                }, 4500);
                            },
                            error: function(response) {

                            }
                        });
                        
                    }

                }
                // Retablir
                function retablir(id){
                    $.ajax({
                        url: "{{ route('demissiones.destroy',"+id") }}",
                        type: 'DELETE' ,
                        data: {
                        _token: "{{csrf_token()}}" ,
                        id :id,
                        },
                        success: function(data) {
                            $("#demissionne_"+data.demissionne.id).remove();
                            Swal.fire(
                                'Retablir!',
                                'Votre employee a été retablir.',
                                'success'
                            )
                        }
                        });
                }
                //  la modification de demissionne 
                function EditDem() {
                    var id = $('#e_dem_id').val() ;
                    var employee_id = $('#e_employee_id').val() ;
                    var resign_date = $('#e_resign_date').val() ;
                    var resign_type = $('#e_resign_type').val() ;
                    var disableatt = $('#e_disableatt').val() ;
                    var reason = $('#e_reason').val() ;
                    if (resign_type == -1 || disableatt == -1 ) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: `Quelque chose s'est mal passé !` ,
                        }) 
                    } else {
                        $.ajax({
                            type : "PUT" ,
                            url : "demissiones/"+id ,
                            data : {
                                id : id ,
                                employee_id : employee_id ,
                                resign_date : resign_date ,
                                disableatt : disableatt ,
                                resign_type : resign_type ,
                                reason : reason ,
                                _token: "{{csrf_token()}}"
                            },
                            success : function(data){
                                id = data.demissionne.id ;
                                emp_code = data.employee.emp_code ;
                                resign_date = data.demissionne.resign_date ;
                                dept_name = data.dept_name ;
                                position_name = data.position_name ;
                                switch (data.demissionne.resign_type) {
                                    case "1":
                                        resign_type = 'Quitter' ;
                                        break;
                                    case "2":
                                        resign_type = 'Renvoyee' ;
                                        break;
                                    case "3":
                                        resign_type = 'Dimmissionner' ;
                                        break;
                                    case "4":
                                        resign_type = 'Transfert' ;
                                        break;
                                    default:
                                        resign_type = 'Conserver le travail sans salaire' ;
                                        break;
                                        }
                                if (data.demissionne.disableatt == "0") {
                                        disableatt = 'Activer' ;
                                } else {
                                        disableatt = 'Desactiver' ;
                                }
                                if (data.demissionne.reason) {
                                        reason = data.demissionne.reason ;
                                } else {
                                        reason = '----' ;
                                }
                                if (data.employee.first_name) {
                                        first_name = data.employee.first_name ;
                                } else {
                                        first_name = '-' ;
                                }
                                if (data.employee.last_name) {
                                        last_name = data.employee.last_name ;
                                } else {
                                        last_name = '-' ;
                                }
                                // alert(resign_type);
                                $("#demissionne_"+id+" th:nth-child(1)").html(emp_code);
                                $("#demissionne_"+id+" td:nth-child(2)").html(first_name);
                                $("#demissionne_"+id+" td:nth-child(3)").html(last_name);
                                $("#demissionne_"+id+" td:nth-child(4)").html(dept_name);
                                $("#demissionne_"+id+" td:nth-child(5)").html(position_name);
                                $("#demissionne_"+id+" td:nth-child(6)").html(resign_type);
                                $("#demissionne_"+id+" td:nth-child(7)").html(resign_date);
                                $("#demissionne_"+id+" td:nth-child(8)").html(disableatt);
                                $("#demissionne_"+id+" td:nth-child(9)").html(reason);
                                Swal.fire(
                                'Modifiee!',
                                'la Demissionne a été modifiee.',
                                'success'
                                )
                                $('#e_employee_id').val('') ;
                                $('#e_resign_date').val('') ;
                                $('#e_resign_type').val(-1) ;
                                $('#e_disableatt').val(-1) ;
                                $('#e_reason').val('') ;
                                $('#editModal').modal('hide');
                            },
                            error : function(response){

                            }
                        }) ;
                    }
                }
            </script>
@endsection
