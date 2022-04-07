@extends('admin.dashboard')

@section('maincontent')
{{-- session --}}
@if ($message = Session::get('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
  <strong></strong> Colour Added successfully!!
</div>
@endif
{{-- session --}}
<style>
    .error {
        color: #dc3545;
         font-weight: 700;
         display:block;
         padding: 6px 0;
         font-size: 14px;
    }
</style>
<div class="card">
  <div class="card-header"><b>Colour</b>
    <a class="btn btn-default float-right" href="{{ route('colour.index') }}" role="button"><b><i class="fa fa-arrow-circle-left" aria-hidden="true" style="font-size: 23px;"></i></b></a>
  </div>
  <div class="card-body">

      <form action="{{ route('colour.save') }}" id="formc" method="post">
        {!! csrf_field() !!}
            {{-- <label>user_id</label></br>
            <input type="text" name="user_id" id="user_id" class="form-control"></br> --}}
        <label>Colour Name</label></br>
        <input type="text" name="name" id="name" class="form-control" oninput="this.value = this.value.replace(/[^A-za-z_\s]/g, '').replace(/(\..*)\./g, '$1');">
        <span style="color: red">@error('name'){{$message}}@enderror</span></br>
        <!-- <label>status</label>
        <span style="color: red">@error('status'){{$message}}@enderror</span></br>
         <input type="radio" id="html" name="status" value="active">
         <label for="html">Active</label><br>
         <input type="radio" id="css" name="status" value="inactive">
         <label for="css">Inactive</label><br> -->

        <input type="submit" value="Add" class="btn btn-success">
    </form>

  </div>
</div>
@endsection

@push('custom-script')
<script src="{{asset('resources/assets/common/js/jquery.validate.min.js')}}"></script>
<script src="{{asset('resources/assets/common/js/additional-methods.min.js')}}"></script>
<script src="{{asset('resources/assets/admin/plugins/select2/js/select2.min.js')}}." type="text/javascript"></script>
    <script src="{{asset('resources/assets/admin/plugins/bootstrap-select/js/bootstrap-select.js')}}" type="text/javascript"></script>
    <script src="{{asset('resources/assets/admin/plugins/bootstrap-filestyle/js/bootstrap-filestyle.min.js')}}" type="text/javascript"></script>
<script src="{{asset('https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js')}}" ></script>
<script src="{{asset('https://cdnjs.cloudflare.com/ajax/libs/jquery-validation-unobtrusive/3.2.12/jquery.validate.unobtrusive.min.js')}}" ></script>
<script>

    $(document).ready(function(){
        $("#formc").validate({
            ignore: [],
            rules:{
                name:{
                    required:true,
                    minlength:3,
                    maxlength:10,
                    remote: {
                        url: '/admin/colour/uniquename',
                        type: "GET",
                        data: {
                            colourname: function() {
                                return $("#name").val();
                            }
                        },
                    }
                },

            },
            messages:{

            name: {
                required: 'Enter The colour Name',
                remote: "The Name has already been taken !! ",
            },

            },
        });
    });

</script>
@endpush
