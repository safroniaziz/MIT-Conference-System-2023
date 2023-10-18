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
                                        <form action="{{ route('payment.destroy',[$payment->paymentProof->id]) }}" method="POST">
                                            @csrf @method('DELETE')
                                            @if ($payment->paymentProof->status == "pending")
                                                <button type="submit" class="btn btn-danger btn-sm btn-flat"><i class="fa fa-undo"></i>&nbsp; Reset & Create New</button>
                                            @else
                                                <a class="btn btn-danger btn-sm btn-flat disabled" style="cursor: pointer"><i class="fa fa-undo"></i>&nbsp; Reset & Create New</a>
                                            @endif
                                        </form>
                                    </div>
                                </td>
                                <td>
                                    <div style="margin-left: 10px;">
                                        <form action="{{ route('payment.submit',[$payment->paymentProof->id]) }}" method="POST">
                                            @csrf @method('PATCH')
                                            @if ($payment->paymentProof->status == "pending")
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
                    <th>File</th>
                    <td> : </td>
                    <td>
                        <table>
                            <tr>
                                <td>
                                    <div>
                                        <a href="{{ route('payment.download',[$payment->paymentProof->id]) }}" ><i class="fa fa-download"></i>&nbsp; {{ $payment->paymentProof->payment_proof_file }}</a>
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