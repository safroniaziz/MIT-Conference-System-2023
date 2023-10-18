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
                    <th>Action</th>
                    <td> : </td>
                    <td>
                        <table>
                            <tr>
                                <td>
                                    <div>
                                        <form action="{{ route('abstrak.destroy',[$abstrak->abstrak->id]) }}" method="POST">
                                            @csrf @method('DELETE')
                                            @if ($abstrak->abstrak->status == "pending")
                                                <button type="submit" class="btn btn-danger btn-sm btn-flat"><i class="fa fa-undo"></i>&nbsp; Reset & Create New</button>
                                            @else
                                                <a class="btn btn-danger btn-sm btn-flat disabled" style="cursor: pointer"><i class="fa fa-undo"></i>&nbsp; Reset & Create New</a>
                                            @endif
                                        </form>
                                    </div>
                                </td>
                                <td>
                                    <div style="margin-left: 10px;">
                                        <form action="{{ route('abstrak.submit',[$abstrak->abstrak->id]) }}" method="POST">
                                            @csrf @method('PATCH')
                                            @if ($abstrak->abstrak->status == "pending")
                                            <button type="submit" class="btn btn-primary btn-sm btn-flat show_confirm"><i class="fa fa-check-circle"></i>&nbsp; Submit</button>
                                            @else
                                            <a class="btn btn-primary btn-sm btn-flat disabled"><i class="fa fa-check-circle"></i>&nbsp; Submit</a>
                                            @endif
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <th>Status</th>
                    <th>
                        <td>
                            @if ($abstrak->abstrak->status == "pending")
                                <small class="text-warning"><i class="fa fa-clock-o"></i>&nbsp;Pending Submission</small>
                            @elseif ($abstrak->abstrak->status == "send")
                            <small class="text-primary"><i class="fa fa-clock-o"></i>&nbsp;Submitted for Review.</small>
                            @endif
                        </td>
                    </th>
                </tr>
                <tr>
                    <th>Title</th>
                    <td> : </td>
                    <td> {{ $abstrak->abstrak->title }} </td>
                </tr>
                <tr>
                    <th>Abstract</th>
                    <td> : </td>
                    <td> {!! $abstrak->abstrak->abstrak !!} </td>
                </tr>
                <tr>
                    <th>File</th>
                    <td> : </td>
                    <td>
                        <table>
                            <tr>
                                <td>
                                    <div>
                                        <a href="{{ route('abstrak.download',[$abstrak->abstrak->id]) }}" ><i class="fa fa-download"></i>&nbsp; {{ $abstrak->abstrak->file_name }}</a>
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

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
    <script>
        $('.show_confirm').click(function(event) {
            var form =  $(this).closest("form");
            var name = $(this).data("name");
            event.preventDefault();
            swal({
                title: `Are you sure about the data you're submitting?`,
                text: "Please review it carefully, as once it's submitted, it cannot be altered.",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                form.submit();
                }
            });
        });
    </script>
@endpush