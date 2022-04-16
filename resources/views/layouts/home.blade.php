@extends('layouts.main')
@section('Home','active')
@section('sidebar')
<li class="sidebar-item active">
    <a class="sidebar-link" href="index.html">
        <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
    </a>
</li>
@endsection
@section('content')
    @yield('sub-content')
@endsection
