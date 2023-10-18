@extends('layouts.application')
@section('halaman', 'Paper and Presentation Files')
@section('menu', 'Paper and Presentation Files')
@section('sub-halaman')
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item active">Paper and Presentation Files</li>
@endsection
@section('content')
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Paper and Presentation Files</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
            <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
            <i class="fa fa-times"></i></button>
        </div>
    </div>
    <div class="box-body">
        @include('allPapers.data')
    </div>
</div>
@endsection

@push('scripts')
    <script>
        let table = new DataTable('#table');
    </script>
@endpush