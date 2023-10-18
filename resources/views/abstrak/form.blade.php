@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/ckeditor/styles.css') }}">
@endpush
<form action="{{ route('abstrak.post') }}" method="POST" class="form" enctype="multipart/form-data">
    @csrf @method('POST')
    <div class="box-body">
        <p>
            Please complete the form below to submit your entry.
        </p>
        <div class="row">
            <div class="col-md-12 form-group">
                <label for="">Title</label>
                <input type="text" name="title" class="form-control" value="{{ old('title') }}">
                @if ($errors->has('title'))
                    <small class="text-danger">{{ $errors->first('title') }}</small>
                @endif
            </div>

            <div class="col-md-12 form-group">
                <textarea name="abstract" class="form-control editor"></textarea>
            </div>

            <div class="col-md-12 form-group">
                <label for="">Upload File</label>
                <input type="file" name="file_name" class="form-control" value="{{ old('file_name') }}">
                @if ($errors->has('file_name'))
                    <small class="text-danger">{{ $errors->first('file_name') }}</small>
                @endif
            </div>
        </div>
    </div>
    <div class="box-footer">
        <button type="submit" class="btn btn-primary btn-sm btn-flat" id="saveButton"><i class="fa fa-check-circle"></i>&nbsp; Save</button>
    </div>
</form>

@push('scripts')
    <script src="{{ asset('assets/ckeditor/build/ckeditor.js') }}"></script>
    <script src="{{ asset('assets/ckeditor/script.js') }}"></script>
    {{-- <script>
        $(document).ready(function() {
            $('#saveButton').click(function() {
                event.preventDefault();
                var $button = $(this);
                $button.html('<i class="fa fa-check-circle"></i>&nbsp; Saving...');  // Mengubah teks tombol
    
                $('#myForm').submit();
                // Lanjutkan dengan pengiriman formulir
                // Aktifkan kembali tombol setelah 2 detik
                setTimeout(function() {
                    $button.prop('disabled', false);  // Mengaktifkan tombol kembali
                    $button.html('<i class="fa fa-check-circle"></i>&nbsp; Save');  // Mengembalikan teks tombol
                }, 1000); // Waktu dalam milidetik (2000 ms = 2 detik)
            });
        });
    </script> --}}
@endpush