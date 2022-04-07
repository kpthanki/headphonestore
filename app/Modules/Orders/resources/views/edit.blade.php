@extends('admin.dashboard')

@section('maincontent')
{{-- session --}}
@if ($message = Session::get('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
  <strong></strong>Status updated Successfully.
</div>
@endif
{{-- session --}}

<div class="card">
  <div class="card-header"><b>EDIT ORDERS PAGE </b>
  </div>
  <div class="card-body">

  <form action="{{ url('/admin/update',[$order->Id]) }}" id="formc" method="post" enctype="multipart/form-data">

      {!! csrf_field() !!}
      <br><label>Order Status<span class="text-danger">*</span> </label><br>
      <select class="form-select form-control" aria-label="select" name="order_status" id="order_status">
          <option selected>Select Status</option>
          <option value="Delivered">Delivered</option>
          <option value="On The Way">On The Way</option>
          <option value="pending">pending</option>
      </select>
      <br>
    <input type="submit" value="update" class="btn btn-success">
    </form>

  </div>
</div>
@endsection
