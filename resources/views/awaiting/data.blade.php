<div class="row">
    <div class="col-md-12 table-responsive">
        <table class="table table-striped table-bordered" id="table" style="width:100%;">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Abstract Title</th>
                    <th>Abstract Text</th>
                    <th style="text-align:center">Abstract File</th>
                    <th style="text-align:center">Verification</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($submissions as $index => $submission)
                    <tr>
                        <td>{{ $index+1 }}</td>
                        <td style="width:25%">
                            {!! $submission->shortTitle !!}
                            <a href="{{ route('awaiting.readMore',[$submission->id]) }}" id="selengkapnya">read more</a>
                            <br>
                            <hr style="margin-bottom:5px !important; margin-top:5px !important;">
                            <small style="font-size:10px !important; text-transform:capitalize;" class="label label-primary">{{ $submission->user->name }}</small>
                            <small style="font-size:10px !important;" class="label label-success">{{ $submission->created_at ? $submission->created_at->diffForHumans() : '-' }}</small>
                            <small style="font-size:10px !important;" class="label label-info">{{ \Carbon\Carbon::parse($submission->created_at)->format('j F Y H:i') }}</small> <br>
                        </td>
                        <td style="width:25%">
                            {!! $submission->shortAbstrak !!}
                            <a href="{{ route('awaiting.readMore',[$submission->id]) }}" id="selengkapnya">read more</a>
                        </td>
                        <td class="text-center">
                            <a href="{{ route('abstrak.download',[$submission->id]) }}" ><i class="fa fa-download"></i>&nbsp; Download</a>
                        </td>
                        <td style="text-align:center">
                            <a onclick="verification({{ $submission->id }})" class="btn btn-success btn-sm btn-flat" style="color:white; cursor:pointer;"><i class="fa fa-check-circle"></i>&nbsp; Verify</a>
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