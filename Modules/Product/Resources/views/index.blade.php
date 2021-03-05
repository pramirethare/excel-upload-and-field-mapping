@extends('product::layouts.master')

@section('content')
    <div class="container">
        <h2>Product List</h2>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Quantity</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td>{{ $product->title }}</td>
                        <td>
                            @foreach ($product->categories()->get() as $category)
                                {{ $category->title }}
                            @endforeach
                        </td>
                        <td>{{ $product->description }}</td>
                        <td>{{ $product->price }}</td>
                        <td>{{ $product->quantity }}</td>
                    </tr>    
                @endforeach
                
            </tbody>
        </table>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                {{ $products->links() }}
            </div>
        </div>
    </div>
@endsection
