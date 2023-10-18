<!-- Modal Hapus-->
<div class="modal fade" id="modalverification" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action=" {{ route('awaiting.verify') }} " method="POST">
                {{ csrf_field() }} {{ method_field('PATCH') }}
                <div class="modal-header">
                    <p style="font-size:15px; font-weight:bold;" class="modal-title">Confirmation Form To Verification
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </p>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-12">
                            <input type="hidden" name="id" id="id_verification">
                            <label for="">Verification Status</label>
                            <select name="verification" id="" class="form-control" required>
                                <option value="accepted">Accept</option>
                                <option value="rejected">Reject</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-sm " data-dismiss="modal"><i class="fa fa-close"></i>&nbsp; Cancel</button>
                    <button type="submit" class="btn btn-primary btn-sm "><i class="fa fa-check-circle"></i>&nbsp; Verify</button>
                </div>
            </form>
        </div>
    </div>
</div>