@extends('components.app-layout')
@section('title', 'Products')

@section('content')

@props(['countCart'])
@include('components.header')

<section class="py-5">
    <div class="container px-4 px-lg-5 mt-5">
        @if(session('success'))
        <h5 class="text-center text-info">
            {{ session('success') }}
        </h5>
        @endif
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
            @foreach($products as $product)
            <div class="col mb-5">
                <div class="card h-100">
                    <!-- Product image-->
                    <img class="card-img-top" width="300" height="200" src="{{ asset('storage/thumbnails/' . $product->productImage) }}" alt="{{ $product->productName }}" />
                    <!-- Product details-->
                    <div class="card-body p-4">
                        <div class="text-center">
                            <!-- Product name-->
                            <h5 class="fw-bolder text-info"><a href="/product/detail/{{ $product->id }}" class="text-info" style="text-decoration: none;">{{ $product->productName }}</a></h5>
                            <!-- Product price-->
                            ${{ $product->productPrice }}
                        </div>
                    </div>
                    <!-- Product actions-->
                    <form method="GET" action="/product/order">
                    @csrf
                    <input readonly type="hidden" name="product_id" id="product_id" value="{{ $product->id }}">
                    <input readonly type="hidden" name="user_email" id="user_email" value="abc@gmail.com">
                    <input readonly type="hidden" name="product_image" id="product_image" value="{{ $product->productImage }}">
                    <input readonly type="hidden" name="product_name" id="product_name" value="{{ $product->productName }}">
                    <input readonly type="hidden" name="price" id="price" value="{{ $product->productPrice }}">
                    <input type="hidden" name="quantity" class="form-control bg-transparent border-0 text-center" value="1">
                    <div class="text-center card-footer p-4 pt-0 border-top-0 bg-transparent">
                        <button type="submit" class="btn btn-outline-dark mt-auto"></i>Add To Cart</button>
                    </div>
                    </form>
                </div>
            </div>
            @endforeach
            
            
        </div>
            <div class="text-center">
                {{ $products->links() }}
            </div>
    </div>
</section>

@include('components.footer')
@endsection