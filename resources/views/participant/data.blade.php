<div class="row">
    <div class="col-md-12 table-responsive">
        <table class="table table-striped table-bordered" id="table" style="width:100%;">
            <thead>
                <tr>
                    <th>No</th>
                    <th>User Name</th>
                    <th>User Type</th>
                    <th style="text-align:center">Photo</th>
                    <th style="text-align:center">Phone Number</th>
                    <th style="text-align:center">Address</th>
                    <th style="text-align:center">Unique Code</th>
                    <th style="text-align:center">Change Password</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($participants as $index => $participant)
                    <tr>
                        <td>{{ $index+1 }}</td>
                        <td>{{ $participant->name }}</td>
                        <td>{{ $participant->roles->first()->name }}</td>
                        <td>
                            <img src="{{ asset('storage/' . $participant->photo) }}" style="width: 80px; height:auto" class="user-image rounded" alt="User Image">
                        </td>
                        <td>{{ $participant->phone_number }}</td>
                        <td>{{ $participant->address }}</td>
                        <td>{{ $participant->unique_code }}</td>
                        <td class="text-center">
                            <a class="btn btn-info btn-sm" onclick="updatePassword({{ $participant->id }})"><i class="fa fa-key"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @include('participant._form_update_password')
    </div>
</div>

@push('scripts')
    <script>
        function updatePassword(id) {
            $('#updatePassword').modal('show');
            $('#id_password').val(id);
        }
    </script>
@endpush