@extends('layout')

@section('content')


<h1> Product </h1>

<form action="{{url('saveData')}}" method="post" enctype=”multipart/form-data” > 
    {{ csrf_field() }}

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="form-group">
                <label for="Product_name">Name:</label>
                <input type="text" class="form-control"  class="@error('name') is-invalid @enderror"id="product_name" placeholder="Enter product_name" name="name"value="{{ old('name') }}">
                <!--                @if ($errors->has('name'))
                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                    @endif-->
                @error('name')
                <p class="text-danger">{{ $message }}</p>
            </div>
            @enderror
            <div class="form-group">
                <label for="Product_descryption">Description:</label>
                <input type="text" class="form-control" class="@error('description') is-invalid @enderror" id="product_descryption" placeholder="Enter product_descryption" name="description"value="{{ old('description') }}">
                <!--                  @if ($errors->has('description'))
                                        <span class="text-danger">{{ $errors->first('description') }}</span>
                                    @endif-->
                @error('description')
                <p class="text-danger">{{ $message }}</p>
            </div>
            @enderror

            <div class="form-group">
                <label for="Product_price">Price:</label>
                <input type="text" class="form-control" class="@error('price') is-invalid @enderror" id="product_price" placeholder="Enter product_price" name="price"value="{{ old('price') }}">
                <!--                  @if ($errors->has('price'))
                                        <span class="text-danger">{{ $errors->first('price') }}</span>
                                    @endif-->
                @error('price')
                <p class="text-danger">{{ $message }}</p>
            </div>
            @enderror

            <div class="form-group">
                <label class="file"for="image">Image</label>
                <div class="file">
                    <input type="file" class="file-input" class="@error('image') is-invalid @enderror" id="image"id="image" name="image"value="{{ old('image') }}">
                    <!--                      @if ($errors->has('image'))
                                            <span class="text-danger">{{ $errors->first('image') }}</span>
                                        @endif-->
                    @error('image')
                    <p class="text-danger">{{ $message }}</p> 
                </div>
            </div>
            @enderror

            <div class="form-group">
                <label for="product_date">Start Date:</label>
                <input type="date" class="form-control" class="@error('start_date') is-invalid @enderror" id="product_date" placeholder="Enter product_date" name="start_date"value="{{ old('start_date') }}">	
                <!--                  @if ($errors->has('start_date'))
                                        <span class="text-danger">{{ $errors->first('start_date') }}</span>
                                    @endif-->
                @error('start_date')
                <p class="text-danger">{{ $message }}</p>
            </div>
            @enderror
            <div class="form-group">
                <label for="product_end_date">End date:</label>
                <input type="date" class="form-control"class="@error('end_date') is-invalid @enderror" id="product_end_date" placeholder="Enter product_end_date" name="end_date"value="{{ old('end_date') }}">
                <!--                  @if ($errors->has('end_date'))
                                        <span class="text-danger">{{ $errors->first('end_date') }}</span>
                                    @endif-->
                @error('end_date')
                <p class="text-danger">{{ $message }}</p>
            </div>
            @enderror
            <div class="form-group">
                <label for="product_colour">Colour:</label>
                <input type="text" class="form-control" class="@error('colour') is-invalid @enderror" id="product_colour" placeholder="Enter product_colour" name="colour"value="{{ old('end_date')}}">
                <!--                  @if ($errors->has('colour'))
                                        <span class="text-danger">{{ $errors->first('colour') }}</span>
                                    @endif-->
                @error('colour')
                <p class="text-danger">{{ $message }}</p>
            </div>
            @enderror  

            <div class="form-group">
                <label for="category">Select Category:</label>
                <select  class="form-control"  name="category" id="category"class="@error('category') is-invalid @enderror" id="category">
                    <option value=>--- Select Category ---</option>
                    @foreach ($category as $category)
                    <option value="{{  $category['id']}}">{{  $category['name'] }}</option>
                    @endforeach
                </select>
                <!--                  @if ($errors->has('category'))
                                        <span class="text-danger">{{ $errors->first('category') }}</span>
                                    @endif-->
                @error('category')
                <p class="text-danger">{{ $message }}</p>
            </div>
            @enderror  


            <div class="form-group">
                <label for="subcategory">Select Subcategory:</label>
                <select name="subcategory" class="form-control" class="@error('subcategory') is-invalid @enderror" id="subcategory">
                    <option value="">--subcategory--</option>
                </select>

                @error('subcategory')
                <p class="text-danger">{{ $message }}</p>
            </div> 
            @enderror
            <!--                  @if ($errors->has('subcategory'))
                      <span class="text-danger">{{ $errors->first('subcategory') }}</span>
                  @endif-->
            <br>	

            <button type="submit" class="btn btn-success">Submit</button>
            <a class="btn btn-primary" href="{{ url('index') }}"> Back</a>

        </div>
    </div>

</form>
@endsection

<meta charset="utf-8">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script type="text/javascript">

jQuery(document).ready(function ()
{
    jQuery('select[name="category"]').on('change', function () {
        var categoryID = jQuery(this).val();

        if (categoryID)
        {

            // console.log("categoryID ",categoryID);
            jQuery.ajax({
                url: '/subcategory/' + categoryID,
                type: "GET",
                dataType: "json",
                success: function (data)
                {
                    console.log(data);
                    jQuery('select[name="subcategory"]').empty();
                    jQuery.each(data, function (key, value) {
                        console.log(key);
                        console.log(value);
                        $('select[name="subcategory"]').append('<option value="' + value.id + '">' + value.name + '</option>');


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


