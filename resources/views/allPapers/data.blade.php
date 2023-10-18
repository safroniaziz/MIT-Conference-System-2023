<div class="row">
    <div class="col-md-12 table-responsive">
        <table class="table table-striped table-bordered" id="table" style="width:100%;">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Abstract Title</th>
                    <th style="text-align:center">Paper File</th>
                    <th style="text-align:center">Presentation File</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($papers as $index => $paper)
                    <tr>
                        <td>{{ $index+1 }}</td>
                        <td>{{ $paper->title }}</td>
                        <td class="text-center">
                            <a href="{{ route('paper.downloadPaper',[$paper->abstrakPaper->id]) }}" ><i class="fa fa-download"></i>&nbsp; Download</a>
                        </td>
                        <td class="text-center">
                            <a href="{{ route('paper.downloadPresentation',[$paper->abstrakPaper->id]) }}" ><i class="fa fa-download"></i>&nbsp; Download</a>
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