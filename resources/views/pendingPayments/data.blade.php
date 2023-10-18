<div class="row">
    <div class="col-md-12 table-responsive">
        <table class="table table-striped table-bordered" id="table" style="width:100%;">
            <thead>
                <tr>
                    <th>No</th>
                    <th>User Name</th>
                    <th>User Type</th>
                    <th style="text-align:center">Download</th>
                    <th style="text-align:center">Verification</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($payments as $index => $payment)
                    <tr>
                        <td>{{ $index+1 }}</td>
                        <td>{{ $payment->user->name }}</td>
                        <td style="text-transform: capitalize">{{ $payment->user->roles->first()->name }}</td>
                        <td class="text-center">
                            <a href="{{ route('payment.download',[$payment->id]) }}" ><i class="fa fa-download"></i>&nbsp; Download</a>
                        </td>
                        <td style="text-align:center">
                            <a onclick="verification({{ $payment->id }})" class="btn btn-success btn-sm btn-flat" style="color:white; cursor:pointer;"><i class="fa fa-check-circle"></i>&nbsp; Verify</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @include('awaiting._modal_verification')
    </div>
</div>

@push('scripts')
    <script>
        function verification(id){
            $('#modalverification').modal('show');
            $('#id_verification').val(id);
        }
    </script>
@endpush