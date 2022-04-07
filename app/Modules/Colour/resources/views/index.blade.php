@extends('admin.dashboard')

@section('maincontent')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"> </h3>
            <h3 class="card-title"><b>Colour</b></h3>
            <a class="btn btn-danger float-right" href="{{ route('colour.showtrash') }}" role="button"><i class="fa fa-trash" aria-hidden="true"></i>Trash</a>
            <a class="btn btn-success float-right" href="{{ route('colour.add') }}" role="button"><i class="fa fa-plus" aria-hidden="true"></i>Add</a>
        </div>

        <div class="card-body">
            <!-- /.card-header -->
            <table id="myTable" class="display table table-bordered table-striped">
                <thead>
                    <tr>
                        <th> Id </th>
                        <th>Colour Name</th>
                        <th>Status</th>
                        <th>Action</th>
                        <th> Updated Date</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($colour as $col)
                        <tr>
                            <td>{{ $col->id }}</td>
                            <td id="name-{{ $col->id }}">{{ $col->name }}</td>
                            <td>
                                <label class="switch">
                                    <input type="checkbox" data-id="{{ $col->id }}" class="toggle-class"
                                        {{ $col->status ? 'checked' : '' }}>
                                    <div class="slider round"></div>
                                </label>
                            </td>
                            <td>
                                <div>
                                    <a href="{{ url('/admin/colour/edit', [$col->id]) }}" class="edit"><i
                                            class="fas fa-pencil-alt"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;
                                    <a href="{{ route('colour.index') }}" class="delete"
                                        data-id="{{ $col->id }}"><i class="fas fa-trash-alt"></i> </a>
                                </div>
                            </td>
                            <td>{{ $col->updated_at }}</td>
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
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

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

            $('.editdata').click(function(e) {
                e.preventDefault();
                var id = $(this).attr('data-id');
                var name = $(this).attr('name');

                $(`#name-${id}`).html('');
                $(`#name-${id}`).append(`<input type="text" name="name" id="nametxt" value=${name} >`);


                $('#nametxt').focusout(function(e) {
                    console.log('id', id);
                    var newname = $(this).val();
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "POST",
                        // dataType: "json",
                        url: '/admin/colour/changename',
                        data: {
                            'name': newname,
                            'id': id
                        },
                        success: function(response) {
                            console.log('success', response);
                            $('#nametxt').remove();
                            $(`#name-${id}`).append(`${newname}`);
                        }
                    });
                });

            });


            $('table .delete').click(function(e) {
                e.preventDefault();
                var id = $(this).attr('data-id');


                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "POST",
                    url: "/admin/colour/deletecolour",
                    data: {
                        'id': id,
                    },

                    success: function(response) {
                        console.log('response', response);
                        window.location.reload();
                    }
                });
            });


            $('.toggle-class').change(function() {
                var status = $(this).prop('checked') == true ? 1 : 0;

                var id = $(this).attr('data-id');
                console.log(status);
                console.log('id', id);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",

                    url: '/admin/colour/changestatus',
                    data: {
                        'status': status,
                        'id': id
                    },
                    success: function(data) {}
                });
            });

        });
    </script>
    <style>
        .switch {
            position: relative;
            display: inline-block;
            width: 40px;
            height: 24px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: .4s;
            transition: .4s;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 17px;
            width: 17px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
        }

        input:checked+.slider {
            background-color: #2196F3;
        }

        input:focus+.slider {
            box-shadow: 0 0 1px #2196F3;
        }

        input:checked+.slider:before {
            -webkit-transform: translateX(15px);
            -ms-transform: translateX(15px);
            transform: translateX(15px);
        }

        /* Rounded sliders */
        .slider.round {
            border-radius: 20px;
        }

        .slider.round:before {
            border-radius: 50%;
        }

    </style>
@endpush

</body>

</html>
