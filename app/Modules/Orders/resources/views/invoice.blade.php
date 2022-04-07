@extends('admin.dashboard')
@section('maincontent')
    <div class="row">
        <div class="col-12">
            <!-- Main content -->
            <div class="invoice p-3 mb-3">
                <!-- title row -->
                <div class="row">
                    <div class="col-12">
                        <h4>
                            <i class="fas fa-globe"></i>HEADPHONES STORE
                        </h4>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- info row -->
                <div class="row invoice-info">
                    <div class="col-sm-4 invoice-col">
                        <address>
                            @foreach ($order as $col)
                                <strong>Billing Address</strong><br>
                                {{ $col->billing_address->address }}<br>
                                {{ $col->billing_address->city }}
                                {{ $col->billing_address->state }}<br>
                                Phone: {{ $col->billing_address->mobile_number }}<br>
                                Email: {{ $col->billing_address->email }}
                        </address>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-4 invoice-col">
                        <address>
                            <strong>Shipping Address</strong><br>
                            {{ $col->shipping_address->address }}<br>
                            {{ $col->shipping_address->city }}
                            {{ $col->shipping_address->state }}<br>
                            Phone: {{ $col->shipping_address->mobile_number }}<br>
                            Email: {{ $col->shipping_address->email }}
                        </address>
                    </div>

                    <!-- /.col -->
                    <div class="col-sm-4 invoice-col">
                        <b>Order ID:</b> {{ $col->Id }}<br>
                        <b>Method:</b> Cash On delivery<br>
                    </div>
                    <!-- /.col -->

                </div>
                <!-- /.row -->

                <!-- Table row -->
                <div class="row">
                    <div class="col-12 table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Product Name </th>
                                    <th>Image</th>
                                    <th>Qty</th>
                                    <th>Price</th>
                                    <th>UPC Code</th>
                                    <th>Order Date</th>
                                </tr>
                            </thead>
                            @foreach ($order_detail as $prod)
                                <tbody>
                                    <tr>
                                        <td>{{ $prod->product->name }}</td>
                                        <td><img src="{{ asset('uploads/products/' . $prod->product->image) }}"
                                                width="90px" height="70px" alt="image"></td>
                                        <td>{{ $prod->qty }}</td>
                                        <td>{{ $prod->total_price }}</td>
                                        <td>{{ $prod->product->upc }}</td>
                                        <td>{{ $prod->created_at }}</td>
                                    </tr>
                                </tbody>
                            @endforeach
                        </table>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
                @endforeach
                <!-- this row will not appear when printing -->
                <div class="row no-print">
                    <div class="col-12">
                        <button type="button" class="btn btn-primary" style="float: right;" onclick="window.print()">
                            <i class="fas fa-download"></i> Generate PDF
                        </button>
                    </div>
                </div>
            </div>
            <!-- /.invoice -->
        </div><!-- /.col -->
    </div><!-- /.row -->
    </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    </div>
    <!-- ./wrapper -->
@endsection
