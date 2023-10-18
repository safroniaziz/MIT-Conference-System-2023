@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/ckeditor/styles.css') }}">
@endpush
<form action="{{ route('paper.post') }}" method="POST" class="form" enctype="multipart/form-data">
    @csrf @method('POST')
    <div class="box-body">
        <p>
            Please upload your paper and presentation file in the form below.
        </p>
        <div class="row">
            <div class="col-md-12 form-group">
                <label for="">Choose Paper File</label>
                <input type="file" name="paper_file" class="form-control" value="{{ old('paper_file') }}">
                @if ($errors->has('paper_file'))
                    <small class="text-danger">{{ $errors->first('paper_file') }}</small>
                @endif
            </div>

            <div class="col-md-12 form-group" style="margin-bottom: 0px !important;">
                <label for="">Choose Presentation File</label>
                <input type="file" name="presentation_file" class="form-control" value="{{ old('presentation_file') }}">
                @if ($errors->has('presentation_file'))
                    <small class="text-danger">{{ $errors->first('presentation_file') }}</small>
                @endif
            </div>
        </div>
    </div>
    <div class="box-footer">
        <button type="submit" class="btn btn-primary btn-sm btn-flat" id="saveButton"><i class="fa fa-check-circle"></i>&nbsp; Save</button>
    </div>
</form>