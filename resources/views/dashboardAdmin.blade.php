@extends('layouts.application')
@section('halaman', 'Dashboard')
@section('menu', 'Dashboard')
@section('sub-halaman')
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item active">Dashboard</li>
@endsection
@section('content')
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Welcome, {{ auth()->user()->name }}</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
            <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
            <i class="fa fa-times"></i></button>
        </div>
    </div>
    <div class="box-body">
        <div class="row">

            <div class="col-lg-3 col-xs-12">
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3>{{ $underReview }}</h3>
    
                        <p>SUBMISSIONS</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-file-pdf-o"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-xs-12">
                <div class="small-box bg-green">
                        <div class="inner">
                        <h3>{{ $accepted }}<sup style="font-size: 20px"></sup></h3>
    
                        <p>SUBMISSIONS ACCEPTED</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-check-circle"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-xs-12">
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <h3>{{ $pending }}</h3>
    
                        <p>SUBMISSIONS PENDING</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-clock-o"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-xs-12">
                <div class="small-box bg-red">
                    <div class="inner">
                        <h3>{{ $rejected }}</h3>
    
                        <p>SUBMISSIONS REJECTED</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-paper-plane"></i>
                    </div>
                </div>
            </div>
    
        </div>
        <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-aqua"><i class="fa fa-user"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Presenters</span>
                        <span class="info-box-number">{{ $presenter }}</span>
                    </div>
                </div>
            </div>
    
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-green"><i class="fa fa-users"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Participants</span>
                        <span class="info-box-number">{{ $participant }}</span>
                    </div>
                </div>
            </div>
    
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-yellow"><i class="fa fa-files-o"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Presenter Costs</span>
                        <span class="info-box-number">3,250.000,-</span>
                    </div>
                </div>
            </div>
    
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-red"><i class="fa fa-star-o"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Participation Costs</span>
                        <span class="info-box-number">100,000,-</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection