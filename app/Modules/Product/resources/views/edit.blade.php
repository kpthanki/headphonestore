@extends('admin.dashboard')

@section('maincontent')
{{-- session --}}
@if ($message = Session::get('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
  <strong></strong>Product updated Successfully.
</div>
@endif
{{-- session --}}

<div class="card">
  <div class="card-header"><b>EDIT PRODUCT PAGE</b>
    <a class="btn btn-default float-right" href="{{ route('product.index') }}" role="button"><i class="fa fa-arrow-circle-left" aria-hidden="true" style="font-size: 23px;"></i></a>
  </div>
  <div class="card-body">

  <form action="{{ url('/admin/product/update',[$product->id]) }}" method="post" enctype="multipart/form-data">

      {!! csrf_field() !!}
        <lable id="error" style="display: none;"></lable>
        <label>Product Name</label></br>
        <input type="text" value="{{ $product->name }}" name="name" id="product_input_name" class="form-control" >
        <span style="color: red">@error('name'){{$message}}@enderror</span></br>

        <label>URL</label></br>
        <input type="text" value="{{ $product->url }}" name="url" id="product_input_url" class="form-control" value="" readonly>
        <span style="color: red">@error('url'){{$message}}@enderror</span></br>

        <label>Category</label></br>
        <select class="form-select form-control">
            <option value="">{{$product->category->name}}</option>
        </select>
        <span style="color: red">@error('category'){{$message}}@enderror</span></br>

        <label>Colour</label></br>
        {{-- <input type="text" name="colour" id="colour" class="form-control"> --}}
        <select class="form-select form-control" >
            <option value="">{{$product->colour->name}}</option>
        </select>
        <span style="color: red">@error('colour'){{$message}}@enderror</span></br>

        <label>UPC Code</label></br>
        <input type="text"  value="{{ $product->upc }}" name="upc" id="upc" class="form-control" readonly="">
        <span style="color: red">@error('upc'){{$message}}@enderror</span></br>

        <label>Product Description</label></br>
        <textarea name="Description"   id="Description" class="form-control"> {{ $product->discription }}</textarea>
        <span style="color: red">@error('discription'){{$message}}@enderror</span></br>

        <label>Price</label></br>
        <input type="number"  value="{{ $product->price }}" name="price" id="price" class="form-control">
        <span style="color: red">@error('price'){{$message}}@enderror</span></br>

        <label>Stock</label></br>
        <input type="number"   value="{{ $product->stock }}" name="stock" id="stock" class="form-control">
        <span style="color: red">@error('stock'){{$message}}@enderror</span></br>


        <label> Main Product Image</label></br>
        <input type="file" name="image" id="image" class="form-control">
        <span style="color: red">@error('image'){{$message}}@enderror</span></br>
        <img src="{{ asset('uploads/products/'.$product->image) }}" width="150px" height="100px" alt="image"><br><br>

        <div class="multiple_img_list pb-3">
            <p>Select Multiple Images</p>
            @foreach($images as $image)
                <div class="more_img">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="row">
                                <div class="col-md-10">
                                    <div class="form-group">
                                        <input type="file" name="sub_img[]"  onchange="readURLSubimg(this);"  class="form-control moreImgInp @error('sub_img') is-invalid @enderror" data-iconname="fa fa-cloud-upload" data-buttonname="btn-secondary" accept="image/*"/>
                                        <input class="form-control" value="{{$image->id}}" name="img_id[]" type="hidden">

                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <img alt="img" src="{{ url('uploads/products/' . $image->image) }}" width="80px" height="100px" id="img" class="img-thumbnail">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <input class="form-control" value="{{$image->sort}}" name="sort[]" type="text" id="sort" maxlength="2" onkeypress="if(this.value.length==2);" placeholder="Sort Number" id="{{$image->id}}">

                            </div>
                        </div>
                        <div class="col-md-4">
                            <button name="add_img" id="add_img" type="button" class="btn btn-outline-primary add_img">
                                <i class="fa fa-plus" aria-hidden="true"></i>
                            </button>
                            <button name="remove_img" id="{{$image->id}}" type="button" class="btn btn-outline-warning remove_img">
                                <i class="fa fa-minus" aria-hidden="true"></i>
                            </button>

                        </div>
                    </div>
                </div>
            @endforeach
            <div class="more_img" style="display:none">
                <div class="row">
                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <input type="file" name="sub_img[]"  class="form-control @error('sub_img') is-invalid @enderror" data-iconname="fa fa-cloud-upload" data-buttonname="btn-secondary" accept="image/*"/>

                                </div>
                            </div>
                            <div class="col-md-2">
                                <img alt="Product Image" id="sub_image" class="img-thumbnail sub_image">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <input class="form-control @error('sort') is-invalid @enderror" value="" name="sort[]" type="text" id="sort" maxlength="2" onkeypress="if(this.value.length==2);" placeholder="Sort Number">

                        </div>
                    </div>
                    <div class="col-md-4">
                        <button name="add_img" id="add_img" type="button" class="btn btn-outline-primary add_img">
                            <i class="fa fa-plus" aria-hidden="true"></i>
                        </button>
                        <button name="remove_img"  id="remove_img" type="button" class="btn btn-outline-warning remove_img" style="display: none">
                            <i class="fa fa-minus" aria-hidden="true"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>





        <input type="submit" value="upadte" class="btn btn-success">
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
    <script class="jsbin" src="{{asset('resources/assets/common/js/jquery-ui.min.js')}}"></script>
<script>


    $(document).ready(function () {

        $('#product_input_name').change(function (e) {
            e.preventDefault();
            var str = $('#product_input_name').val();
        if(str == ""){
    // console.log("contains spaces");
            // alert('hello');

        }
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



</script>

@endpush
