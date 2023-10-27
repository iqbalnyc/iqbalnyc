@extends('dashboard.dash-layout')
@section('title', 'Admin Products')

@section('content')
<!-- /. NAV SIDE  -->
<div id="page-inner">
    <div class="row">
        <div class="col-md-12 mb-2">
            <h2 class="text-primary">Products
            <a href="/admin/addProduct" class="text-primary text-decoration-none"><h6>(Add Product)</h6></a></h2>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-6">
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr class="text-primary">
                        <th>#</th>
                        <th>Product Name</th>
                        <th>Product Manufacturer</th>
                        <th>Status</th>
                        <th>Price</th>
                        <th scope="col" colspan="2" class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($products as $product)
                    <tr class="md:table-fixed border-b dark:border-neutral-500">
                        <td class="whitespace-wrap px-3 py-2">{{ $products->firstItem() + $loop->index }}</td>
                        <td class="whitespace-wrap px-3 py-2 w-25" v-if="isEditable">{{ $product->productName }}</td>
                        <td class="whitespace-wrap px-3 py-2">{{ $product->productManu }}</td>
                        <td class="whitespace-wrap px-3 py-2">{{ $product->productStatus }}</td>
                        <td class="whitespace-wrap px-3 py-2">{{ $product->productPrice }}</td>
                        <td class="whitespace-wrap px-3 py-2"><a href="/admin/productsEdit/{{$product->id}}">Edit</a></td>
                        <td class="whitespace-wrap px-3 py-2">
                            <form method="POST" action="/admin/productDestroy/{{$product->id}}">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-link">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <hr />
            <div class="mx-auto text-center">
                 {{ $products->links() }}
            </div>
        </div>
    </div>
    <div class="row">
        
    </div>
    <!-- /. ROW  -->
</div>

@endsection