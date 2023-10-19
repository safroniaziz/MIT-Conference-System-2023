@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/ckeditor/styles.css') }}">
@endpush
<form action="{{ route('setting.update',[$setting->id]) }}" method="POST" class="form" enctype="multipart/form-data">
    @csrf @method('PATCH')
    <div class="box-body">
        <p>
            Edit Application Settings
        </p>
        <div class="row">
            <div class="col-md-12 form-group">
                <label for="">Application Name</label>
                <input type="text" name="app_name" class="form-control" value="{{ $setting->app_name }}">
                @if ($errors->has('app_name'))
                    <small class="text-danger">{{ $errors->first('app_name') }}</small>
                @endif
            </div>

            <div class="col-md-12 form-group">
                <label for="">Application Short Name</label>
                <input type="text" name="app_short_name" class="form-control" value="{{ $setting->app_short_name }}">
                @if ($errors->has('app_short_name'))
                    <small class="text-danger">{{ $errors->first('app_short_name') }}</small>
                @endif
            </div>

            <div class="col-md-12 form-group">
                <label for="">Application Description</label>
                <textarea name="app_description" class="form-control" id="" cols="30" rows="3">{{ $setting->app_description }}</textarea>
                @if ($errors->has('app_description'))
                    <small class="text-danger">{{ $errors->first('app_description') }}</small>
                @endif
            </div>

            <div class="col-md-12 form-group">
                <label for="">Presenter Cost</label>
                <input type="text" name="presenter_payment_amount" class="form-control" value="{{ $setting->presenter_payment_amount }}">
                @if ($errors->has('presenter_payment_amount'))
                    <small class="text-danger">{{ $errors->first('presenter_payment_amount') }}</small>
                @endif
            </div>

            <div class="col-md-12 form-group">
                <label for="">Participant Cost</label>
                <input type="text" name="participant_payment_amount" class="form-control" value="{{ $setting->participant_payment_amount }}">
                @if ($errors->has('participant_payment_amount'))
                    <small class="text-danger">{{ $errors->first('participant_payment_amount') }}</small>
                @endif
            </div>
        </div>
    </div>
    <div class="box-footer">
        <button type="submit" class="btn btn-primary btn-sm btn-flat" id="saveButton"><i class="fa fa-check-circle"></i>&nbsp; Save</button>
    </div>
</form>