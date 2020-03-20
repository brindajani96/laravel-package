@extends('layout')


@section('content')
<div class="container">
    <div class="row">

        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Product</h2>
            </div>
        </div>

        <div class="pull-left">
            <a  href="{{ url('add') }}" >
                <span class="glyphicon glyphicon-plus"></span>
            </a>
        </div>

        <div class="pull-right">
            <a class="dropdown-item" href="{{ route('logout') }}"
               onclick="event.preventDefault();
                         document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
               </a> 
            
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
                
        </div>

    </div>
</div> 

<table class="table table-bordered">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Description</th>
        <th>Image</th>
        <th>Price</th>
        <th>Colour</th>
        <th>Start Date</th>
        <th>End Date</th>
        <th>Category</th>
        <th>SubCategory </th>
        <th>Action</th>
        
    </tr>
    
    @foreach ($productcurd as $index => $product)

    <tr>
        <td>{{ $index + $productcurd->firstItem()  }}</td>
        <td>{{ $product->name }}</td>
        <td>{{ $product->description }}</td>
        <td><img src="{{URL::asset('uploads/employee/'.$product->image)}}" height="50px" width="50px" alt="image"></td>
       
        <td>{{ $product->price }}</td>
        <td>{{ $product->colour }}</td>
        <td>{{ $product->start_date }}</td>
        <td>{{ $product->end_date }}</td>
        <td>{{ $product->category_name}}</td>
        <td>{{ $product->subcategory_name}}</td>

        <td>
            <a href= "{{URL('/edit', $product->id) }}" class="edit" title=""
               data-toggle="tooltip" data-original-title="Edit" style="display: inline-block;"><i
                    class="material-icons"></i></a>
            {{csrf_field()}}
            <a href="{{URL::to('/delete/'.$product->id)}}" class="delete" title=""
               data-toggle="tooltip" data-original-title="delete"><i class="material-icons"></i></a>
            @csrf
            @method('DELETE')


        </td>

    </tr>
    @endforeach
</table>
@forelse($productcurd as $product)
@empty
@endforelse
{{ $productcurd->links() }};
@endsection


