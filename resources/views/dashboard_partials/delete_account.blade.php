<div class="col-md-12">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Delete Account</h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                <i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                <i class="fa fa-times"></i></button>
            </div>
        </div>
        <form action="{{ route('password.update') }}" enctype="multipart/form-data" method="POST">
            @csrf @method('PUT')
            <div class="box-body">
                <p>
                    Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.
                <div class="row">
                    <div class="col-md-12 form-group">
                        <label for="">Current Password</label>
                        <input type="password" name="current_password" class="form-control" value="{{ old('current_password') }}">
                        @error('current_password')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-12 form-group">
                        <label for="">Password</label>
                        <input type="password" name="password" class="form-control" value="{{ old('password') }}">
                        @if ($errors->has('password'))
                            <small class="text-danger">{{ $errors->first('password') }}</small>
                        @endif
                    </div>
                    <div class="col-md-12 form-group">
                        <label for="">Password Confirmation</label>
                        <input type="password" name="password_confirmation" class="form-control" value="{{ old('password_confirmation') }}">
                        @if ($errors->has('password_confirmation'))
                            <small class="text-danger">{{ $errors->first('password_confirmation') }}</small>
                        @endif
                    </div>
                </div>
            </div>
            <div class="box-footer">
                <button type="submit" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-check-circle"></i>&nbsp; Save</button>
            </div>
        </form>
    </div>
</div>