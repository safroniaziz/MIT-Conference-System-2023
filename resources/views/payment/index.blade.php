@extends('layouts.application')
@section('halaman', 'Upload Payment Proof File')
@section('menu', 'Upload Payment Proof File')
@section('sub-halaman')
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item active">Upload Payment Proof File</li>
@endsection
@section('content')
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Upload Payment Proof File</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
            <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
            <i class="fa fa-times"></i></button>
        </div>
    </div>
    @if ($payment->payment_proof_count > 0)
        @include('payment.data')
    @else
        @include('payment.form')
    @endif
</div>
@endsection

@push('scripts')
    <script>
        $(document).on('submit','.form',function (event){
            event.preventDefault();
            $("#btnSubmit"). attr("disabled", true);
            $("#btnCancel"). attr("disabled", true);

            $("#saveButton"). attr("disabled", true);
            $('#saveButton').html('<i class="fa fa-check-circle"></i>&nbsp; Saving');  // Mengembalikan teks tombol

            $.ajax({
                url: $(this).attr('action'),
                type: $(this).attr('method'),
                typeData: "JSON",
                data: new FormData(this),
                processData:false,
                contentType:false,
                success : function(res) {
                    $("#btnSubmit"). attr("disabled", true);
                    toastr.success(res.text, 'Success: Your submission was successful');
                    setTimeout(function () {
                        window.location.href=res.url;
                    } , 500);
                },
                error:function(xhr){
                    toastr.error(xhr.responseJSON.text, 'Oops, An Error Occurred');
                    setTimeout(function() {
                        $("#saveButton").prop('disabled', false);  // Mengaktifkan tombol kembali
                        $("#saveButton").html('<i class="fa fa-check-circle"></i>&nbsp; Save');  // Mengembalikan teks tombol
                    }, 1000); // Waktu dalam milidetik (2000 ms = 2 detik)
                }
            })
        });
    </script>
@endpush