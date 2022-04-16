@extends('layouts.main')
@section('Presence','active')
@section('sidebar')
<li class="sidebar-item @yield('presencesub')">
    <a data-bs-target="#presence" data-bs-toggle="collapse" class="sidebar-link collapsed"
        aria-expanded="false">
        <i class="fa-solid fa-sitemap"></i> <span class="align-middle">Presence</span>
    </a>
    <ul id="presence" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
        <li class="sidebar-item @yield('pointage-aujourd')"><a class="sidebar-link " href="{{route('pointage-aujour')}}">Pointage d'aujourd'hui</a>
        </li>
        <li class="sidebar-item @yield('presence-semaine')"><a class="sidebar-link" href="{{route('presence-semaine')}}">Presence de la semaine
            </a></li>
    </ul>
</li>

@endsection
@section('content')
    @yield('sub-content')
@endsection
