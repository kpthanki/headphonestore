@extends('admin.dashboard')

@section('maincontent')
{{-- session --}}
@if ($message = Session::get('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
  <strong></strong>Category updated Successfully.
</div>
@endif
{{-- session --}}

<div class="card">
  <div class="card-header"><b>EDIT CATEGORY</b>
    <a class="btn btn-default float-right" href="{{ route('category.index2') }}" role="button"><i class="fa fa-arrow-circle-left" aria-hidden="true" style="font-size: 23px;"></i></a>
  </div>
  <div class="card-body">
    <form action="{{ url('/admin/category/update',[$category->id]) }}" method="post" enctype="multipart/form-data" name="formc">
        {!! csrf_field() !!}
        <label id="error" style="display: none;"></label>
        <label>Category Name</label><br>
        <input type="text" value="{{ $category->name }}" name="name" id="product_input_name" class="form-control" oninput="this.value = this.value.replace(/[^A-za-z_\s]/g, '').replace(/(\..*)\./g, '$1');">
        <span style="color: red">@error('name'){{$message}}@enderror</span></br>
        <input type="submit" value="Upadte" class="btn btn-success">
    </form>
</div>
</div>
@endsection

@push('custom-script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js" ></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script type="text/javascript">
        $("#formc").validate({
            rules: {
                name: {
                    required: true,
                    minlength:3,
                },
            },
            messages: {
                name: {
                    required: "The Name field is Required!!",
                }
            },
        });
        </script>
        @endpush
