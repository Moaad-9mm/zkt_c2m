@extends('layouts.personnel')
@section('Organisation','active')
@section('Zone','active')
@section('sub-content')
<div class="container-fluid p-0">
    <h1 class="h3 mb-3"><strong>Zone</strong></h1>
    <div class="row">
        <div class="col-xl-12 col-xxl-12 d-flex">
            <div class="card flex-fill w-100">
                <div class="card-body d-flex">
                    <div class="align-self-center w-100">
                        <div class="btns row">
                            <div class="col-6">
                                <a class="btn btn-primary" onclick="showAddZone()" ><i class="fa-solid fa-plus"></i>
                                    Ajouter</a>
                                <a class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#importModal"><i
                                        class="fa-solid fa-file-import"></i>Importer</a>
                                        <a href="{{route('export-zone')}}" class="btn btn-primary"><i class="fa-solid fa-download "></i>
                                            Exporter</a>
                            </div>
                        </div>
                        <table class="table table-responsive table-bordered" style="margin-top: 2vh;">
                            <thead>
                                <tr>
                                    <th scope="col">Code de Zone</th>
                                    <th scope="col">Nom de Zone</th>
                                    <th scope="col">Superieure</th>
                                    <th scope="col">Qté d'appareil</th>
                                    <th scope="col">Qté d'employé</th>
                                    <th scope="col">Qté Démissionnée</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($zones as $zone)
                                <tr id="zone_{{$zone->id}}">
                                    <th scope="row">{{$zone->area_code}}</th>
                                    <td>{{$zone->area_name}}</td>
                                    <td>
                                        @if ($zone->parent)
                                        {{$zone->parent->area_name}}
                                        @else
                                            -
                                        @endif
                                        </td>
                                    <td>-</td>
                                    <td>{{$zone->employee->where('status','=','0')->count()}}</td>
                                    <td>{{$zone->employee->where('status','=','99')->count()}}</td>
                                    <td>
                                        <a onclick="showEditZone({{$zone->id}})">
                                            <i class="fa-solid fa-pen-to-square edit"></i>
                                        </a>
                                        <a onclick="deleteZone({{$zone->id}})">
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
                                    class="fa-solid fa-square-plus"></i> Ajouter Zone</h1>
                        </div>
                        <div class="modal-body">

                            <form class="p-3">
                                <div class="mb-3 row">
                                    <label class="col-form-label col-sm-6 text-sm-start">Code de Zone <span
                                            class="required">*</span></label>
                                    <div class="col-sm-6">
                                        <input type="text" id="area_code" class="form-control" value="{{($last->area_code) + 1}}">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-form-label col-sm-6 text-sm-start">Nom de Zone <span
                                            class="required">*</span></label>
                                    <div class="col-sm-6">
                                        <input type="text" id="area_name" class="form-control" placeholder="Nom ...">
                                    </div>
                                </div>
                                <div class="input-group mb-3">
                                    <label class="col-form-label col-sm-6 text-sm-start">Superieure</label>
                                    <select id="parent_area_id" class="form-select col-sm-6">
                                        <option value="0">Select...</option>
                                        @foreach ($zones as $zone)
                                        <option value="{{$zone->id}}">{{$zone->area_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-12 text-center">
                                    <button type="button" class="btn btn-success" onclick="addZone()"
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
                                    class="fa-solid fa-file-import"></i> Importer Zone </h1>
                        </div>
                        <div class="modal-body">
                            <form class="p-3" action="{{ route('import-zone') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3 row">
                                    <label class="col-form-label col-sm-6 text-sm-start">Telecharger Un Modele :</label>
                                    <div class="col-6 d-grid gap-2 d-md-flex justify-content-md-center">
                                        <a href="/dowloadZoneModele"><i class="fa-solid fa-download export"></i> </a>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-form-label col-sm-4 text-sm-start">Fichier <span
                                            class="required">*</span> :</label>
                                    <div class="col-sm-8">
                                        <input name="zoneFile" id="zoneFile" type="file">
                                    </div>
                                </div>
                                <div class="">
                                    <h5 class="card-title" style="color:#3c3f43;;"> <span class="required">*</span> Description</h5>
                                    <p class="text-muted" style="font-size: 12px;">
                                        1.L'En-tête dans le modèle de fichier est obligatoire <br>
                                        2.Le code, le nom sont obligatoires <br>
                                        3.La zone supérieur doit être le code du zone <br>
                                        4.Toutes les valeurs de colonne doivent être au format texte 
                                    </p>
                                </div>
                                <div class="col-12 text-center">
                                    <button  type="submit" class="btn btn-success" 
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
                                    class="fa-solid fa-pen-to-square"></i> Modifier Zone</h1>
                        </div>
                        <div class="modal-body">

                            <form class="p-3">
                                <input type="hidden" id="e_area_id" name="">
                                <div class="mb-3 row">
                                    <label class="col-form-label col-sm-6 text-sm-start">Code de Zone </label>
                                    <div class="col-sm-6">
                                        <input type="text" id="e_area_code" class="form-control" placeholder="Code ..."  disabled>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-form-label col-sm-6 text-sm-start">Nom de Zone <span
                                            class="required">*</span></label>
                                    <div class="col-sm-6">
                                        <input type="text" id="e_area_name" class="form-control" placeholder="Nom ..." value="Zone 1">
                                    </div>
                                </div>
                               
                                <div class="col-12 text-center">
                                    <button type="button" class="btn btn-success" onclick="editZone()"
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
        function showAddZone(){
            $('#addModal').modal('show');
        }
                // ******************************Button de Modification ******************

        function showEditZone(id){
            var area_code =   $("#zone_"+id+" th:nth-child(1)").text();
            var area_name =   $("#zone_"+id+" td:nth-child(2)").text();
            $("#e_area_id").val(id);
            $("#e_area_code").val(area_code);
            $("#e_area_name").val(area_name);
            $('#editModal').modal('show');
        }
        // *********end buttons ***********
        // **********Ajouter*************
        function addZone() {
            var area_code = $('#area_code').val();
            var area_name = $('#area_name').val();
            var parent_area_id = $('#parent_area_id').val();
            if (area_code == '' || area_name == '') {
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
                url: "{{route('zones.store')}}",
                data: {
                    area_code : area_code ,
                    area_name : area_name ,
                    parent_area_id : parent_area_id ,
                    _token: "{{csrf_token()}}"
                },
                success: function(data) {
                        id = data.zone.id;
                        var tdContent = `<td>-</td>` ;
                        if (data.parent) {
                            tdContent = `<td>${data.parent[0].area_name}</td>` ;
                        }
                        $('table tbody').append(` <tr id="zone_${id}">
                                    <th scope="row">${data.zone.area_code}</th>
                                    <td>${data.zone.area_name}</td>
                                    ${tdContent}
                                    <td>-</td>
                                    <td>${data.qteEmp}</td>
                                    <td>${data.qteDem}</td>
                                    <td>
                                        <a onclick="showEditZone(${id})" >
                                            <i class="fa-solid fa-pen-to-square edit"></i>
                                        </a>
                                        <a onclick="deleteZone(${id})">
                                            <i class="fa-solid fa-eraser delete"></i>
                                        </a>
                                    </td>
                                </tr> `);
    
                        $('#area_code').val( parseInt(data.zone.area_code) + 1);
                        $('#area_name').val('');
                        $('#parent_area_id').val(0);
                        $('#addModal').modal('hide');
                        Swal.fire(
                        'Ajoute!',
                        'Votre Zone a été Ajoute.',
                        'success'
                        )
                        document.getElementById("zone_"+id).style.backgroundColor = "#1cbb8c40" ;
                        setTimeout(function(){  document.getElementById("zone_"+data.zone.id).style.backgroundColor = "transparent" ;}, 4500);
                },
                error: function(response) {
                    
                }
            });
                }
        }

        // **********Modifier*************
        function editZone() {
                var id = $("#e_area_id").val();
                var area_code = $("#e_area_code").val();
                var area_name = $("#e_area_name").val();
                let _url     = "{{ route('zones.update',"+id") }}";
                let _token   =  "{{csrf_token()}}"; 
                if (area_name == '') {
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
                        area_code:area_code ,
                        area_name : area_name ,
                        _token: _token
                        },
                        success: function(data) {
                            $("#zone_"+data.id+" th:nth-child(1)").html(data.area_code);
                            $("#zone_"+data.id+" td:nth-child(2)").html(data.area_name);
                            $("#e_area_id").val('');
                            $("#e_area_code").val('');
                            $("#e_area_name").val('');
                            document.getElementById("zone_"+data.id).style.backgroundColor = "#0dcaf06b";
                            $('#editModal').modal('hide');
                            Swal.fire(
                            'Modifiee!',
                            'Votre Zone a été modifiee.',
                            'success'
                            )
                            setTimeout(function(){  document.getElementById("zone_"+data.id).style.backgroundColor = "transparent";}, 4500);
                        },
                        error: function(response) {
                        // $('#taskError').text(response.responseJSON.errors.todo);
                        
                        }
                    });
                }
                    
                }
            // **********Supprimer*************
            function deleteZone(id) {
                let url = "{{ route('zones.destroy',"+id") }}";
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
                        $("#zone_"+id).remove();
                    }
                });
                    Swal.fire(
                    'Supprimé!',
                    'Votre Zone a été supprimé.',
                    'success'
                    )
                }
                })
                // ------
            
        }

     </script>
@endsection