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
                        <th> Ordered By </th>
                        <th>Order Date</th>
                        <th>Total Price</th>
                        <th> Payment Method </th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($order as $item)
                        <tr>
                            <td>{{ $item->Id}}</td>
                            <td>{{ $item->user->name}}</td>
                            <td>{{ $item->created_at}}</td>
                            <td>{{ $item->total_price}}</td>
                            <td>{{ $item->payment_id}}</td>
                            <td>{{ $item->order_status}}</td>
                            <td>
                                <div style="text-align: center;">
                                    <a href="{{ url('/admin/edit',[$item->Id]) }}" class="edit"><i class="fas fa-pencil-alt"></i></a>
                                    &nbsp;
                                    <a href="{{ url('/admin/invoice',[$item->Id]) }}">
                                    <i class="fas fa-eye"></i></a>
                                </div>
                            </td>
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
