@extends('layout')


@section('content')
<h2>Edit Product</h2>

<form action="{{url('updateData', $product[0]['id'])}}" method="post"id="edit" enctype=”multipart/form-data”>
    <input type="hidden" name="_method" value="put">
    <input type="hidden" name="sub_cat" id="sub_cat" value="{{ $product[0]['sub_category']? $product[0]['sub_category']:null }}">
    {{ csrf_field() }}
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="form-group">
                <label for="Product_name">Product Name:</label>
                <input type="text" class="form-control"class="@error('name') is-invalid @enderror" value="{{ $product[0]['name']? $product[0]['name']:null }}" id="product_name"  placeholder="Enter product name"name="name">
                <!--                @if ($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif-->
                @error('name')<p class="text-danger">{{ $message }}</p>
            </div>
            @enderror

            <div class="form-group">
                <label for="Product_descryption">Product_description:</label>
                <input type="text" class="form-control "name="description" class="@error('description') is-invalid @enderror" value="{{ $product[0]['description']? $product[0]['description']:null }}"  placeholder="Enter product description">
                <!--                @if ($errors->has('description'))
                                <span class="text-danger">{{ $errors->first('description') }}</span>
                                @endif-->
                @error('description')<p class="text-danger">{{ $message }}</p>
            </div>
            @enderror


            <div class="form-group">
                <label for="Product_price">Product Price:</label>
                <input type="text" class="form-control" name="price"class="@error('price') is-invalid @enderror" value="{{ $product[0]['price']? $product[0]['price']:null }}"  placeholder= "Enter product price" >
                <!--                @if ($errors->has('price'))
                                <span class="text-danger">{{ $errors->first('price') }}</span>
                                @endif-->
                @error('price')<p class="text-danger">{{ $message }}</p>
            </div>
            @enderror

            <div class="form-group">
                <div id="removeProfile">
                    <label for="Product_image">Product Image:</label>
                        @if(isset($product[0]['image']))<img src="{{URL::asset('uploads/employee/'. $product[0]['image'])}}" height="50px" width="50px" alt="image">
                    <button id="remove" class="btn btn-danger">remove</button>
                </div>
                @endif
                <div id="uploadfile"  style="display:none">
                    <input type="file" class="form-control" name="image"class="@error('image') is-invalid @enderror" value="{{$product[0]['image']}}"  placeholder="Enter product image">
                </div>
                @error('imagedata')<p class="text-danger">{{ $message }}</p>
            </div>
            @enderror

            <div class="form-group">
                <strong>Start Date:</strong>
                <input type="date" class="form-control" name="start_date"class="@error('start_date') is-invalid @enderror" value="{{ $product[0]['start_date']? $product[0]['start_date']:null }}"  placeholder="Enter product Start Date">
                @error('start_date')<p class="text-danger">{{ $message }}</p>
            </div>
            @enderror


            <div class="form-group">
                <strong>End Date:</strong>
                <input type="date" class="form-control" name="end_date"class="@error('end_date') is-invalid @enderror" value="{{ $product[0]['end_date']? $product[0]['end_date']:null }}" placeholder="Enter product End Date">
                <!--                @if ($errors->has('end_date'))
                                <span class="text-danger">{{ $errors->first('end_date') }}</span>
                                @endif-->
                @error('end_date')<p class="text-danger">{{ $message }}</p>
            </div>
            @enderror

            <div class="form-group">
                <strong>Colour:</strong>
                <input type="text"class="form-control" name="colour"class="@error('colour') is-invalid @enderror" value="{{ $product[0]['colour']? $product[0]['colour']:null }}" placeholder="Enter product colour" >
                <!--                @if ($errors->has('colour'))
                                <span class="text-danger">{{ $errors->first('colour') }}</span>
                                @endif-->
                @error('colour')
                <p class="text-danger">{{ $message }}</p>
            </div>
            @enderror

            <div class="form-group">
                <label for="category">Select Category:</label>
                <select name="category" class="form-control" id="category" name="category"class="@error('colour') is-invalid @enderror">
                    <option value=>select category</option>
                    @foreach ($category as $categories)
                    <option value="{{ $categories->id }}" {{  $categories->id === $product[0]['category'] ? 'selected=selected' : '' }}>{{$categories->name }}</option>
                    @endforeach
                </select>
                @if ($errors->has('category'))
                <span class="text-danger">{{ $errors->first('category') }}</span>
                @endif
                @error('category')
                <p class="text-danger">{{ $message }}</p>
            </div>
            @enderror


            <div class="form-group">
                <label for="subcategory">Select Subcategory:</label>
                <select name="subcategory" class="form-control" id="subcategory"name="subcategory"class="@error('subcategory') is-invalid @enderror">
                    <option value=>select subcategory</option>
                    @foreach ($sub_category as $subCategories)
                    <option value="{{ $subCategories->id }}" {{  $subCategories->id === $product[0]['sub_category'] ? 'selected=selected' : '' }}>{{$subCategories->name }}</option>
                    @endforeach
                </select>
                @if ($errors->has('subcategory'))
                <span class="text-danger">{{ $errors->first('subcategory') }}</span>
                @endif
                @error('subcategory')
                <p class="text-danger">{{ $message }}</p>
            </div>
            @enderror

            <br>
            <input type="hidden" id="imagedata" name="imagedata" value="{{$product[0]['image']}}">
            <button type="submit" id="submit" class="btn btn-success">Submit</button>
            <a class="btn btn-primary" href="{{ url('index') }}"> Back</a>

        </div>
    </div>
</form>
@endsection

<meta charset="utf-8">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script type="text/javascript">

$(document).ready(function () {
    $("#uploadfile").hide();
    $("#remove").click(function (e) {
        e.preventDefault();
        // $("#submit")[0].reset();
        $("#imagedata").val('');
        $("#removeProfile").hide();
        $("#uploadfile").show();
    });
});


jQuery(window).load(function () {
    jQuery('#category_name').trigger('change');
});
jQuery(document).ready(function ()
{
    jQuery('select[name="category"]').on('change', function () {
        //console.log("hi");
        var categoryID = jQuery(this).val();
        var subcategory = jQuery("#sub_cat").val();
        if (categoryID)
        {
            // console.log("categoryID ",categoryID);
            jQuery.ajax({
                url: '/subcategory/' + categoryID,
                type: "GET",
                dataType: "json",
                success: function (data)
                {

                    //console.log(data);
                    var selected = "";
                    jQuery('select[name="subcategory"]').empty();

                    jQuery.each(data, function (key, value) {

                        if (value.id == subcategory) {
                            selected = "selected";
                        } else {
                            selected = "";
                        }
                        $('select[name="subcategory"]').append('<option ' + selected + ' value="' + value.id + '">' + value.name + '</option>');
                    });
                }
            });
        } else
        {

            $('select[name="subcategory"]').empty();
        }
    });

});
</script>