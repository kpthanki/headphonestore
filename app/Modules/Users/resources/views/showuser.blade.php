@extends('admin.dashboard')
@section('maincontent')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"> </h3>
            <h3 class="card-title"><b>Oreders</b>
            </h3>
        </div>

        <div class="card-body">
            <!-- /.card-header -->
            <table id="myTable" class="display table table-bordered table-striped">
                <thead>
                    <tr>
                        <th> Id </th>
                        <th> Nmae </th>
                        <th>User Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Register Date</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($user as $item)
                        <tr>
                            <td>{{ $item->id}}</td>
                            <td>{{ $item->name}}</td>
                            <td>{{ $item->username}}</td>
                            <td>{{ $item->email}}</td>
                            <td>{{ $item->role}}</td>
                            <td>{{ $item->created_at}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('custom-script')
    {{-- <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap-switch-button@1.1.0/dist/bootstrap-switch-button.min.js"></script> --}}
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables/jquery.jquery.dataTables.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('.card-body #myTable').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "responsive": true,
                "autoWidth": true,
            });
        });
    </script>
    @endpush

</body>

</html>
