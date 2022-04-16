@extends('layouts.home')
@section('sub-content')
<div class="container-fluid p-0">
    <h1 class="h3 mb-3"><strong>Statistique</strong> d'Aujourd'hui</h1>
    <div class="row">
        <div class="col-xl-6 col-xxl-7 d-flex">
            <div class="card flex-fill w-100">
                <div class="card-header">

                    <h5 class="card-title mb-0">Present</h5>
                </div>
                <div class="card-body d-flex">
                    <div class="align-self-center w-100">
                        <div class="py-3">
                            <div class="chart chart-xs">
                                <canvas id="chartjs-dashboard-pie-1"></canvas>
                            </div>
                        </div>

                        <table class="table mb-0">
                            <tbody>
                                <tr>
                                    <td>Present</td>
                                    <td class="text-end">4306</td>
                                </tr>
                                <tr>
                                    <td>Absent</td>
                                    <td class="text-end">3801</td>
                                </tr>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6 col-xxl-3 d-flex order-2 order-xxl-3">
            <div class="card flex-fill w-100">
                <div class="card-header">

                    <h5 class="card-title mb-0">Status de L'Appareil</h5>
                </div>
                <div class="card-body d-flex">
                    <div class="align-self-center w-100">
                        <div class="py-3">
                            <div class="chart chart-xs">
                                <canvas id="chartjs-dashboard-pie-2"></canvas>
                            </div>
                        </div>

                        <table class="table mb-0">
                            <tbody>
                                <tr>
                                    <td>En ligne</td>
                                    <td class="text-end">4306</td>
                                </tr>
                                <tr>
                                    <td>Hors ligne</td>
                                    <td class="text-end">3801</td>
                                </tr>
                                <tr>
                                    <td>Non Autorisé</td>
                                    <td class="text-end">1689</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-md-12 col-xxl-12 d-flex order-1 order-xxl-1">
            <div class="col-12 col-lg-12 col-xxl-12 d-flex">
                <div class="card flex-fill w-100">
                    <div class="card-header">

                        <h5 class="card-title mb-0">Statistique de presence de Departement</h5>
                    </div>
                    <div class="card-body d-flex w-100">
                        <div class="align-self-center chart chart-lg">
                            <canvas id="chartjs-dashboard-bar"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <h1 class="h3 mb-3"><strong>Moniteur
    </strong> en temps réel</h1>	
    <div class="row">
        <div class="col-12 col-md-12 col-xxl-12 d-flex order-1 order-xxl-1">
            <div class="col-12 col-lg-12 col-xxl-12 d-flex">
                <div class="card flex-fill w-100">
                    <div class="card-header">
                        <!-- <h5 class="card-title mb-0">Statistique de presence de Departement</h5> -->
                    </div>
                    <div class="card-body d-flex w-100">
                        <div class="align-self-center chart chart-lg">
                            <canvas id="chartjs-dashboard-bar"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>

    <h1 class="h3 mb-3"><strong>Résumé 
    </strong> mensuel</h1>	
    <div class="row">
        <div class="col-12 col-md-12 col-xxl-12 d-flex order-1 order-xxl-1">
            <div class="col-12 col-lg-12 col-xxl-12 d-flex">
                <div class="card flex-fill w-100">
                    <div class="card-header">
                        <!-- <h5 class="card-title mb-0">Statistique de presence de Departement</h5> -->
                    </div>
                    <div class="card-body d-flex w-100">
                        <div class="align-self-center chart chart-lg">
                            <canvas id="chartjs-dashboard-bar"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>	

    <h1 class="h3 mb-3"><strong>Liste des tâches
    </strong> à accomplir</h1>	
    <div class="row">
        <div class="col-12 col-md-12 col-xxl-12 d-flex order-1 order-xxl-1">
            <div class="col-12 col-lg-12 col-xxl-12 d-flex">
                <div class="card flex-fill w-100">
                    <div class="card-header">
                        <!-- <h5 class="card-title mb-0">Statistique de presence de Departement</h5> -->
                    </div>
                    <div class="card-body d-flex w-100">
                        <div class="align-self-center chart chart-lg">
                            <canvas id="chartjs-dashboard-bar"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>	
</div>
@endsection
