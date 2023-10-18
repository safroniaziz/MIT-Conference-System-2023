<div class="row">
    <div class="col-md-12 table-responsive">
        <table class="table table-striped table-bordered" id="table" style="width:100%;">
            <thead>
                <tr>
                    <th>No</th>
                    <th>User Name</th>
                    <th>User Type</th>
                    <th style="text-align:center">Payment Proof File</th>
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
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@push('scripts')
    <script>
        let table = new DataTable('#table');
    </script>
@endpush