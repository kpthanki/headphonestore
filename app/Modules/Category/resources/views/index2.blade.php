@extends('admin.dashboard')

@section('maincontent2')
{{-- session --}}
@if ($message = Session::get('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
  <strong></strong> Category Added Successfully!!
</div>
@endif
{{-- session --}}
<style>
    label.error {
         color: #dc3545;
         font-size: 15px;
    }
</style>

<div class="card">
  <div class="card-header"><b>Category</b>
    <a class="btn btn-default float-right" href="{{ route('category.index2') }}" role="button"><b><i class="fa fa-arrow-circle-left" aria-hidden="true" style="font-size: 23px;"></i></b></a></br>
  </div>
  <div class="card-body">
    <form action="{{ route('category.save') }}" method="post" id="form">
      {!! csrf_field() !!}
      {{-- <label>user_id</label></br>
        <input type="text" name="user_id" id="user_id" class="form-control"></br> --}}
        <label>Category Name</label><br>
        <input type="text" name="name" id="name" class="form-control" oninput="this.value = this.value.replace(/[^A-za-z_\s]/g, '').replace(/(\..*)\./g, '$1');">
        <span style="color: red">@error('name'){{$message}}@enderror</span><br>
        <input type="submit" value="Add" class="btn btn-success">
    </form>
  </div>
  </div>
  @endsection

@push('custom-script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js" ></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script type="text/javascript">
        $("#form").validate({
            rules: {
                name: {
                    required: true,
                    minlength:3,
                    remote: {
                        url:"{{ url('/admin/category/uniquename') }}",
                        type: "GET",
                        data: {
                            categoryname: function() {
                                return $("#name").val();
                            }
                        },
                    }
                },
            },
            messages: {
                name: {
                    required: "The Name field is Required!!",
                    remote: "The Name has already been taken !! ",
                }
            },
        });
        </script>
        @endpush
