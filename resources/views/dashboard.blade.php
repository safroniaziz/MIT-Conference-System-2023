@extends('layouts.application')
@section('halaman', 'Dashboard')
@section('menu', 'Dashboard')
@section('sub-halaman')
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item active">Dashboard</li>
@endsection
@section('content')
    @include('dashboard_partials.welcome')
    <div class="row">
        @include('dashboard_partials.profile_information')
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-12">
                    @include('dashboard_partials.update_password')
                </div>
            </div>
        </div>
    </div>
@endsection