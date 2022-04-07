@extends('admin.dashboard')

@section('maincontent')
{{-- session --}}
@if ($message = Session::get('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
  <strong></strong>Colour updated Successfully.
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
  <div class="card-header"><b>EDIT COLOUR PAGE </b>
    <a class="btn btn-default float-right" href="{{ route('colour.index') }}" role="button"><i class="fa fa-arrow-circle-left" aria-hidden="true" style="font-size: 23px;"></i></a><br>
  </div>
  <div class="card-body">

  <form action="{{ url('/admin/colour/update',[$colour->id]) }}" id="formc" method="post" enctype="multipart/form-data">

      {!! csrf_field() !!}
        <label id="error" style="display: none;"></label>
        <label>Colour Name</label><br>
        <input type="text" value="{{ $colour->name }}" name="name" id="product_input_name" class="form-control" oninput="this.value = this.value.replace(/[^A-za-z_\s]/g, '').replace(/(\..*)\./g, '$1');">
        <span style="color: red">@error('name'){{$message}}@enderror</span><br>

        <input type="submit" value="update" class="btn btn-success">
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
                maxlength:'The Name May Not Be Greater Than 10 Characters.',
                remote: "The Name has already been taken !! ",

            },

            },
        });
    });

</script>

@endpush
