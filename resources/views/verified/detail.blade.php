@extends('layouts.application')
@section('halaman', 'Verified Submissions')
@section('menu', 'Verified Submissions')
@section('sub-halaman')
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item active">Verified Submissions</li>
@endsection
@section('content')
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Verified Submissions</h3>
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
            <div class="col-md-12">
                <div class="alert alert-warning">
                    <h4>Attention!!!</h4>
                    <p>Please carefully review the entered data. In the event of any inaccuracies, kindly click the "Reset and Create New" button. Once you are certain the information is accurate, please proceed by clicking the "Submit" button. Data will not be verified without clicking the "Submit" button.
                    </p>
                </div>
            </div>
            <div class="col-md-12">
                <table class="table table-bordered table-hover table-striped">
                    <tbody>
                        <tr>
                            <th colspan="3">
                                <a href="{{ route('verified') }}" class="btn btn-warning btn-sm btn-flat"><i class="fa fa-arrow-circle-left"></i>&nbsp; Back</a>
                            </th>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <th>
                                <td>
                                    @if ($abstrak->status == "pending")
                                        <small class="text-warning"><i class="fa fa-clock-o"></i>&nbsp;Pending Submission</small>
                                    @elseif ($abstrak->status == "send")
                                    <small class="text-primary"><i class="fa fa-check-circle"></i>&nbsp;Verified Submissions</small>
                                    @endif
                                </td>
                            </th>
                        </tr>
                        <tr>
                            <th>Title</th>
                            <td> : </td>
                            <td> {{ $abstrak->title }} </td>
                        </tr>
                        <tr>
                            <th>Abstract</th>
                            <td> : </td>
                            <td> {!! $abstrak->abstrak !!} </td>
                        </tr>
                        <tr>
                            <th>File</th>
                            <td> : </td>
                            <td>
                                <table>
                                    <tr>
                                        <td>
                                            <div>
                                                <a href="{{ route('abstrak.download',[$abstrak->id]) }}" ><i class="fa fa-download"></i>&nbsp; {{ $abstrak->file_name }}</a>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection