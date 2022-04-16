@extends('layouts.main')
@section('Personnel','active')
@section('sidebar')
<li class="sidebar-item @yield('Organisation')">
    <a data-bs-target="#organisation" data-bs-toggle="collapse" class="sidebar-link collapsed"
        aria-expanded="false">
        <i class="fa-solid fa-sitemap"></i> <span class="align-middle">Organisation</span>
    </a>
    <ul id="organisation" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
        <li class="sidebar-item @yield('Departement')"><a class="sidebar-link " href="{{route('departements.index')}}">Departement</a>
        </li>
        <li class="sidebar-item @yield('Position')"><a class="sidebar-link" href="{{route('positions.index')}}">Position
            </a></li>
        <li class="sidebar-item @yield('Zone')"><a class="sidebar-link" href="{{route('zones.index')}}">Zone </a></li>
    </ul>
</li>
<li class="sidebar-item @yield('employe')">
    <a data-bs-target="#employe" data-bs-toggle="collapse" class="sidebar-link collapsed"
        aria-expanded="false">
        <i class="fa-solid fa-users"></i> <span class="align-middle">Employé</span>
    </a>
    <ul id="employe" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
        <li class="sidebar-item @yield('employesub')"><a class="sidebar-link" href="{{route('employees.index')}}">Employé</a></li>
        <li class="sidebar-item @yield('Dimissioner')"><a class="sidebar-link" href="{{route('demissiones.index')}}">Dimissioner</a></li>
    </ul>
</li>
{{-- <li class="sidebar-item @yield('flux-du-travail')">
    <a data-bs-target="#flux-du-travail" data-bs-toggle="collapse" class="sidebar-link collapsed"
        aria-expanded="false">
        <i class="fa-solid fa-bars-staggered"></i> <span class="align-middle">Flux du travail</span>
    </a>
    <ul id="flux-du-travail" class="sidebar-dropdown list-unstyled collapse"
        data-bs-parent="#sidebar">
        <li class="sidebar-item @yield('role-flux-du-travail')"><a class="sidebar-link" href="index.html">Role du flux du
                travail</a></li>
    </ul>
</li> --}}

@endsection
@section('content')
    @yield('sub-content')
@endsection
