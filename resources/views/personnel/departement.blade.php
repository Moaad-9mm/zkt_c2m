@extends('layouts.personnel')
@section('Organisation','active')
@section('Departement','active')
@section('sub-content')
<div class="container-fluid p-0">
    <h1 class="h3 mb-3"><strong>Departement</strong></h1>
    <div class="row">
        <div class="col-xl-12 col-xxl-12 d-flex">
            <div class="card flex-fill w-100">
                <div class="card-body d-flex">
                    <div class="align-self-center w-100">
                        <div class="btns row">
                            <div class="col-6">
                                <a class="btn btn-primary" onclick="showAddDepartement()"
                                    ><i class="fa-solid fa-plus"></i>
                                    Ajouter</a>
                                <a class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#importModal"><i
                                        class="fa-solid fa-file-import"></i> Importer</a>
                                <a href="{{route('export-departement')}}" class="btn btn-primary"><i class="fa-solid fa-download "></i>
                                    Exporter</a>
                            </div>
                        </div>
                        <table class="table table-responsive table-bordered" style="margin-top: 2vh;">
                            <thead>
                                <tr>
                                    <th scope="col">Code de Departement</th>
                                    <th scope="col">Nom de Departement</th>
                                    <th scope="col">Superieure</th>
                                    <th scope="col">Qté d'employé</th>
                                    <th scope="col">Qté Démissionnée</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($departements as $dept)
                                <tr id="departement_{{$dept->id}}">
                                    <th scope="row">{{$dept->dept_code}}</th>
                                    <td>{{$dept->dept_name}}</td>
                                    <td>
                                        @if ($dept->parent)
                                        {{$dept->parent->dept_name}}
                                        @else
                                            -
                                        @endif
                                        </td>
                                    <td>{{$dept->employee->where('status','=','0')->count()}}</td>
                                    <td>{{$dept->employee->where('status','=','99')->count()}}</td>
                                    <td>
                                        <a onclick="showEditDepartement({{$dept->id}})" >
                                            <i class="fa-solid fa-pen-to-square edit"></i>
                                        </a>
                                        <a onclick="deleteDepartement({{$dept->id}})">
                                            <i class="fa-solid fa-eraser delete"></i>
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
                                    class="fa-solid fa-square-plus"></i> Ajouter Departement</h1>
                        </div>
                        <div class="modal-body">

                            <form class="p-3">
                                <div class="mb-3 row">
                                    <label class="col-form-label col-sm-6 text-sm-start">Code de departement <span
                                            class="required">*</span></label>
                                    <div class="col-sm-6">
                                        <input id="dept_code" name="dept_code" type="text" class="form-control" placeholder="Code ..." value="{{($last->dept_code) + 1}}" required>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-form-label col-sm-6 text-sm-start">Nom de departement <span
                                            class="required">*</span></label>
                                    <div class="col-sm-6">
                                        <input type="text" id="dept_name" name="dept_name" class="form-control" placeholder="Nom ..." required>
                                    </div>
                                </div>
                                <div class="input-group mb-3">
                                    <label class="col-form-label col-sm-6 text-sm-start">Superieure</label>
                                    <select  id="parent_dept_id" class="form-select col-sm-6"  >
                                        <option value="0">Select...</option>
                                        @foreach ($departements as $dept)
                                        <option  value="{{$dept->id}}">{{$dept->dept_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-12 text-center">
                                    <button type="button" class="btn btn-success"
                                    onclick="addDepartement()" style="background-color: #067b84;border-color: #067b84;">Enregistrer</button>
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
                                    class="fa-solid fa-file-import"></i> Importer Departement </h1>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('import-departement') }}" method="POST" enctype="multipart/form-data" class="p-3">
                                @csrf
                                <div class="mb-3 row">
                                    <label class="col-form-label col-sm-6 text-sm-start">Telecharger Un Modele :</label>
                                    <div class="col-6 d-grid gap-2 d-md-flex justify-content-md-center">
                                        <a href="/dowloadDepartementModele"><i class="fa-solid fa-download export"></i> </a>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-form-label col-sm-4 text-sm-start">Fichier <span
                                            class="required">*</span> :</label>
                                    <div class="col-sm-8">
                                        <input name="departementFile" id="departementFile" type="file" required>
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
                                    <button type="submit" class="btn btn-success"
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
                                    class="fa-solid fa-pen-to-square"></i> Modifier Departement</h1>
                        </div>
                        <div class="modal-body">
                            <form class="p-3">
                                <input type="hidden" name="e_departement_id" id="e_departement_id">
                                <div class="mb-3 row">
                                    <label class="col-form-label col-sm-6 text-sm-start">Code de departement </label>
                                    <div class="col-sm-6">
                                        <input  type="text" id="e_dept_code" name="e_dept_code" class="form-control" value="" disabled>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-form-label col-sm-6 text-sm-start">Nom de departement <span
                                            class="required">*</span></label>
                                    <div class="col-sm-6">
                                        <input type="text" id="e_dept_name" name="e_dept_name" class="form-control" placeholder="Nom ..." value="Departement 1">
                                    </div>
                                </div>
                               
                                <div class="col-12 text-center">
                                    <button type="button" class="btn btn-success" onclick="editDepartement()"
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
                // *********Buttons************
                // ******************************Button d'ajout ******************
        function showAddDepartement(){
            $('#addModal').modal('show');
        }
                // ******************************Button de Modification ******************

        function showEditDepartement(id){
            var dept_code =   $("#departement_"+id+" th:nth-child(1)").text();
            var dept_name =   $("#departement_"+id+" td:nth-child(2)").text();
            $("#e_departement_id").val(id);
            $("#e_dept_code").val(dept_code);
            $("#e_dept_name").val(dept_name);
            $('#editModal').modal('show');
        }
        // *********end buttons ***********
        // **********Ajouter*************
        function addDepartement() {
            var dept_code = $('#dept_code').val();
            var dept_name = $('#dept_name').val();
            var parent_dept_id = $('#parent_dept_id').val();
            if (dept_code == '' || dept_name == '') {
                    Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: `Quelque chose s'est mal passé !` ,
                    })
                }
                else{
                    // alert(parent_dept_id) ;
            $.ajax({
                type: "post",
                url: "{{route('departements.store')}}",
                data: {
                    dept_code : dept_code ,
                    dept_name : dept_name ,
                    parent_dept_id : parent_dept_id ,
                    _token: "{{csrf_token()}}"
                },
                success: function(data) {
                        id = data.dpt.id;
                        var tdContent = `<td>-</td>` ;
                        if (data.parent) {
                            tdContent = `<td>${data.parent[0].dept_name}</td>` ;
                        }
                        $('table tbody').append(` <tr id="departement_${id}">
                                    <th scope="row">${data.dpt.dept_code}</th>
                                    <td>${data.dpt.dept_name}</td>
                                    ${tdContent}
                                    <td>${data.qteEmp}</td>
                                    <td>${data.qteDem}</td>
                                    <td>
                                        <a onclick="showEditDepartement(${id})" >
                                            <i class="fa-solid fa-pen-to-square edit"></i>
                                        </a>
                                        <a onclick="deleteDepartement(${id})">
                                            <i class="fa-solid fa-eraser delete"></i>
                                        </a>
                                    </td>
                                </tr> `);
    
                        $('#dept_code').val( parseInt(data.dpt.dept_code) + 1);
                        $('#dept_name').val('');
                        $('#parent_dept_id').val(0);
                        $('#addModal').modal('hide');
                        Swal.fire(
                        'Ajoute!',
                        'Votre departement a été Ajoute.',
                        'success'
                        )
                        document.getElementById("departement_"+id).style.backgroundColor = "#1cbb8c40" ;
                        setTimeout(function(){  document.getElementById("departement_"+data.dpt.id).style.backgroundColor = "transparent" ;}, 4500);
                },
                error: function(response) {
                    
                }
            });
                }
        }

        // **********Modifier*************
        function editDepartement() {
            var id = $("#e_departement_id").val();
            var dept_code = $("#e_dept_code").val();
            var dept_name = $("#e_dept_name").val();
            let _url     = "{{ route('departements.update',"+id") }}";
            let _token   =  "{{csrf_token()}}"; 
            if (dept_name == '') {
                    Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: `Quelque chose s'est mal passé !` ,
                    })
                }
                else{
                    $.ajax({
                url: _url,
                type: "PUT",
                data: {
                    id: id,
                    dept_code:dept_code ,
                    dept_name : dept_name ,
                    _token: _token
                    },
                    success: function(data) {
                        $("#departement_"+data.id+" th:nth-child(1)").html(data.dept_code);
                        $("#departement_"+data.id+" td:nth-child(2)").html(data.dept_name);
                        $("#e_departement_id").val('');
                        $("#e_dept_code").val('');
                        $("#e_dept_name").val('');
                        document.getElementById("departement_"+data.id).style.backgroundColor = "#0dcaf06b";
                        $('#editModal').modal('hide');
                        Swal.fire(
                        'Modifiee!',
                        'Votre departement a été modifiee.',
                        'success'
                        )
                        setTimeout(function(){  document.getElementById("departement_"+data.id).style.backgroundColor = "transparent";}, 4500);
                    },
                    error: function(response) {
                    // $('#taskError').text(response.responseJSON.errors.todo);
                    
                    }
                });
                }
    
                
            }
            // **********Supprimer*************
            function deleteDepartement(id) {
            let url = "{{ route('departements.destroy',"+id") }}";
            let token   = "{{csrf_token()}}";
            // ---------
            Swal.fire({
            title: 'Êtes-vous sûr?',
            text: "Vous ne pourrez pas revenir en arrière !",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Oui, Supprimer!',
            cancelButtonText : 'Annuler'
            }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                url: url,
                type: 'DELETE',
                data: {
                _token: token,
                id :id,
                },
                success: function(response) {
                    $("#departement_"+id).remove();
                }
            });
                Swal.fire(
                'Supprimé!',
                'Votre departement a été supprimé.',
                'success'
                )
            }
            })
            // ------
            
        }

     </script>
@endsection

