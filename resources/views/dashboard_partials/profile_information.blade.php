<div class="col-md-6">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Profile Information</h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                <i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                <i class="fa fa-times"></i></button>
            </div>
        </div>
        <form action="{{ route('profile.update') }}" enctype="multipart/form-data" method="POST">
            @csrf @method('PATCH')
            <div class="box-body">
                <p>
                    Update your account's profile information and email address.
                </p>
                <div class="row">
                    <div class="col-md-12 form-group">
                        <label for="">Name</label>
                        <input type="text" name="name" class="form-control" value="{{ auth()->user()->name }}">
                        @if ($errors->has('name'))
                            <small class="text-danger">{{ $errors->first('name') }}</small>
                        @endif
                    </div>
                    <div class="col-md-12 form-group">
                        <label for="">Email</label>
                        <input type="text" name="email" class="form-control" value="{{ auth()->user()->email }}">
                        @if ($errors->has('email'))
                            <small class="text-danger">{{ $errors->first('email') }}</small>
                        @endif
                    </div>
                    <div class="col-md-12 form-group">
                        <label for="">Phone Number</label>
                        <input type="text" name="phone_number" class="form-control" value="{{ auth()->user()->phone_number }}">
                        @if ($errors->has('phone_number'))
                            <small class="text-danger">{{ $errors->first('phone_number') }}</small>
                        @endif
                    </div>
                    <div class="col-md-12 form-group">
                        <label for="">Address</label>
                        <textarea name="address" class="form-control" id="" cols="30" rows="3">{{ auth()->user()->address }}</textarea>
                        @if ($errors->has('address'))
                            <small class="text-danger">{{ $errors->first('address') }}</small>
                        @endif
                    </div>
                    <div class="col-md-12 form-group">
                        <label for="">Profile Picture</label>
                        <input type="file" name="profile_picture" class="form-control">
                        @if ($errors->has('photo'))
                            <small class="text-danger">{{ $errors->first('photo') }}</small>
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