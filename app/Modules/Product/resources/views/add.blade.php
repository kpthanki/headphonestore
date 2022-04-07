@extends('admin.dashboard')

@section('maincontent')
{{-- session --}}
@if ($message = Session::get('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
  <strong></strong>Product Added Successfully.
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
  <div class="card-header"><b>PRODUCT</b>
    <a class="btn btn-default float-right" href="{{ route('product.index') }}" role="button"><i class="fa fa-arrow-circle-left" aria-hidden="true" style="font-size: 23px;"></i></a>
  </div>
  <div class="card-body">

      <form action="{{ route('product.save') }}" method="post"  id="form" name="add_product" enctype="multipart/form-data">
        {!! csrf_field() !!}
        <label id="error" style="display: none;"></label>
        <label>Product Name <span class="text-danger">*</span> </label><br>
        <input type="text" name="name" id="product_input_name" class="form-control">
        <span style="color: red">@error('name'){{$message}}@enderror</span></br>


        <br><label>URL</label></br>
        <input type="text" name="url" id="product_input_url" class="form-control" value="" >


        <br><label>Category <span class="text-danger">*</span> </label><br>
        <select class="form-select form-control" aria-label="select" name="category" id="category">
            <option value="">Select Category</option>
            @foreach ($category as $item )
            <option value="{{$item ->id}}">{{$item ->name}}</option>
            @endforeach
        </select>
        <span style="color: red">@error('category'){{$message}}@enderror</span></br>


        <br><label>Colour <span class="text-danger">*</span> </label><br>
        {{-- <input type="text" name="colour" id="colour" class="form-control"> --}}
        <select class="form-select form-control" aria-label="select" name="colour" id="colour">
            <option value="">Select Colour</option>
            @foreach ($colour as $item )
            <option value="{{$item ->id}}">{{$item ->name}}</option>
            @endforeach
        </select>
        <span style="color: red">@error('colour'){{$message}}@enderror</span></br>


        <br><label>UPC Code <span class="text-danger">*</span> </label><br>
        <input type="number" name="upc" id="upc" class="form-control">
        <span style="color: red">@error('upc'){{$message}}@enderror</span><br>


        <br><label>Product Description</label><br>
        <textarea name="Description" id="Description" class="form-control"></textarea>
        <span style="color: red">@error('discription'){{$message}}@enderror</span><br>


        <br><label>Price <span class="text-danger">*</span> </label><br>
        <input type="number" name="price" id="price" class="form-control">
        <span style="color: red">@error('price'){{$message}}@enderror</span><br>


        <br><label>Stock <span class="text-danger">*</span> </label><br>
        <input type="number" name="stock" id="stock" class="form-control">
        <span style="color: red">@error('stock'){{$message}}@enderror</span><br>


        <br><label>Product Image <span class="text-danger">*</span> </label><br>
        <input type="file" name="image" id="image"class="form-control"><br>
        <span style="color: red">@error('image'){{$message}}@enderror</span><br>

        <div class="multiple_img_list pb-3">
            <label>Select Multiple Images</label>
            <div class="more_img">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <input type="file" name="subimage[]" id="subimage" class="form-control" enctype="multipart/form-data" data-iconname="fa fa-cloud-upload" data-buttonname="btn-secondary" accept="image/*"/>

                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <input class="form-control " name="sort[]" type="text" id="sort" enctype="multipart/form-data" maxlength="2" r placeholder="Sort Number">

                        </div>
                    </div>
                    <div class="col-md-4">
                        <button name="add_img"  type="button" class="btn btn-outline-primary add_img">
                            <i class="fa fa-plus" aria-hidden="true"></i>
                        </button>
                        <button  name="remove_img" style="display: none" id="remove_img" type="button" class="btn btn-outline-warning remove_img">
                            <i class="fa fa-minus" aria-hidden="true"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>



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



    $(document).ready(function () {
        $('#product_input_name').change(function (e) {
            e.preventDefault();
    //         var str = $('#product_input_name').val();
    //     if(str == ""){
    // // console.log("contains spaces");
    //         // alert('hello');
    //     }
        var url = '' ;
        let text1 =   $(this).val();
        let text2 = text1.split(" ").join("");
        url += text2;
        console.log(url);
        $('#product_input_url').val(`${url}`);

        });
    });




    $('.multiple_img_list').on('click','.add_img',function () {
                $(this).closest('.more_img').clone().find('input').val('').end().insertAfter($(this).closest('.more_img'));
                if ($(".multiple_img_list >div").length != 1){
                    $('.remove_img').show();
                }
            });
            $('.multiple_img_list').on('click','#remove_img',function () {
                if ($(".multiple_img_list >div").length > 1){
                    $(this).closest('.more_img').remove();
                }
                if ($(".multiple_img_list >div").length == 1){
                    $('.remove_img').hide();
                }
            });

            //sort textbox
            $('.multiple_img_list').on('keypress','#sort',function (e) {
                var keyCode = e.charCode;
                if ( (keyCode != 8 || keyCode ==32 ) && (keyCode < 48 || keyCode > 57)) {
                    return false;
                }
            });



        $(document).ready(function(){
        $("#form").validate({
            ignore: [],
            rules:{
                name:{
                    required:true,
                    maxlength:50,
                },

                category:{
                    required:true,
                },
                colour:{
                    required:true,
                },
                upc:{
                    required:true,
                    maxlength:12,
                },
                Description:{
                    maxlength:500,
                },
                price:{
                    required:true,
                    maxlength:6
                    },
                subimage:{
                    required:true,
                    },
                sort:{
                    required:true,
                    maxlength:2
                    },
                stock:{
                    required:true,
                    maxlength:6,
                },
                image:{
                    required:true,
                },
            },
            messages:{
                category: {
                required: ' Choose Category'
            },
            colour: {
                required: ' Choose Colour'
            },
            upc: {
                required: ' Enter The UPC Code',
                maxlength:'The UPC May Not Be Greater Than 12 Digit.',
            },
            name: {
                required: 'Enter The Product Name',
                maxlength:'The Name May Not Be Greater Than 50 Characters.'
            },
            discription:{
                maxlength:'The Description May Not Be Greater Than 500 Characters.'
            },
            price: {
                required: ' Enter The Price',
                maxlength: 'Price Should Not Be Greaterthan 6 Digit'
            },
            subimage: {
                required: ' Enter The image',

            },
            sort: {
                required: ' Enter The sorting number',
                maxlength: 'sort Should Not Be Greaterthan 2 Digit'
            },

            stock:{
                required:' Enter The Stock',
                maxlength:'The Stock May Not Be Greater Than 6 Digit.'
            },
            image:{
                required:' Select Image'
            }
            },
        });
    });


</script>
@endpush
