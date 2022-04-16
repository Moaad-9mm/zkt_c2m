@extends('layouts.personnel')
@section('employe','active')
@section('employesub','active')
@section('sub-content')
<div class="container-fluid p-0">
    <h1 class="h3 mb-3"><strong>Employé</strong></h1>
    <div class="row">
        <div class="col-xl-12 col-xxl-12 d-flex">
            <div class="card flex-fill w-100">
                <div class="card-body d-flex">
                    <div class="align-self-center w-100">
                        <div class="btns row">
                            <div class="col-8">
                                <a class="btn btn-primary"  onclick="showAddEmployee()"><i class="fa-solid fa-plus"></i>
                                    Ajouter</a>
                                <a class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#importModal"><i
                                        class="fa-solid fa-file-import"></i> Importer</a>
                                <a href="{{route('export-employee')}}" class="btn btn-primary"><i class="fa-solid fa-download"></i>
                                    Exporter</a>
                            </div>
                        </div>
                        <table class="table table-responsive table-bordered" style="margin-top: 2vh;">
                            <thead>
                                <tr >
                                    <th scope="col">Numéro d'employé</th>
                                    <th scope="col">Prénom</th>
                                    <th scope="col">Département</th>
                                    <th scope="col">Position</th>
                                    <th scope="col">Type d'emploi</th>
                                    <th scope="col">Date d'embauche</th>
                                    <th scope="col">Statut de l'application</th>
                                    <th scope="col">Zone</th>
                                    <th scope="col">Edit</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($employees as $emp)
                                <tr class="text-nowrap" id="employee_{{$emp->id}}">
                                    <th scope="row">{{$emp->emp_code}}</th>
                                    <td>
                                        @if ($emp->first_name)
                                        {{$emp->first_name}}
                                        @else                 
                                        -
                                        @endif
                                    </td>
                                    <td> @if ($emp->department)
                                        {{$emp->department->dept_name}}
                                    @else
                                        -
                                    @endif
                                    </td>
                                    <td>
                                        @if ($emp->position)
                                        {{$emp->position->position_name}}
                                    @else
                                        -
                                    @endif
                                        </td>
                                    <td>
                                            @switch($emp->emp_type)
                                                @case(1)
                                                    Permanant
                                                    @break
                                                @case(2)
                                                    Temporaire
                                                    @break
                                                @case(3)
                                                    Probation
                                                    @break
                                                @default
                                                    -
                                            @endswitch
                                    </td>
                                    <td>
                                        @if ($emp->hire_date)
                                        {{$emp->hire_date}}
                                        @else
                                            -
                                        @endif
                                        
                                    </td>
                                    <td>
                                        @if ($emp->app_status == 1)
                                        <i class="fa-solid fa-circle-check green"></i>
                                        @else
                                        <i class="fa-solid fa-circle-minus red"></i>
                                        @endif
                                    </td>
                                    <td>
                                        
                                       @if ($emp->area)
                                       {{$emp->area->first()->area_name}}
                                        @endif 
                                    </td>
                                    <td>
                                        <a onclick="showEditEmployee({{$emp->id}})" title="Modifier">
                                            <i class="fa-solid fa-pen-to-square edit"></i>
                                        </a>
                                        <a onclick="deleteEmployee({{$emp->id}})" title="Supprimer">
                                            <i class="fa-solid fa-eraser delete"></i>
                                        </a>
                                        <a title="Demission" onclick="showAddDemission({{$emp->id}})" >
                                            <i class="fa-solid fa-arrow-right-from-bracket delete"></i>
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
                <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-header ">
                            <h1 class="h3" style="color: white; font-size: larger; margin-left: 20px;"><i
                                    class="fa-solid fa-square-plus"></i> Ajouter Employé</h1>
                        </div>
                        <div class="modal-body">
                            <div class="col-12">
                                <div class="card" style="font-size: 14px;">
                                    <div class="card-header" style="background-color:rgb(237 246 246);">
                                      Profile
                                    </div>
                                    <div class="card-body">
                                      <div class="row">
                                          <div class="col-9">
                                              <div class="row">
                                                  <div class="col-6">
                                                    <div class="mb-3 row">
                                                        <label class="col-form-label col-sm-6 text-sm-start">Numero d'employe <span class="required">*</span></label>
                                                        <div class="col-sm-6">
                                                            <input id="emp_code" name="emp_code" type="text" class="form-control" value="{{($last->emp_code)+1}}">
                                                        </div>
                                                    </div>
                                                  </div>
                                                  <div class="col-6">
                                                    <div class="mb-3 row">
                                                        <label class="col-form-label col-sm-6 text-sm-start">Prenom</label>
                                                        <div class="col-sm-6">
                                                            <input type="text" id="first_name" name="first_name" class="form-control" placeholder="Prenom ...">
                                                        </div>
                                                    </div>
                                                  </div>
                                              </div>
                                              <div class="row">
                                                <div class="col-6">
                                                  <div class="mb-3 row">
                                                    <label class="col-form-label col-sm-6 text-sm-start">Departement<span class="required">*</span></label>
                                                    <div class="col-sm-6">
                                                        <select name="department_id" id="department_id" class="form-select ">
                                                            <option value="-1">...</option>
                                                            @foreach ($departements as $dpt)
                                                            <option value="{{$dpt->id}}">{{$dpt->dept_name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                  </div>
                                                </div>
                                                <div class="col-6">
                                                  <div class="mb-3 row">
                                                      <label class="col-form-label col-sm-6 text-sm-start">Nom de famille</label>
                                                      <div class="col-sm-6">
                                                          <input type="text" id="last_name" name="last_name" class="form-control" placeholder="Nom de famille ...">
                                                      </div>
                                                  </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-6">
                                                  <div class="mb-3 row">
                                                      <label class="col-form-label col-sm-6 text-sm-start">Position</label>
                                                      <div class="col-sm-6">
                                                        <select name="position_id" id="position_id" class="form-select ">
                                                            <option value="">...</option>
                                                            @foreach ($positions as $pos)
                                                            <option value="{{$pos->id}}">{{$pos->position_name}}</option>
                                                            @endforeach
                                                        </select>
                                                      </div>
                                                  </div>
                                                </div>
                                                <div class="col-6">
                                                  <div class="mb-3 row">
                                                      <label class="col-form-label col-sm-6 text-sm-start">Zone<span class="required">*</span></label>
                                                      <div class="col-sm-6">
                                                        <select name="area_id" id="area_id" class="form-select ">
                                                            <option value="-1" >...</option>
                                                            @foreach ($zones as $zone)
                                                            <option value="{{$zone->id}}">{{$zone->area_name}}</option>
                                                            @endforeach
                                                        </select>
                                                      </div>
                                                  </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                  <div class="col-6">
                                                    <div class="mb-3 row">
                                                        <label class="col-form-label col-sm-6 text-sm-start">Type d'emploi</label>
                                                        <div class="col-sm-6">
                                                            <select name="emp_type" id="emp_type" class="form-select ">
                                                                <option value="1">Type d'emploi...</option>
                                                                <option value="1" >Permanant</option>
                                                                <option value="2">Temporaire</option>
                                                                <option value="3">Probation</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                  </div>
                                                  <div class="col-6">
                                                    <div class="mb-3 row">
                                                        <label class="col-form-label col-sm-6 text-sm-start">Date d'embauche</label>
                                                        <div class="col-sm-6">
                                                            <input type="date" id="hire_date" name="hire_date" class="form-control" value="<?php echo date('Y-m-d'); ?>">
                                                        </div>
                                                    </div>
                                                  </div>
                                              </div>
                                              <div class="row" id="row-date">
                                                <div class="col-6">
                                                    <div class="mb-3 row">
                                                        <label class="col-form-label col-sm-6 text-sm-start">Date de debut effective <span class="required">*</span></label>
                                                        <div class="col-sm-6">
                                                            <input type="date" id="start_date" name="start_date" class="form-control" placeholder="Date de debut effective ...">
                                                        </div>
                                                    </div>
                                                  </div>
                                                <div class="col-6">
                                                  <div class="mb-3 row">
                                                      <label class="col-form-label col-sm-6 text-sm-start">Date de fin effective <span class="required">*</span></label>
                                                      <div class="col-sm-6">
                                                          <input type="date" id="end_date" name="end_date" class="form-control" placeholder="Date de fin effective ...">
                                                      </div>
                                                  </div>
                                                </div>
                                            </div>

                                          </div>
                                          <div class="col-3" style="text-align: center;">
                                            <img src="img/avatars/avatar.png" class="me-1 profile-img"
                                            alt="Moaad Ait Lhaj" />
                                          </div>
                                      </div>
                                    </div>
                                  </div>
                            </div>
                            <div class="col-12">
                                <div class="card" style="font-size: 14px;">
                                    <div class="card-header" style="background-color:rgb(237 246 246);">
                                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                                            <li class="nav-item" role="presentation">
                                              <button class="nav-link active" style="color: gray;" id="information-prive-tab" data-bs-toggle="tab" data-bs-target="#information-prive" type="button" role="tab" aria-controls="home" aria-selected="true">Information Privee</button>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                              <button class="nav-link" style="color: gray;" id="para-acces-tab" data-bs-toggle="tab" data-bs-target="#para-acces" type="button" role="tab" aria-controls="profile" aria-selected="false">Paramètre d'accès au périphérique</button>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                              <button class="nav-link" style="color: gray;" id="para-presence-tab" data-bs-toggle="tab" data-bs-target="#para-presence" type="button" role="tab" aria-controls="contact" aria-selected="false">Paramètre de présence</button>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link" style="color: gray;" id="para-app-tab" data-bs-toggle="tab" data-bs-target="#para-app" type="button" role="tab" aria-controls="contact" aria-selected="false">Paramètre de l'application</button>
                                              </li>
                                              <li class="nav-item" role="presentation">
                                                <button class="nav-link" style="color: gray;" id="para-paie-tab" data-bs-toggle="tab" data-bs-target="#para-paie" type="button" role="tab" aria-controls="contact" aria-selected="false">Paramètres de paie</button>
                                              </li>
                                              <li class="nav-item" role="presentation">
                                                <button class="nav-link" style="color: gray;" id="grp-conge-tab" data-bs-toggle="tab" data-bs-target="#grp-conge" type="button" role="tab" aria-controls="contact" aria-selected="false">Groupe de Congés</button>
                                              </li>
                                          </ul>
                                    </div>
                                    <div class="card-body tab-content" id="myTabContent" >
                                        <div class="tab-pane fade show active p-3" id="information-prive" role="tabpanel" aria-labelledby="information-prive-tab">
                                            <div class="row">
                                                <div class="col-4">
                                                    <div class="mb-3 row">
                                                        <label class="col-form-label col-sm-6 text-sm-start">Nom Local :</label>
                                                        <div class="col-sm-6">
                                                            <input type="text" id="nickname" name="nickname" class="form-control" placeholder="Nom Local ...">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="mb-3 row">
                                                        <label class="col-form-label col-sm-6 text-sm-start">Genre :</label>
                                                        <div class="col-sm-6">
                                                            <select id="gender" name="gender" class="form-select ">
                                                                <option value="">...</option>
                                                                <option value="M">Homme</option>
                                                                <option value="F">Femme</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="mb-3 row">
                                                        <label class="col-form-label col-sm-6 text-sm-start">Anniversaire :</label>
                                                        <div class="col-sm-6">
                                                            <input type="date" id="birthday" name="birthday" class="form-control" placeholder="Anniversaire ...">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-4">
                                                    <div class="mb-3 row">
                                                        <label class="col-form-label col-sm-6 text-sm-start">Contact Tel :</label>
                                                        <div class="col-sm-6">
                                                            <input type="text" id="contact_tel" name="contact_tel" class="form-control" placeholder="Contact Tel ...">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="mb-3 row">
                                                        <label class="col-form-label col-sm-6 text-sm-start">Tel Bureau :</label>
                                                        <div class="col-sm-6">
                                                            <input type="text" id="office_tel" name="office_tel" class="form-control" placeholder="Tel Bureau ...">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="mb-3 row">
                                                        <label class="col-form-label col-sm-6 text-sm-start">Mobile :</label>
                                                        <div class="col-sm-6">
                                                            <input type="text" id="mobile" name="mobile" class="form-control" placeholder="Mobile ...">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-4">
                                                    <div class="mb-3 row">
                                                        <label class="col-form-label col-sm-6 text-sm-start">National :</label>
                                                        <div class="col-sm-6">
                                                            <input type="text" id="national" name="national" class="form-control" placeholder="National ...">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="mb-3 row">
                                                        <label class="col-form-label col-sm-6 text-sm-start">Religion</label>
                                                        <div class="col-sm-6">
                                                            <input type="text" id="religion" name="religion" class="form-control" placeholder="Religion ...">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="mb-3 row">
                                                        <label class="col-form-label col-sm-6 text-sm-start">Ville :</label>
                                                        <div class="col-sm-6">
                                                            <input type="text" id="city" name="city" class="form-control" placeholder="Ville ...">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-4">
                                                    <div class="mb-3 row">
                                                        <label class="col-form-label col-sm-6 text-sm-start">Adresse :</label>
                                                        <div class="col-sm-6">
                                                            <input type="text" id="address" name="address" class="form-control" placeholder="Adresse ...">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="mb-3 row">
                                                        <label class="col-form-label col-sm-6 text-sm-start">Code Postal :</label>
                                                        <div class="col-sm-6">
                                                            <input type="text" id="postcode" name="postcode" class="form-control" placeholder="Code Postal ...">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="mb-3 row">
                                                        <label class="col-form-label col-sm-6 text-sm-start">Email :</label>
                                                        <div class="col-sm-6">
                                                            <input type="email" id="email" name="email" class="form-control" placeholder="Email ...">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade  p-3" id="para-acces" role="tabpanel" aria-labelledby="para-acces-tab">
                                            <div class="row">
                                                <div class="col-9">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <div class="mb-3 row">
                                                                <label class="col-form-label col-sm-6 text-sm-start">Mode de Verification :</label>
                                                                <div class="col-sm-6">
                                                                    <select id="verify_mode" name="verify_mode" class="form-select ">
                                                                        <option value="">...</option>
                                                                        <option value="-1">Appliquer le mode groupe</option>
                                                                        <option value="0">N'importe lequel</option>
                                                                        <option value="1">Empreintes Digitales</option>
                                                                        <option value="2">ID utilisateur uniquement</option>
                                                                        <option value="3">Mot de passe</option>
                                                                        <option value="4">Carte uniquement</option>
                                                                        <option value="5">Empreintes digitales / mot de passe</option>
                                                                        <option value="6">Empreintes digitales / carte</option>
                                                                        <option value="7">Mot de passe / Carte</option>
                                                                        <option value="8">ID utilisateur&empreintes digitales</option>
                                                                        <option value="9">Empreintes digitales&mot de passe</option>
                                                                        <option value="10">Empreintes digitales&carte</option>
                                                                        <option value="11">Mot de passe&carte</option>
                                                                        <option value="12">Empreinte digitale&mot de passe&carte</option>
                                                                        <option value="13">ID utilisateur&empreintes digitales&mot de passe</option>
                                                                        <option value="14">Empreinte digitale&carte / ID utilisateur</option>
                                                                        <option value="15">Visage seulement</option>
                                                                        <option value="16">Visage&empreintes digitales</option>
                                                                        <option value="17">Visage&mot de passe</option>
                                                                        <option value="18">Visage&carte</option>
                                                                        <option value="19">Visage&empreintes digitales&carte</option>
                                                                        <option value="20">Visage&empreintes digitales&mot de passe</option>
                                                                        <option value="21">Veine de doigt</option>
                                                                        <option value="22">Veine de doigt&mot de passe</option>
                                                                        <option value="23">Veine de doigt&carte</option>
                                                                        <option value="24">Paume</option>
                                                                        <option value="25">Paume&Carte</option>
                                                                        <option value="26">Paume&Visage</option>
                                                                        <option value="27">Empreintes digitales&paume</option>
                                                                        <option value="28">Paume&Empreintes digitales&Visage</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="mb-3 row">
                                                                <label class="col-form-label col-sm-6 text-sm-start">Privilege du Perephirique :</label>
                                                                <div class="col-sm-6">
                                                                    <select id="dev_privilege" name="dev_privilege" class="form-select ">
                                                                        <option value="">...</option>
                                                                        <option value="0" >Employé</option>
                                                                        <option value="2">Enregistrer</option>
                                                                        <option value="6">Administrateur système</option>
                                                                        <option value="10">Utilisateur défini</option>
                                                                        <option value="14">Super administrateur</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <div class="mb-3 row">
                                                                <label class="col-form-label col-sm-6 text-sm-start">Numero de carte :</label>
                                                                <div class="col-sm-6">
                                                                    <input type="text" id="card_no" name="card_no" class="form-control" placeholder="Numero de carte ...">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="mb-3 row">
                                                                <label class="col-form-label col-sm-6 text-sm-start">Code PIN :</label>
                                                                <div class="col-sm-6">
                                                                    <input type="text" id="device_password" name="device_password" class="form-control" placeholder="Code PIN ...">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <div class="mb-3 row">
                                                                <label class="col-form-label col-sm-6 text-sm-start">Inscrire un appareil :</label>
                                                                <div class="col-sm-6">
                                                                    <input type="text" class="form-control" placeholder="Inscrire un appareil ...">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="mb-3 row" style="flex-wrap: nowrap !important;margin-right: 32%;">
                                                                <label class="col-form-label col-sm-6 text-sm-start">Qte.ED :</label>
                                                                <div class="col-sm-6 input-group">
                                                                    <span class="input-group-text" style="font-size: 0.7rem;">v10</span>
                                                                    <input type="text" class="form-control">
                                                                    <button class="btn btn-secondary" type="button" style="font-size: 0.7rem; background: #e9ecef;color: black;border-color: #e9ecef;">inscrire</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <div class="mb-3 row" style="flex-wrap: nowrap !important;margin-right: 32%;">
                                                                <label class="col-form-label col-sm-6 text-sm-start">Qte de paume.</label>
                                                                <div class="col-sm-6 input-group">
                                                                    <span class="input-group-text" style="font-size: 0.7rem;">v8</span>
                                                                    <input type="text" class="form-control">
                                                                    <button class="btn btn-secondary" type="button" style="font-size: 0.7rem; background: #e9ecef;color: black;border-color: #e9ecef;">inscrire</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="mb-3 row" style="flex-wrap: nowrap !important;margin-right: 32%;">
                                                                <label class="col-form-label col-sm-6 text-sm-start">Qte de Visage.</label>
                                                                <div class="col-sm-6 input-group">
                                                                    <span class="input-group-text" style="font-size: 0.7rem;">v12</span>
                                                                    <input type="text" class="form-control">
                                                                    <button class="btn btn-secondary" type="button" style="font-size: 0.7rem; background: #e9ecef;color: black;border-color: #e9ecef;">inscrire</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-3" style="text-align: center;">
                                                    <img src="img/avatars/avatar.png" class="me-1 profile-img"
                                                    alt="Moaad Ait Lhaj" />
                                                    <p class="text-muted">Bio Photo</p>
                                                  </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade  p-3" id="para-presence" role="tabpanel" aria-labelledby="para-presence-tab">
                                            <div class="row">
                                                <div class="col-9">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <div class="mb-3 row">
                                                                <label class="col-form-label col-sm-6 text-sm-start">Mot de Passe Personnel :</label>
                                                                <div class="col-sm-6">
                                                                    <input type="password" id="self_password" name="self_password" class="form-control" placeholder="Mot de Passe Personnel ...">                                                                
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="mb-3 row">
                                                                <label class="col-form-label col-sm-6 text-sm-start">Role du flex de travail :</label>
                                                                <div class="col-sm-6">
                                                                    <select class="form-select ">
                                                                        <option>Role...</option>
                                                                        <option>Role 1</option>
                                                                        <option>Role 2</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <div class="mb-3 row">
                                                                <label class="col-form-label col-sm-6 text-sm-start">Groupe de presence :</label>
                                                                <div class="col-sm-6">
                                                                    <select class="form-select ">
                                                                        <option>Groupe...</option>
                                                                        <option>Groupe 1</option>
                                                                        <option>Groupe 2</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-6"></div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <div class="form-check form-switch">
                                                                <input class="form-check-input" type="checkbox" id="enable_attendance" name="enable_attendance" checked value="1">
                                                                <label class="form-check-label" for="flexSwitchCheckChecked">Activer Presence</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-check form-switch">
                                                                <input class="form-check-input" type="checkbox" id="enable_schedule" name="enable_schedule" checked value="1">
                                                                <label class="form-check-label" for="flexSwitchCheckChecked">Activer Programme</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <div class="form-check form-switch">
                                                                <input class="form-check-input" type="checkbox" id="enable_holiday" name="enable_holiday" checked value="1">
                                                                <label class="form-check-label" for="flexSwitchCheckChecked">Activer Vacance</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-check form-switch">
                                                                <input class="form-check-input" type="checkbox" id="enable_overtime" name="enable_overtime" checked value="1">
                                                                <label class="form-check-label" for="flexSwitchCheckChecked">Activer Heures Supplimentaires</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-3"></div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade  p-3" id="para-app" role="tabpanel" aria-labelledby="para-app-tab">
                                            <div class="row">
                                                <div class="col-9">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <div class="mb-3 row">
                                                                <label class="col-form-label col-sm-6 text-sm-start">Statut de l'application :</label>
                                                                <div class="col-sm-6">
                                                                    <select id="app_status" name="app_status" class="form-select ">
                                                                        <option value="1">Statut...</option>
                                                                        <option value="1">Activer</option>
                                                                        <option value="0">Desactiver</option>
                                                                    </select>                                                                
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="mb-3 row">
                                                                <label class="col-form-label col-sm-6 text-sm-start">Role de l'APP :</label>
                                                                <div class="col-sm-6">
                                                                    <select id="app_role" name="app_role" class="form-select ">
                                                                        <option value="">...</option>
                                                                        <option value="1">Employé</option>
                                                                        <option value="2">Administrateur</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-3"></div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade  p-3" id="para-paie" role="tabpanel" aria-labelledby="para-paie-tab">
                                            <div class="row">
                                                <div class="col-9">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <div class="mb-3 row">
                                                                <label class="col-form-label col-sm-6 text-sm-start">Periode de Paiement<span class="required">*</span> :</label>
                                                                <div class="col-sm-6">
                                                                    <select id="payment_mode" name="payment_mode" class="form-select ">
                                                                        <option value="1">Mensuel</option>
                                                                        <option value="2">Hebdomadaire</option>
                                                                        <option value="3">Quotidienne</option>
                                                                    </select>                                                                
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="mb-3 row">
                                                                <label class="col-form-label col-sm-6 text-sm-start">Type de Paiement<span class="required">*</span> :</label>
                                                                <div class="col-sm-6">
                                                                    <select id="payment_type" name="payment_type" class="form-select ">
                                                                        <option value="1">Especes</option>
                                                                        <option value="2">Cheque</option>
                                                                        <option value="3">Virement Banquaire</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <div class="mb-3 row">
                                                                <label class="col-form-label col-sm-6 text-sm-start">Nom de Banque :</label>
                                                                <div class="col-sm-6">
                                                                    <input type="text" id="bank_name" name="bank_name" class="form-control" placeholder="Nom de Banque ...">                                                              
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="mb-3 row">
                                                                <label class="col-form-label col-sm-6 text-sm-start">Compte Banquaire :</label>
                                                                <div class="col-sm-6">
                                                                    <input type="text" id="bank_account" name="bank_account" class="form-control" placeholder="Compte Banquaire ...">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <div class="mb-3 row">
                                                                <label class="col-form-label col-sm-6 text-sm-start">Identifiant Agent :</label>
                                                                <div class="col-sm-6">
                                                                    <input type="text" id="agent_id" name="agent_id" class="form-control" placeholder="Identifiant Agent ...">                                                              
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="mb-3 row">
                                                                <label class="col-form-label col-sm-6 text-sm-start">Compte d'Agent :</label>
                                                                <div class="col-sm-6">
                                                                    <input type="text" name="agent_account" id="agent_account" class="form-control" placeholder="Compte d'Agent ...">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <div class="mb-3 row">
                                                                <label class="col-form-label col-sm-6 text-sm-start">Identifiant Personnel :</label>
                                                                <div class="col-sm-6">
                                                                    <input type="text" id="personnel_id" name="personnel_id" class="form-control" placeholder="Identifiant Personnel ...">                                                                
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-3"></div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade  p-3" id="grp-conge" role="tabpanel" aria-labelledby="grp-conge-tab">
                                            <div class="row">
                                                <div class="col-9">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <div class="mb-3 row">
                                                                <label class="col-form-label col-sm-6 text-sm-start">Groupe de Conge :</label>
                                                                <div class="col-sm-6">
                                                                    <select id="leave_group" name="leave_group" class="form-select ">
                                                                        <option>Groupe...</option>
                                                                        <option>Groupe 1</option>
                                                                        <option>Groupe 2</option>
                                                                    </select>                                                                
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <p class="text-danger ">
                                                                Astuce: changer groupe de conge modifiera toutes le regles de solde de conge de l'employe !!!
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-3"></div>
                                            </div>
                                        </div>
                                    </div>
                                  </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <a class="btn btn-success" onclick="addEmployee()">Confirmer</a>
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
                                    class="fa-solid fa-file-import"></i> Importer Employe </h1>
                        </div>
                        <div class="modal-body">

                            <form class="p-3">
                                <div class="mb-3 row">
                                    <label class="col-form-label col-sm-6 text-sm-start">Telecharger Un Modele :</label>
                                    <div class="col-6 d-grid gap-2 d-md-flex justify-content-md-center">
                                        <a href="/dowloadEmployeeModele"><i class="fa-solid fa-download export"></i> </a>
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

                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal de modification -->
            <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-header ">
                            <h1 class="h3" style="color: white; font-size: larger; margin-left: 20px;"><i
                                    class="fa-solid fa-square-plus"></i> Modifier Employé</h1>
                        </div>
                        <div class="modal-body">
                            <div class="col-12">
                                <div class="card" style="font-size: 14px;">
                                    <div class="card-header" style="background-color:rgb(237 246 246);">
                                      Profile
                                    </div>
                                    <div class="card-body">
                                      <div class="row">
                                          <div class="col-9">
                                              <div class="row">
                                                  <div class="col-6">
                                                      <input type="hidden" name="e_id" id="e_id">
                                                    <div class="mb-3 row">
                                                        <label class="col-form-label col-sm-6 text-sm-start">Numero d'employe <span class="required">*</span></label>
                                                        <div class="col-sm-6">
                                                            <input id="e_emp_code" name="e_emp_code" type="text" class="form-control" disabled>
                                                        </div>
                                                    </div>
                                                  </div>
                                                  <div class="col-6">
                                                    <div class="mb-3 row">
                                                        <label class="col-form-label col-sm-6 text-sm-start">Prenom</label>
                                                        <div class="col-sm-6">
                                                            <input type="text" id="e_first_name" name="e_first_name" class="form-control" placeholder="Prenom ...">
                                                        </div>
                                                    </div>
                                                  </div>
                                              </div>
                                              <div class="row">
                                                <div class="col-6">
                                                  <div class="mb-3 row">
                                                    <label class="col-form-label col-sm-6 text-sm-start">Departement<span class="required">*</span></label>
                                                    <div class="col-sm-6">
                                                        <select name="e_department_id" id="e_department_id" class="form-select ">
                                                            <option value="-1">...</option>
                                                            @foreach ($departements as $dpt)
                                                            <option value="{{$dpt->id}}">{{$dpt->dept_name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                  </div>
                                                </div>
                                                <div class="col-6">
                                                  <div class="mb-3 row">
                                                      <label class="col-form-label col-sm-6 text-sm-start">Nom de famille</label>
                                                      <div class="col-sm-6">
                                                          <input type="text" id="e_last_name" name="e_last_name" class="form-control" placeholder="Nom de famille ...">
                                                      </div>
                                                  </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-6">
                                                  <div class="mb-3 row">
                                                      <label class="col-form-label col-sm-6 text-sm-start">Position</label>
                                                      <div class="col-sm-6">
                                                        <select name="e_position_id" id="e_position_id" class="form-select ">
                                                            <option value="">...</option>
                                                            @foreach ($positions as $pos)
                                                            <option value="{{$pos->id}}">{{$pos->position_name}}</option>
                                                            @endforeach
                                                        </select>
                                                      </div>
                                                  </div>
                                                </div>
                                                <div class="col-6">
                                                  <div class="mb-3 row">
                                                      <label class="col-form-label col-sm-6 text-sm-start">Zone<span class="required">*</span></label>
                                                      <div class="col-sm-6">
                                                        <select name="e_area_id" id="e_area_id" class="form-select ">
                                                            <option value="-1" >...</option>
                                                            @foreach ($zones as $zone)
                                                            <option value="{{$zone->id}}">{{$zone->area_name}}</option>
                                                            @endforeach
                                                        </select>
                                                      </div>
                                                  </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                  <div class="col-6">
                                                    <div class="mb-3 row">
                                                        <label class="col-form-label col-sm-6 text-sm-start">Type d'emploi</label>
                                                        <div class="col-sm-6">
                                                            <select name="e_emp_type" id="e_emp_type" class="form-select ">
                                                                <option value="-1">Type d'emploi...</option>
                                                                <option value="1" >Permanant</option>
                                                                <option value="2">Temporaire</option>
                                                                <option value="3">Probation</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                  </div>
                                                  <div class="col-6">
                                                    <div class="mb-3 row">
                                                        <label class="col-form-label col-sm-6 text-sm-start">Date d'embauche</label>
                                                        <div class="col-sm-6">
                                                            <input type="date" id="e_hire_date" name="e_hire_date" class="form-control" value="<?php echo date('Y-m-d'); ?>">
                                                        </div>
                                                    </div>
                                                  </div>
                                              </div>
                                              <div class="row" id="e_row-date">
                                                <div class="col-6">
                                                    <div class="mb-3 row">
                                                        <label class="col-form-label col-sm-6 text-sm-start">Date de debut effective <span class="required">*</span></label>
                                                        <div class="col-sm-6">
                                                            <input type="date" id="e_start_date" name="e_start_date" class="form-control" placeholder="Date de debut effective ...">
                                                        </div>
                                                    </div>
                                                  </div>
                                                <div class="col-6">
                                                  <div class="mb-3 row">
                                                      <label class="col-form-label col-sm-6 text-sm-start">Date de fin effective <span class="required">*</span></label>
                                                      <div class="col-sm-6">
                                                          <input type="date" id="e_end_date" name="e_end_date" class="form-control" placeholder="Date de fin effective ...">
                                                      </div>
                                                  </div>
                                                </div>
                                            </div>

                                          </div>
                                          <div class="col-3" style="text-align: center;">
                                            <img src="img/avatars/avatar.png" class="me-1 profile-img"
                                            alt="Moaad Ait Lhaj" />
                                          </div>
                                      </div>
                                    </div>
                                  </div>
                            </div>
                            <div class="col-12">
                                <div class="card" style="font-size: 14px;">
                                    <div class="card-header" style="background-color:rgb(237 246 246);">
                                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                                            <li class="nav-item" role="presentation">
                                              <button class="nav-link active" style="color: gray;" id="e_information-prive-tab" data-bs-toggle="tab" data-bs-target="#e_information-prive" type="button" role="tab" aria-controls="home" aria-selected="true">Information Privee</button>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                              <button class="nav-link" style="color: gray;" id="e_para-acces-tab" data-bs-toggle="tab" data-bs-target="#e_para-acces" type="button" role="tab" aria-controls="profile" aria-selected="false">Paramètre d'accès au périphérique</button>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                              <button class="nav-link" style="color: gray;" id="e_para-presence-tab" data-bs-toggle="tab" data-bs-target="#e_para-presence" type="button" role="tab" aria-controls="contact" aria-selected="false">Paramètre de présence</button>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link" style="color: gray;" id="e_para-app-tab" data-bs-toggle="tab" data-bs-target="#e_para-app" type="button" role="tab" aria-controls="contact" aria-selected="false">Paramètre de l'application</button>
                                              </li>
                                              <li class="nav-item" role="presentation">
                                                <button class="nav-link" style="color: gray;" id="e_para-paie-tab" data-bs-toggle="tab" data-bs-target="#e_para-paie" type="button" role="tab" aria-controls="contact" aria-selected="false">Paramètres de paie</button>
                                              </li>
                                              <li class="nav-item" role="presentation">
                                                <button class="nav-link" style="color: gray;" id="e_grp-conge-tab" data-bs-toggle="tab" data-bs-target="#e_grp-conge" type="button" role="tab" aria-controls="contact" aria-selected="false">Groupe de Congés</button>
                                              </li>
                                          </ul>
                                    </div>
                                    <div class="card-body tab-content" id="myTabContent" >
                                        <div class="tab-pane fade show active p-3" id="e_information-prive" role="tabpanel" aria-labelledby="e_information-prive-tab">
                                            <div class="row">
                                                <div class="col-4">
                                                    <div class="mb-3 row">
                                                        <label class="col-form-label col-sm-6 text-sm-start">Nom Local :</label>
                                                        <div class="col-sm-6">
                                                            <input type="text" id="e_nickname" name="e_nickname" class="form-control" >
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="mb-3 row">
                                                        <label class="col-form-label col-sm-6 text-sm-start">Genre :</label>
                                                        <div class="col-sm-6">
                                                            <select id="e_gender" name="e_gender" class="form-select ">
                                                                <option value="">...</option>
                                                                <option value="M">Homme</option>
                                                                <option value="F">Femme</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="mb-3 row">
                                                        <label class="col-form-label col-sm-6 text-sm-start">Anniversaire :</label>
                                                        <div class="col-sm-6">
                                                            <input type="date" id="e_birthday" name="e_birthday" class="form-control" value="">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-4">
                                                    <div class="mb-3 row">
                                                        <label class="col-form-label col-sm-6 text-sm-start">Contact Tel :</label>
                                                        <div class="col-sm-6">
                                                            <input type="text" id="e_contact_tel" name="e_contact_tel" class="form-control" placeholder="Contact Tel ...">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="mb-3 row">
                                                        <label class="col-form-label col-sm-6 text-sm-start">Tel Bureau :</label>
                                                        <div class="col-sm-6">
                                                            <input type="text" id="e_office_tel" name="e_office_tel" class="form-control" placeholder="Tel Bureau ...">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="mb-3 row">
                                                        <label class="col-form-label col-sm-6 text-sm-start">Mobile :</label>
                                                        <div class="col-sm-6">
                                                            <input type="text" id="e_mobile" name="e_mobile" class="form-control" placeholder="Mobile ...">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-4">
                                                    <div class="mb-3 row">
                                                        <label class="col-form-label col-sm-6 text-sm-start">National :</label>
                                                        <div class="col-sm-6">
                                                            <input type="text" id="e_national" name="e_national" class="form-control" placeholder="National ...">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="mb-3 row">
                                                        <label class="col-form-label col-sm-6 text-sm-start">Religion</label>
                                                        <div class="col-sm-6">
                                                            <input type="text" id="e_religion" name="e_religion" class="form-control" placeholder="Religion ...">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="mb-3 row">
                                                        <label class="col-form-label col-sm-6 text-sm-start">Ville :</label>
                                                        <div class="col-sm-6">
                                                            <input type="text" id="e_city" name="e_city" class="form-control" placeholder="Ville ...">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-4">
                                                    <div class="mb-3 row">
                                                        <label class="col-form-label col-sm-6 text-sm-start">Adresse :</label>
                                                        <div class="col-sm-6">
                                                            <input type="text" id="e_address" name="e_address" class="form-control" placeholder="Adresse ...">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="mb-3 row">
                                                        <label class="col-form-label col-sm-6 text-sm-start">Code Postal :</label>
                                                        <div class="col-sm-6">
                                                            <input type="text" id="e_postcode" name="e_postcode" class="form-control" placeholder="Code Postal ...">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="mb-3 row">
                                                        <label class="col-form-label col-sm-6 text-sm-start">Email :</label>
                                                        <div class="col-sm-6">
                                                            <input type="email" id="e_email" name="e_email" class="form-control" placeholder="Email ...">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade  p-3" id="e_para-acces" role="tabpanel" aria-labelledby="e_para-acces-tab">
                                            <div class="row">
                                                <div class="col-9">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <div class="mb-3 row">
                                                                <label class="col-form-label col-sm-6 text-sm-start">Mode de Verification :</label>
                                                                <div class="col-sm-6">
                                                                    <select id="e_verify_mode" name="e_verify_mode" class="form-select ">
                                                                        <option value="">...</option>
                                                                        <option value="-1">Appliquer le mode groupe</option>
                                                                        <option value="0">N'importe lequel</option>
                                                                        <option value="1">Empreintes Digitales</option>
                                                                        <option value="2">ID utilisateur uniquement</option>
                                                                        <option value="3">Mot de passe</option>
                                                                        <option value="4">Carte uniquement</option>
                                                                        <option value="5">Empreintes digitales / mot de passe</option>
                                                                        <option value="6">Empreintes digitales / carte</option>
                                                                        <option value="7">Mot de passe / Carte</option>
                                                                        <option value="8">ID utilisateur&empreintes digitales</option>
                                                                        <option value="9">Empreintes digitales&mot de passe</option>
                                                                        <option value="10">Empreintes digitales&carte</option>
                                                                        <option value="11">Mot de passe&carte</option>
                                                                        <option value="12">Empreinte digitale&mot de passe&carte</option>
                                                                        <option value="13">ID utilisateur&empreintes digitales&mot de passe</option>
                                                                        <option value="14">Empreinte digitale&carte / ID utilisateur</option>
                                                                        <option value="15">Visage seulement</option>
                                                                        <option value="16">Visage&empreintes digitales</option>
                                                                        <option value="17">Visage&mot de passe</option>
                                                                        <option value="18">Visage&carte</option>
                                                                        <option value="19">Visage&empreintes digitales&carte</option>
                                                                        <option value="20">Visage&empreintes digitales&mot de passe</option>
                                                                        <option value="21">Veine de doigt</option>
                                                                        <option value="22">Veine de doigt&mot de passe</option>
                                                                        <option value="23">Veine de doigt&carte</option>
                                                                        <option value="24">Paume</option>
                                                                        <option value="25">Paume&Carte</option>
                                                                        <option value="26">Paume&Visage</option>
                                                                        <option value="27">Empreintes digitales&paume</option>
                                                                        <option value="28">Paume&Empreintes digitales&Visage</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="mb-3 row">
                                                                <label class="col-form-label col-sm-6 text-sm-start">Privilege du Perephirique :</label>
                                                                <div class="col-sm-6">
                                                                    <select id="e_dev_privilege" name="e_dev_privilege" class="form-select ">
                                                                        <option value="">...</option>
                                                                        <option value="0" >Employé</option>
                                                                        <option value="2">Enregistrer</option>
                                                                        <option value="6">Administrateur système</option>
                                                                        <option value="10">Utilisateur défini</option>
                                                                        <option value="14">Super administrateur</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <div class="mb-3 row">
                                                                <label class="col-form-label col-sm-6 text-sm-start">Numero de carte :</label>
                                                                <div class="col-sm-6">
                                                                    <input type="text" id="e_card_no" name="e_card_no" class="form-control" placeholder="Numero de carte ...">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="mb-3 row">
                                                                <label class="col-form-label col-sm-6 text-sm-start">Code PIN :</label>
                                                                <div class="col-sm-6">
                                                                    <input type="text" id="e_device_password" name="e_device_password" class="form-control" placeholder="Code PIN ...">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <div class="mb-3 row">
                                                                <label class="col-form-label col-sm-6 text-sm-start">Inscrire un appareil :</label>
                                                                <div class="col-sm-6">
                                                                    <input type="text" class="form-control" placeholder="Inscrire un appareil ...">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="mb-3 row" style="flex-wrap: nowrap !important;margin-right: 32%;">
                                                                <label class="col-form-label col-sm-6 text-sm-start">Qte.ED :</label>
                                                                <div class="col-sm-6 input-group">
                                                                    <span class="input-group-text" style="font-size: 0.7rem;">v10</span>
                                                                    <input type="text" class="form-control">
                                                                    <button class="btn btn-secondary" type="button" style="font-size: 0.7rem; background: #e9ecef;color: black;border-color: #e9ecef;">inscrire</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <div class="mb-3 row" style="flex-wrap: nowrap !important;margin-right: 32%;">
                                                                <label class="col-form-label col-sm-6 text-sm-start">Qte de paume.</label>
                                                                <div class="col-sm-6 input-group">
                                                                    <span class="input-group-text" style="font-size: 0.7rem;">v8</span>
                                                                    <input type="text" class="form-control">
                                                                    <button class="btn btn-secondary" type="button" style="font-size: 0.7rem; background: #e9ecef;color: black;border-color: #e9ecef;">inscrire</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="mb-3 row" style="flex-wrap: nowrap !important;margin-right: 32%;">
                                                                <label class="col-form-label col-sm-6 text-sm-start">Qte de Visage.</label>
                                                                <div class="col-sm-6 input-group">
                                                                    <span class="input-group-text" style="font-size: 0.7rem;">v12</span>
                                                                    <input type="text" class="form-control">
                                                                    <button class="btn btn-secondary" type="button" style="font-size: 0.7rem; background: #e9ecef;color: black;border-color: #e9ecef;">inscrire</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-3" style="text-align: center;">
                                                    <img src="img/avatars/avatar.png" class="me-1 profile-img"
                                                    alt="Moaad Ait Lhaj" />
                                                    <p class="text-muted">Bio Photo</p>
                                                  </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade  p-3" id="e_para-presence" role="tabpanel" aria-labelledby="e_para-presence-tab">
                                            <div class="row">
                                                <div class="col-9">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <div class="mb-3 row">
                                                                <label class="col-form-label col-sm-6 text-sm-start">Mot de Passe Personnel :</label>
                                                                <div class="col-sm-6">
                                                                    <input type="password" id="e_self_password" name="e_self_password" class="form-control" >                                                                
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="mb-3 row">
                                                                <label class="col-form-label col-sm-6 text-sm-start">Role du flex de travail :</label>
                                                                <div class="col-sm-6">
                                                                    <select class="form-select ">
                                                                        <option>Role...</option>
                                                                        <option>Role 1</option>
                                                                        <option>Role 2</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <div class="mb-3 row">
                                                                <label class="col-form-label col-sm-6 text-sm-start">Groupe de presence :</label>
                                                                <div class="col-sm-6">
                                                                    <select class="form-select ">
                                                                        <option>Groupe...</option>
                                                                        <option>Groupe 1</option>
                                                                        <option>Groupe 2</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-6"></div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <div class="form-check form-switch">
                                                                <input class="form-check-input" type="checkbox" id="e_enable_attendance" name="e_enable_attendance" checked value="1">
                                                                <label class="form-check-label" for="flexSwitchCheckChecked">Activer Presence</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-check form-switch">
                                                                <input class="form-check-input" type="checkbox" id="e_enable_schedule" name="e_enable_schedule" checked value="1">
                                                                <label class="form-check-label" for="flexSwitchCheckChecked">Activer Programme</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <div class="form-check form-switch">
                                                                <input class="form-check-input" type="checkbox" id="e_enable_holiday" name="e_enable_holiday" checked value="1">
                                                                <label class="form-check-label" for="flexSwitchCheckChecked">Activer Vacance</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-check form-switch">
                                                                <input class="form-check-input" type="checkbox" id="e_enable_overtime" name="e_enable_overtime" checked value="1">
                                                                <label class="form-check-label" for="flexSwitchCheckChecked">Activer Heures Supplimentaires</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-3"></div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade  p-3" id="e_para-app" role="tabpanel" aria-labelledby="e_para-app-tab">
                                            <div class="row">
                                                <div class="col-9">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <div class="mb-3 row">
                                                                <label class="col-form-label col-sm-6 text-sm-start">Statut de l'application :</label>
                                                                <div class="col-sm-6">
                                                                    <select id="e_app_status" name="e_app_status" class="form-select ">
                                                                        <option value="">Statut...</option>
                                                                        <option value="1">Activer</option>
                                                                        <option value="0">Desactiver</option>
                                                                    </select>                                                                
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="mb-3 row">
                                                                <label class="col-form-label col-sm-6 text-sm-start">Role de l'APP :</label>
                                                                <div class="col-sm-6">
                                                                    <select id="e_app_role" name="e_app_role" class="form-select ">
                                                                        <option value="">...</option>
                                                                        <option value="1">Employé</option>
                                                                        <option value="2">Administrateur</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-3"></div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade  p-3" id="e_para-paie" role="tabpanel" aria-labelledby="e_para-paie-tab">
                                            <div class="row">
                                                <div class="col-9">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <div class="mb-3 row">
                                                                <label class="col-form-label col-sm-6 text-sm-start">Periode de Paiement<span class="required">*</span> :</label>
                                                                <div class="col-sm-6">
                                                                    <select id="e_payment_mode" name="e_payment_mode" class="form-select ">
                                                                        <option value="1">Mensuel</option>
                                                                        <option value="2">Hebdomadaire</option>
                                                                        <option value="3">Quotidienne</option>
                                                                    </select>                                                                
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="mb-3 row">
                                                                <label class="col-form-label col-sm-6 text-sm-start">Type de Paiement<span class="required">*</span> :</label>
                                                                <div class="col-sm-6">
                                                                    <select id="e_payment_type" name="e_payment_type" class="form-select ">
                                                                        <option value="1">Especes</option>
                                                                        <option value="2">Cheque</option>
                                                                        <option value="3">Virement Banquaire</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <div class="mb-3 row">
                                                                <label class="col-form-label col-sm-6 text-sm-start">Nom de Banque :</label>
                                                                <div class="col-sm-6">
                                                                    <input type="text" id="e_bank_name" name="e_bank_name" class="form-control" placeholder="Nom de Banque ...">                                                              
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="mb-3 row">
                                                                <label class="col-form-label col-sm-6 text-sm-start">Compte Banquaire :</label>
                                                                <div class="col-sm-6">
                                                                    <input type="text" id="e_bank_account" name="e_bank_account" class="form-control" placeholder="Compte Banquaire ...">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <div class="mb-3 row">
                                                                <label class="col-form-label col-sm-6 text-sm-start">Identifiant Agent :</label>
                                                                <div class="col-sm-6">
                                                                    <input type="text" id="e_agent_id" name="e_agent_id" class="form-control" placeholder="Identifiant Agent ...">                                                              
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="mb-3 row">
                                                                <label class="col-form-label col-sm-6 text-sm-start">Compte d'Agent :</label>
                                                                <div class="col-sm-6">
                                                                    <input type="text" name="e_agent_account" id="e_agent_account" class="form-control" placeholder="Compte d'Agent ...">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <div class="mb-3 row">
                                                                <label class="col-form-label col-sm-6 text-sm-start">Identifiant Personnel :</label>
                                                                <div class="col-sm-6">
                                                                    <input type="text" id="e_personnel_id" name="e_personnel_id" class="form-control" placeholder="Identifiant Personnel ...">                                                                
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-3"></div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade  p-3" id="e_grp-conge" role="tabpanel" aria-labelledby="e_grp-conge-tab">
                                            <div class="row">
                                                <div class="col-9">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <div class="mb-3 row">
                                                                <label class="col-form-label col-sm-6 text-sm-start">Groupe de Conge :</label>
                                                                <div class="col-sm-6">
                                                                    <select id="e_leave_group" name="e_leave_group" class="form-select">
                                                                        <option>Groupe...</option>
                                                                        <option>Groupe 1</option>
                                                                        <option>Groupe 2</option>
                                                                    </select>                                                                
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <p class="text-danger ">
                                                                Astuce: changer groupe de conge modifiera toutes le regles de solde de conge de l'employe !!!
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-3"></div>
                                            </div>
                                        </div>
                                    </div>
                                  </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <a class="btn btn-success" onclick="updateEmployee()">Confirmer</a>
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal de demissionne -->
            <div class="modal fade" id="demissModal" tabindex="-1" role="dialog" aria-labelledby="demissModalLabel"
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
                                        <input type="text" id="employee_dem" name="employee_dem" class="form-control"  disabled>
                                        <input type="hidden" id="employee_id" name="employee_id" class="form-control" >
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
            <!-- ---------------------------------End Modals----------------------------------------------------- -->
            <script>
                //l'afficchage de l'ajout
                function showAddEmployee(){
                    $('#addModal').modal('show');
                }
                //l'afficchage de la modification
                function showEditEmployee(id){
                    $.ajax({
                        url: "employees/"+id+"/edit ",
                        type: 'GET',
                        dataType: 'json', 
                        success: function(data) {
                            $('#e_id').val(data.employee.id);
                            $('#e_emp_code').val(data.employee.emp_code);
                            $('#e_first_name').val(data.employee.first_name);
                            $('#e_department_id').val(data.employee.department_id); 
                            $('#e_last_name').val(data.employee.last_name);
                            $('#e_position_id').val(data.employee.position_id); 
                            $('#e_area_id').val(data.area.id); 
                            $('#e_emp_type').val(data.employee.emp_type); 
                            $('#e_hire_date').val(data.employee.hire_date);
                            $('#e_start_date').val(data.employment_type.start_date);
                            $('#e_end_date').val(data.employment_type.end_date);
                            $('#e_nickname').val(data.employee.nickname);
                            $('#e_gender').val(data.employee.gender);
                            $('#e_birthday').val(data.employee.birthday);
                            $('#e_contact_tel').val(data.employee.contact_tel);
                            $('#e_office_tel').val(data.employee.office_tel);
                            $('#e_mobile').val(data.employee.mobile);
                            $('#e_national').val(data.employee.national);
                            $('#e_religion').val(data.employee.religion);
                            $('#e_city').val(data.employee.city);
                            $('#e_address').val(data.employee.address);
                            $('#e_postcode').val(data.employee.postcode);
                            $('#e_email').val(data.employee.email);
                            $('#e_verify_mode').val(data.employee.verify_mode); 
                            $('#e_dev_privilege').val(data.employee.dev_privilege); 
                            $('#e_card_no').val(data.employee.card_no);
                            $('#e_device_password').val(data.employee.device_password);
                            // $('#e_self_password').text(data.employee.self_password);
                            $('#e_app_status').val(data.employee.app_status); 
                            $('#e_app_role').val(data.employee.app_role); 
                            $('#e_payment_mode').val(data.payment.payment_mode); 
                            $('#e_payment_type').val(data.payment.payment_type); 
                            $('#e_bank_name').val(data.payment.bank_name);
                            $('#e_bank_account').val(data.payment.bank_account);
                            $('#e_agent_id').val(data.payment.agent_id);
                            $('#e_agent_account').val(data.payment.agent_account);
                            $('#e_personnel_id').val(data.payment.personnel_id);
                            if (data.att_employee.enable_attendance ==  1) {
                                $('#e_enable_attendance').prop('checked', true);
                            } else {
                                $('#e_enable_attendance').prop('checked', false);
                            }
                            if (data.att_employee.enable_schedule ==  1) {
                                $('#e_enable_schedule').prop('checked', true);
                            } else {
                                $('#e_enable_schedule').prop('checked', false);
                            }
                            if (data.att_employee.enable_overtime ==  1) {
                                $('#e_enable_overtime').prop('checked', true);
                            } else {
                                $('#e_enable_overtime').prop('checked', false);
                            }
                            if (data.att_employee.enable_holiday ==  1) {
                                $('#e_enable_holiday').prop('checked', true);
                            } else {
                                $('#e_enable_holiday').prop('checked', false);
                            }
                             $('#editModal').modal('show');
                        }
                    });
                }
                // affichage de date de fin et date de debut de l'ajout
                $(function() {
                    $('#row-date').hide(); 
                    $('#emp_type').change(function(){
                        if($('#emp_type').val() == 2 || $('#emp_type').val() == 3 )   {
                            $('#row-date').show(); 
                        } else {
                            $('#row-date').hide(); 
                        } 
                    });
                });
                // l'affichage de demissionner
                function showAddDemission(id){
                    emp_code = $("#employee_"+id+" th:nth-child(1)").html();
                    first_name = $("#employee_"+id+" td:nth-child(2)").text().replace(/\s+/g, '');
                    $('#employee_id').val(id) ;
                    $('#employee_dem').val(emp_code+" | " + first_name) ;
                    $('#demissModal').modal('show') ;
                }
                // l'ajout d'employee 
                function addEmployee(){
                    var emp_code = $('#emp_code').val();
                    var first_name = $('#first_name').val();
                    var department_id = $('#department_id').val();
                    var last_name = $('#last_name').val();
                    var position_id = $('#position_id').val();
                    var area_id = $('#area_id').val();
                    var emp_type = $('#emp_type').val();
                    var hire_date = $('#hire_date').val();
                    var start_date = $('#start_date').val();
                    var end_date = $('#end_date').val();
                    var nickname = $('#nickname').val();
                    var gender = $('#gender').val();
                    var birthday = $('#birthday').val();
                    var contact_tel = $('#contact_tel').val();
                    var office_tel = $('#office_tel').val();
                    var mobile = $('#mobile').val();
                    var national = $('#national').val();
                    var religion = $('#religion').val();
                    var city = $('#city').val();
                    var address = $('#address').val();
                    var postcode = $('#postcode').val();
                    var email = $('#email').val();
                    var verify_mode = $('#verify_mode').val();
                    var dev_privilege = $('#dev_privilege').val();
                    var card_no = $('#card_no').val();
                    var device_password = $('#device_password').val();
                    var self_password = $('#self_password').val();
                    var app_status = $('#app_status').val();
                    var app_role = $('#app_role').val();
                    var payment_mode = $('#payment_mode').val();
                    var payment_type = $('#payment_type').val();
                    var bank_name = $('#bank_name').val();
                    var bank_account = $('#bank_account').val();
                    var agent_id = $('#agent_id').val();
                    var agent_account = $('#agent_account').val();
                    var personnel_id = $('#personnel_id').val();
                    if ($('#enable_attendance').is(':checked')) {
                        var enable_attendance = 1 ;
                    }else{
                        enable_attendance = 0 ;
                    }
                    if ($('#enable_schedule').is(':checked')) {
                        var enable_schedule = 1 ;
                    }else{
                        enable_schedule = 0 ;
                    }
                    if ($('#enable_holiday').is(':checked')) {
                        var enable_holiday = 1 ;
                    }else{
                        enable_holiday = 0 ;
                    }
                    if ($('#enable_overtime').is(':checked')) {
                        var enable_overtime = 1 ;
                    }else{
                        enable_overtime = 0 ;
                    }

                    if (emp_code == '' || department_id == '-1' || area_id == '-1' || payment_mode == '' || payment_type == '') {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: `Quelque chose s'est mal passé !` ,
                        })
                    }else{
                        $.ajax({
                            type:"post" ,
                            url : "{{route('employees.store')}}",
                            data : {
                                emp_code : emp_code ,
                                first_name : first_name ,
                                department_id : department_id ,
                                last_name : last_name ,
                                position_id : position_id ,
                                area_id : area_id ,
                                emp_type : emp_type ,
                                hire_date : hire_date ,
                                start_date : start_date ,
                                end_date : end_date ,
                                nickname : nickname ,
                                gender : gender ,
                                birthday : birthday ,
                                contact_tel : contact_tel ,
                                office_tel : office_tel ,
                                mobile : mobile ,
                                national : national ,
                                religion : religion ,
                                city : city ,
                                address : address ,
                                postcode : postcode ,
                                email : email ,
                                verify_mode : verify_mode ,
                                dev_privilege : dev_privilege ,
                                card_no : card_no ,
                                device_password : device_password ,
                                self_password : self_password ,
                                app_status : app_status ,
                                app_role : app_role ,
                                payment_mode : payment_mode ,
                                payment_type : payment_type ,
                                bank_name : bank_name ,
                                bank_account : bank_account ,
                                agent_id : agent_id ,
                                agent_account : agent_account ,
                                personnel_id : personnel_id ,
                                enable_attendance : enable_attendance ,
                                enable_schedule : enable_schedule ,
                                enable_holiday : enable_holiday ,
                                enable_overtime : enable_overtime ,
                                _token: "{{csrf_token()}}"
                            },
                            success: function(data) {
                                id = data.employee.id ;
                                emp_code = data.employee.emp_code ;
                                hire_date = data.employee.hire_date ;
                                if (data.employee.first_name) {
                                    first_name = data.employee.first_name ;
                                } else {
                                    first_name = `-` ;
                                }
                                if (data.employee.app_status == 1) {
                                    app_status = `<i class="fa-solid fa-circle-check green"></i>` ;
                                } else {
                                    app_status = `<i class="fa-solid fa-circle-minus red"></i>` ;
                                }
                                switch (data.employee.emp_type) {
                                    case 1:
                                        emp_type = `Permanant` ;
                                        break;
                                    case 2:
                                        emp_type = `Temporaire` ;
                                        break;
                                    case 3:
                                        emp_type = `Probation` ;
                                        break;
                                    default:
                                        emp_type = `-` ;
                                        break;
                                }
                                if (data.pos_name) {
                                    pos_name = data.pos_name ;
                                } else {
                                    pos_name = `-` ;
                                }
                                if (data.area_name) {
                                    area_name = data.area_name ;
                                } else {
                                    area_name = `-` ;
                                }
                                if (data.dept_name) {
                                    dept_name = data.dept_name ;
                                } else {
                                    dept_name = `-` ;
                                }


                                $('table tbody').append(`
                                <tr class="text-nowrap" id="employee_${id}">
                                    <th scope="row">${emp_code}</th>
                                    <td>
                                        ${first_name}
                                    </td>
                                    <td> 
                                        ${dept_name}
                                    </td>
                                    <td>
                                       ${pos_name}
                                    </td>
                                    <td>
                                        ${emp_type}
                                    </td>
                                    <td>
                                        ${hire_date}    
                                    </td>
                                    <td>
                                        ${app_status}
                                    </td>
                                    <td>
                                        ${area_name}
                                    </td>
                                    <td>
                                        <a onclick="showEditEmployee(${id})" title="Modifier">
                                            <i class="fa-solid fa-pen-to-square edit"></i>
                                        </a>
                                        <a title="Supprimer">
                                            <i class="fa-solid fa-eraser delete"></i>
                                        </a>
                                        <a title="Demission" onclick="showAddDemission(${id})" >
                                            <i class="fa-solid fa-arrow-right-from-bracket delete"></i>
                                        </a>
                                    </td>
                                </tr>
                                `) ;
                                Swal.fire(
                                    'Ajoute!',
                                    'Votre departement a été Ajoute.',
                                    'success'
                                ) 

                                $('#emp_code').val(parseInt(data.employee.emp_code) + 1);
                                $('#first_name').val('');
                                $('#department_id').val('-1'); 
                                $('#last_name').val('');
                                $('#position_id').val(''); 
                                $('#area_id').val('-1'); 
                                $('#emp_type').val('1'); 
                                $('#hire_date').val('');
                                $('#start_date').val('');
                                $('#end_date').val('');
                                $('#nickname').val('');
                                $('#gender').val('');
                                $('#birthday').val('');
                                $('#contact_tel').val('');
                                $('#office_tel').val('');
                                $('#mobile').val('');
                                $('#national').val('');
                                $('#religion').val('');
                                $('#city').val('');
                                $('#address').val('');
                                $('#postcode').val('');
                                $('#email').val('');
                                $('#verify_mode').val(''); 
                                $('#dev_privilege').val(''); 
                                $('#card_no').val('');
                                $('#device_password').val('');
                                $('#self_password').val('');
                                $('#app_status').val('1'); 
                                $('#app_role').val(''); 
                                $('#payment_mode').val('1'); 
                                $('#payment_type').val('1'); 
                                $('#bank_name').val('');
                                $('#bank_account').val('');
                                $('#agent_id').val('');
                                $('#agent_account').val('');
                                $('#personnel_id').val('');
                                $('#addModal').modal('hide');
                                document.getElementById("employee_"+id).style.backgroundColor = "#1cbb8c40" ;
                                setTimeout(function(){  
                                    document.getElementById("employee_"+id).style.backgroundColor = "transparent" ;
                                }, 4500);
                            },
                            error: function(response) {

                            }
                        })
                        
                    }
                    
                }
                //  la modification d'employee 
                function updateEmployee(){
                    var id = $('#e_id').val();
                    var emp_code = $('#e_emp_code').val();
                    var first_name = $('#e_first_name').val();
                    var department_id = $('#e_department_id').val();
                    var last_name = $('#e_last_name').val();
                    var position_id = $('#e_position_id').val();
                    var area_id = $('#e_area_id').val();
                    var emp_type = $('#e_emp_type').val();
                    var hire_date = $('#e_hire_date').val();
                    var start_date = $('#e_start_date').val();
                    var end_date = $('#e_end_date').val();
                    var nickname = $('#e_nickname').val();
                    var gender = $('#e_gender').val();
                    var birthday = $('#e_birthday').val();
                    var contact_tel = $('#e_contact_tel').val();
                    var office_tel = $('#e_office_tel').val();
                    var mobile = $('#e_mobile').val();
                    var national = $('#e_national').val();
                    var religion = $('#e_religion').val();
                    var city = $('#e_city').val();
                    var address = $('#e_address').val();
                    var postcode = $('#e_postcode').val();
                    var email = $('#e_email').val();
                    var verify_mode = $('#e_verify_mode').val();
                    var dev_privilege = $('#e_dev_privilege').val();
                    var card_no = $('#e_card_no').val();
                    var device_password = $('#e_device_password').val();
                    // var self_password = $('#e_self_password').val();
                    var app_status = $('#e_app_status').val();
                    var app_role = $('#e_app_role').val();
                    var payment_mode = $('#e_payment_mode').val();
                    var payment_type = $('#e_payment_type').val();
                    var bank_name = $('#e_bank_name').val();
                    var bank_account = $('#e_bank_account').val();
                    var agent_id = $('#e_agent_id').val();
                    var agent_account = $('#e_agent_account').val();
                    var personnel_id = $('#e_personnel_id').val();
                    if ($('#e_enable_attendance').is(':checked')) {
                        var enable_attendance = 1 ;
                    }else{
                        enable_attendance = 0 ;
                    }
                    if ($('#e_enable_schedule').is(':checked')) {
                        var enable_schedule = 1 ;
                    }else{
                        enable_schedule = 0 ;
                    }
                    if ($('#e_enable_holiday').is(':checked')) {
                        var enable_holiday = 1 ;
                    }else{
                        enable_holiday = 0 ;
                    }
                    if ($('#e_enable_overtime').is(':checked')) {
                        var enable_overtime = 1 ;
                    }else{
                        enable_overtime = 0 ;
                    }

                    if (emp_code == '' || department_id == '-1' || area_id == '-1' || payment_mode == '' || payment_type == '') {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: `Quelque chose s'est mal passé !` ,
                        })
                    }else{
                        $.ajax({
                            type:"PUT" ,
                            url : "employees/"+id,
                            data : {
                                id : id ,
                                emp_code : emp_code ,
                                first_name : first_name ,
                                department_id : department_id ,
                                last_name : last_name ,
                                position_id : position_id ,
                                area_id : area_id ,
                                emp_type : emp_type ,
                                hire_date : hire_date ,
                                start_date : start_date ,
                                end_date : end_date ,
                                nickname : nickname ,
                                gender : gender ,
                                birthday : birthday ,
                                contact_tel : contact_tel ,
                                office_tel : office_tel ,
                                mobile : mobile ,
                                national : national ,
                                religion : religion ,
                                city : city ,
                                address : address ,
                                postcode : postcode ,
                                email : email ,
                                verify_mode : verify_mode ,
                                dev_privilege : dev_privilege ,
                                card_no : card_no ,
                                device_password : device_password ,
                                // self_password : self_password ,
                                app_status : app_status ,
                                app_role : app_role ,
                                payment_mode : payment_mode ,
                                payment_type : payment_type ,
                                bank_name : bank_name ,
                                bank_account : bank_account ,
                                agent_id : agent_id ,
                                agent_account : agent_account ,
                                personnel_id : personnel_id ,
                                enable_attendance : enable_attendance ,
                                enable_schedule : enable_schedule ,
                                enable_holiday : enable_holiday ,
                                enable_overtime : enable_overtime ,
                                _token: "{{csrf_token()}}"
                            },
                            success: function(data) {

                                id = data.employee.id ;
                                emp_code = data.employee.emp_code ;
                                hire_date = data.employee.hire_date ;
                                if (data.employee.first_name) {
                                    first_name = data.employee.first_name ;
                                } else {
                                    first_name = `-` ;
                                }
                                if (data.employee.app_status == 1) {
                                    app_status = `<i class="fa-solid fa-circle-check green"></i>` ;
                                } else {
                                    app_status = `<i class="fa-solid fa-circle-minus red"></i>` ;
                                }
                                switch (data.employee.emp_type) {
                                    case '1':
                                        emp_type = `Permanant` ;
                                        break;
                                    case '2':
                                        emp_type = `Temporaire` ;
                                        break;
                                    case '3':
                                        emp_type = `Probation` ;
                                        break;
                                    default:
                                        emp_type = `-` ;
                                        break;
                                }
                                if (data.position) {
                                    pos_name = data.position.position_name ;
                                } else {
                                    pos_name = `-` ;
                                }
                                if (data.zone) {
                                    area_name = data.zone.area_name ;
                                } else {
                                    area_name = `-` ;
                                }
                                if (data.departement) {
                                    dept_name = data.departement.dept_name ;
                                } else {
                                    dept_name = `-` ;
                                }

                                $("#employee_"+id+" th:nth-child(1)").html(emp_code);
                                $("#employee_"+id+" td:nth-child(2)").html(first_name);
                                $("#employee_"+id+" td:nth-child(3)").html(dept_name);
                                $("#employee_"+id+" td:nth-child(4)").html(pos_name);
                                $("#employee_"+id+" td:nth-child(5)").html(emp_type);
                                $("#employee_"+id+" td:nth-child(6)").html(hire_date);
                                $("#employee_"+id+" td:nth-child(7)").html(app_status);
                                $("#employee_"+id+" td:nth-child(8)").html(area_name);
                                Swal.fire(
                                'Modifiee!',
                                'Votre departement a été modifiee.',
                                'success'
                                )
                                $('#e_id').val('');
                                $('#e_emp_code').val('');
                                $('#e_first_name').val('');
                                $('#e_department_id').val('-1'); 
                                $('#e_last_name').val('');
                                $('#e_position_id').val(''); 
                                $('#e_area_id').val('-1'); 
                                $('#e_emp_type').val('1'); 
                                $('#e_hire_date').val('');
                                $('#e_start_date').val('');
                                $('#e_end_date').val('');
                                $('#e_nickname').val('');
                                $('#e_gender').val('');
                                $('#e_birthday').val('');
                                $('#e_contact_tel').val('');
                                $('#e_office_tel').val('');
                                $('#e_mobile').val('');
                                $('#e_national').val('');
                                $('#e_religion').val('');
                                $('#e_city').val('');
                                $('#e_address').val('');
                                $('#e_postcode').val('');
                                $('#e_email').val('');
                                $('#e_verify_mode').val(''); 
                                $('#e_dev_privilege').val(''); 
                                $('#e_card_no').val('');
                                $('#e_device_password').val('');
                                $('#e_self_password').val('');
                                $('#e_app_status').val('1'); 
                                $('#e_app_role').val(''); 
                                $('#e_payment_mode').val('1'); 
                                $('#e_payment_type').val('1'); 
                                $('#e_bank_name').val('');
                                $('#e_bank_account').val('');
                                $('#e_agent_id').val('');
                                $('#e_agent_account').val('');
                                $('#e_personnel_id').val('');
                                $('#editModal').modal('hide');
                                document.getElementById("employee_"+id).style.backgroundColor = "#0dcaf06b" ;
                                setTimeout(function(){  
                                    document.getElementById("employee_"+id).style.backgroundColor = "transparent" ;
                                }, 4500);
                            },
                            error: function(response) {

                            }
                        })
                        
                    }
                    
                }
                // la supprission d'employee 
                function deleteEmployee(id){
                        let url = "{{ route('employees.destroy',"+id") }}";
                        let token   = "{{csrf_token()}}";
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
                            success: function(data) {
                                $("#employee_"+data.id).remove();
                            }
                            });
                            Swal.fire(
                            'Supprimé!',
                            'Votre employee a été supprimé.',
                            'success'
                            )
                            }
                    }) ;
            // ------
                }
                // la demission 
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
                                id = data.employee.id ;
                                $("#employee_"+id).remove();
                                Swal.fire(
                                    'Ajoute!',
                                    'Votre Employee a été Demissionnee.',
                                    'success'
                                ) ;
                                $('#demissModal').modal('hide');
                                
                            },
                            error: function(response) {

                            }
                        });
                        
                    }

                }
                
            </script>

@endsection
