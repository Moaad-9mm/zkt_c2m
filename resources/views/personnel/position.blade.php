@extends('layouts.personnel')
@section('Organisation','active')
@section('Position','active')
@section('sub-content')
<div class="container-fluid p-0">
    <h1 class="h3 mb-3"><strong>Position</strong></h1>
    <div class="row">
        <div class="col-xl-12 col-xxl-12 d-flex">
            <div class="card flex-fill w-100">
                <div class="card-body d-flex">
                    <div class="align-self-center w-100">
                        <div class="btns row">
                            <div class="col-6">
                                <a class="btn btn-primary" onclick="showAddPosition()"><i class="fa-solid fa-plus"></i>
                                    Ajouter</a>
                                <a class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#importModal"><i
                                        class="fa-solid fa-file-import"></i> Importer</a>
                                <a href="{{route('export-position')}}" class="btn btn-primary"><i class="fa-solid fa-download "></i>
                                            Exporter</a>
                            </div>
                            
                        </div>
                        <table class="table table-responsive table-bordered" style="margin-top: 2vh;">
                            <thead>
                                <tr>
                                    <th scope="col">Code de Position</th>
                                    <th scope="col">Nom de Position</th>
                                    <th scope="col">Superieure</th>
                                    <th scope="col">Qté d'employé</th>
                                    <th scope="col">Qté Démissionnée</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach  ($positions as $pos)
                                <tr id="position_{{$pos->id}}">
                                    <th scope="row">{{$pos->position_code}}</th>
                                    <td>{{$pos->position_name}}</td>
                                    <td>
                                        @if ($pos->parent)
                                        {{$pos->parent->position_name}}
                                        @else
                                            -
                                        @endif
                                        </td>
                                    <td>{{$pos->employee->where('status','=','0')->count()}}</td>
                                    <td>{{$pos->employee->where('status','=','99')->count()}}</td>
                                    <td>
                                        <a onclick="showEditPosition({{$pos->id}})">
                                            <i class="fa-solid fa-pen-to-square edit"></i>
                                        </a>
                                        <a onclick="deletePosition({{$pos->id}})">
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
                                    class="fa-solid fa-square-plus"></i> Ajouter Position</h1>
                        </div>
                        <div class="modal-body">

                            <form class="p-3">
                                <div class="mb-3 row">
                                    <label class="col-form-label col-sm-6 text-sm-start">Code de Position <span
                                            class="required">*</span></label>
                                    <div class="col-sm-6">
                                        <input id="position_code" type="text" class="form-control" value="{{($last->position_code) + 1}}">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-form-label col-sm-6 text-sm-start">Nom de Position <span
                                            class="required">*</span></label>
                                    <div class="col-sm-6">
                                        <input id="position_name" type="text" class="form-control" placeholder="Nom ...">
                                    </div>
                                </div>
                                <div class="input-group mb-3">
                                    <label class="col-form-label col-sm-6 text-sm-start">Superieure</label>
                                    <select id="parent_position_id" class="form-select col-sm-6">
                                        <option value="0">Select...</option>
                                        @foreach ($positions as $pos)
                                        <option  value="{{$pos->id}}">{{$pos->position_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-12 text-center">
                                    <button type="button" class="btn btn-success" onclick="addPosition()"
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
            <!-- Modal d'importation -->
            <div class="modal fade" id="importModal" tabindex="-1" role="dialog" aria-labelledby="importModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header ">
                            <h1 class="h3" style="color: white; font-size: larger; margin-left: 20px;"><i
                                    class="fa-solid fa-file-import"></i> Importer Position </h1>
                        </div>
                        <div class="modal-body">

                            <form action="{{ route('import-position') }}" method="POST" enctype="multipart/form-data" class="p-3">
                                @csrf
                                <div class="mb-3 row">
                                    <label class="col-form-label col-sm-6 text-sm-start">Telecharger Un Modele :</label>
                                    <div class="col-6 d-grid gap-2 d-md-flex justify-content-md-center">
                                        <a href="/dowloadPositionModele"><i class="fa-solid fa-download export"></i> </a>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-form-label col-sm-4 text-sm-start">Fichier <span
                                            class="required">*</span> :</label>
                                    <div class="col-sm-8">
                                        <input name="positionsFile" id="positionsFile" type="file">
                                    </div>
                                </div>
                                <div class="">
                                    <h5 class="card-title" style="color:#3c3f43;;"> <span class="required">*</span> Description</h5>
                                    <p class="text-muted" style="font-size: 12px;">
                                        1.L'En-tête dans le modèle de fichier est obligatoire <br>
                                        2.Le code, le nom sont obligatoires <br>
                                        3.La position supérieur doit être le code du position <br>
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

                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
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
                                    class="fa-solid fa-pen-to-square"></i> Modifier Position</h1>
                        </div>
                        <div class="modal-body">

                            <form class="p-3">
                                <input type="hidden" id="e_position_id">
                                <div class="mb-3 row">
                                    <label class="col-form-label col-sm-6 text-sm-start">Code de Position </label>
                                    <div class="col-sm-6">
                                        <input type="text" id="e_position_code" class="form-control" placeholder="Code ..." value="" disabled>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-form-label col-sm-6 text-sm-start">Nom de Position <span
                                            class="required">*</span></label>
                                    <div class="col-sm-6">
                                        <input type="text" id="e_position_name" class="form-control" placeholder="Nom ..." value="">
                                    </div>
                                </div>
                               
                                <div class="col-12 text-center">
                                    <button type="button" class="btn btn-success" onclick="editPosition()"
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
        function showAddPosition(){
            $('#addModal').modal('show');
        }
                // ******************************Button de Modification ******************

        function showEditPosition(id){
            var position_code =   $("#position_"+id+" th:nth-child(1)").text();
            var position_name =   $("#position_"+id+" td:nth-child(2)").text();
            $("#e_position_id").val(id);
            $("#e_position_code").val(position_code);
            $("#e_position_name").val(position_name);
            $('#editModal').modal('show');
        }
        // *********end buttons ***********
        // **********Ajouter*************
        function addPosition() {
            var position_code = $('#position_code').val();
            var position_name = $('#position_name').val();
            var parent_position_id = $('#parent_position_id').val();
            if (position_code == '' || position_name == '') {
                    Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: `Quelque chose s'est mal passé !` ,
                    })
                }
                else{
            $.ajax({
                type: "post",
                url: "{{route('positions.store')}}",
                data: {
                    position_code : position_code ,
                    position_name : position_name ,
                    parent_position_id : parent_position_id ,
                    _token: "{{csrf_token()}}"
                },
                success: function(data) {
                        id = data.pos.id;
                        var tdContent = `<td>-</td>` ;
                        if (data.parent) {
                            tdContent = `<td>${data.parent[0].position_name}</td>` ;
                        }
                        $('table tbody').append(` <tr id="position_${id}">
                                    <th scope="row">${data.pos.position_code}</th>
                                    <td>${data.pos.position_name}</td>
                                    ${tdContent}
                                    <td>${data.qteEmp}</td>
                                    <td>${data.qteDem}</td>
                                    <td>
                                        <a onclick="showEditPosition(${id})">
                                            <i class="fa-solid fa-pen-to-square edit"></i>
                                        </a>
                                        <a onclick="deletePosition(${id})">
                                            <i class="fa-solid fa-eraser delete"></i>
                                        </a>
                                    </td>
                                </tr> `);
    
                        $('#position_code').val( parseInt(data.position_code) + 1);
                        $('#position_name').val('');
                        $('#parent_position_id').val(0);
                        $('#addModal').modal('hide');
                        Swal.fire(
                        'Ajoute!',
                        'Votre Position a été Ajoute.',
                        'success'
                        )
                        document.getElementById("position_"+id).style.backgroundColor = "#1cbb8c40" ;
                        setTimeout(function(){  document.getElementById("position_"+data.id).style.backgroundColor = "transparent" ;}, 4500);
                },
                error: function(response) {
                    
                }
            });
                }
        }

        // **********Modifier*************
        function editPosition() {
            var id = $("#e_position_id").val();
            var position_code = $("#e_position_code").val();
            var position_name = $("#e_position_name").val();
            let _url     = "{{ route('positions.update',"+id") }}";
            let _token   =  "{{csrf_token()}}"; 
            if (position_name == '') {
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
                    position_code:position_code ,
                    position_name : position_name ,
                    _token: _token
                    },
                    success: function(data) {
                        $("#position_"+data.id+" th:nth-child(1)").html(data.position_code);
                        $("#position_"+data.id+" td:nth-child(2)").html(data.position_name);
                        $("#e_position_id").val('');
                        $("#e_position_code").val('');
                        $("#e_position_name").val('');
                        document.getElementById("position_"+data.id).style.backgroundColor = "#0dcaf06b";
                        $('#editModal').modal('hide');
                        Swal.fire(
                        'Modifiee!',
                        'Votre Position a été modifiee.',
                        'success'
                        )
                        setTimeout(function(){  document.getElementById("position_"+data.id).style.backgroundColor = "transparent";}, 4500);
                    },
                    error: function(response) {
                    // $('#taskError').text(response.responseJSON.errors.todo);
                    
                    }
                });
                }
                
            }
            // **********Supprimer*************
            function deletePosition(id) {
            let url = "{{ route('positions.destroy',"+id") }}";
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
                    $("#position_"+id).remove();
                }
            });
                Swal.fire(
                'Supprimé!',
                'Votre Position a été supprimé.',
                'success'
                )
            }
            })
            // ------
            
        }

     </script>
            @endsection