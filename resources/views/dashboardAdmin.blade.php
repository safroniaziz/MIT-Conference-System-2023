@extends('layouts.application')
@section('halaman', 'Dashboard')
@section('menu', 'Dashboard')
@section('sub-halaman')
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item active">Dashboard</li>
@endsection
@section('content')
    @include('dashboard_partials.welcome')
@endsection