<div class="row">
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
                                        <form action="{{ route('paper.destroy',[$paper->abstrakPaper->id]) }}" method="POST">
                                            @csrf @method('DELETE')
                                            @if ($paper->abstrakPaper->status == "pending")
                                                <button type="submit" class="btn btn-danger btn-sm btn-flat"><i class="fa fa-undo"></i>&nbsp; Reset & Create New</button>
                                            @else
                                                <a class="btn btn-danger btn-sm btn-flat disabled" style="cursor: pointer"><i class="fa fa-undo"></i>&nbsp; Reset & Create New</a>
                                            @endif
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <th>Peper File</th>
                    <td> : </td>
                    <td>
                        <table>
                            <tr>
                                <td>
                                    <div>
                                        <a href="{{ route('paper.downloadPaper',[$paper->abstrakPaper->id]) }}" ><i class="fa fa-download"></i>&nbsp; {{ $paper->file_name }}</a>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <th>Presentation File</th>
                    <td> : </td>
                    <td>
                        <table>
                            <tr>
                                <td>
                                    <div>
                                        <a href="{{ route('paper.downloadPresentation',[$paper->abstrakPaper->id]) }}" ><i class="fa fa-download"></i>&nbsp; {{ $paper->file_name }}</a>
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