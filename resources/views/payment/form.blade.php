@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/ckeditor/styles.css') }}">
@endpush
<form action="{{ route('payment.post') }}" method="POST" class="form" enctype="multipart/form-data">
    @csrf @method('POST')
    <div class="box-body">
        <p>
            @php
                $presenter = $setting->presenter_payment_amount + auth()->user()->unique_code;
                $participant = $setting->participant_payment_amount + auth()->user()->unique_code;
            @endphp
            Please upload your payment proof of <b>{{ auth()->user()->hasRole('presenter') ? 'Rp. '.number_format($presenter) : 'Rp. '.number_format($participant) }}</b> in the form below.
        </p>
        <div class="row">
            <div class="col-md-12 form-group" style="margin-bottom: 0px !important;">
                <label for="">Upload File</label>
                <input type="file" name="payment_proof_file" class="form-control" value="{{ old('payment_proof_file') }}">
                @if ($errors->has('payment_proof_file'))
                    <small class="text-danger">{{ $errors->first('payment_proof_file') }}</small>
                @endif
            </div>
        </div>
    </div>
    <div class="box-footer">
        <button type="submit" class="btn btn-primary btn-sm btn-flat" id="saveButton"><i class="fa fa-check-circle"></i>&nbsp; Save</button>
    </div>
</form>