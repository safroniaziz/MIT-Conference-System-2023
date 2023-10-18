@extends('layouts.application')
@section('halaman', 'Awaiting Verification')
@section('menu', 'Awaiting Verification')
@section('sub-halaman')
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item active">Awaiting Verification</li>
@endsection
@section('content')
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Awaiting Verification</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
            <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
            <i class="fa fa-times"></i></button>
        </div>
    </div>
    <div class="box-body">
        @include('awaiting.data')
    </div>
</div>
@endsection

@push('scripts')
    <script>
        let table = new DataTable('#table');
    </script>
@endpush