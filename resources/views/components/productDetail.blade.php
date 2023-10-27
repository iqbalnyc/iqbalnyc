@extends('components.app-layout')
@section('title', 'Products')

@section('content')
@include('components.header')

<!-- script -->
<script type="text/javascript">
    function incrementValue() {
        event.preventDefault()
        var value = parseInt(document.getElementById('quantity').value);
        value = isNaN(value) ? 0 : value;
        value++;
        document.getElementById('quantity').value = value;
    }

    function decrementValue() {
        event.preventDefault()
        var value = parseInt(document.getElementById('quantity').value, 10);
        value = isNaN(value) ? 0 : value;
        if (value > 1) {
            value--;
            document.getElementById('quantity').value = value;
        }

    }
</script>

<section>
    <div class="container px-4 px-lg-8 mt-2">

        <div class="row px-xl-5">

            <div class="col-lg-4">
                <div class="position-relative overflow-hidden">
                    <img class="rounded mx-auto d-block" width="400" height="300" src="{{ asset('storage/thumbnails/' .  $product->productImage) }}" alt="Image">
                </div>
            </div>

            <div class="col-lg-7 h-auto  mb-5">
                <div class="h-100 bg-light p-30">
                    @if(session('success'))
                    <h5 class="text-center text-info">
                        {{ session('success') }}
                    </h5>
                    @endif
                    <h3>{{ $product->productName }}</h3>
                    <div class="d-flex mb-3">
                        <div class="text-primary mr-2">
                            <small class="fas fa-star"></small>
                            <small class="fas fa-star"></small>
                            <small class="fas fa-star"></small>
                            <small class="fas fa-star-half-alt"></small>
                            <small class="far fa-star"></small>
                        </div>

                    </div>
                    <h3 class="font-weight-semi-bold mb-4">${{ $product->productPrice }}</h3>
                    <p class="mb-0">Manufacturer: {{ $product->productManu }}</p>
                    <p class="mb-0">Part No: {{ $product->productPartNo }}</p>
                    <p class="mb-4">Available: {{ $product->productStatus }}</p>
                    <!------------------ Increment/Decrement -->
                    <form method="GET" action="/product/order">
                        @csrf
                        <input readonly type="hidden" name="product_id" id="product_id" value="{{ $product->id }}">
                        <input readonly type="hidden" name="user_email" id="user_email" value="abc@gmail.com">
                        <input readonly type="hidden" name="product_image" id="product_image" value="{{ $product->productImage }}">
                        <input readonly type="hidden" name="product_name" id="product_name" value="{{ $product->productName }}">
                        <input readonly type="hidden" name="price" id="price" value="{{ $product->productPrice }}">

                        <div class="d-flex align-items-center mb-4 pt-2">
                            <div class="input-group quantity" style="width: 250px;">
                                <div class="input-group-btn">
                                    <button class="btn btn-primary px-3" onclick="decrementValue()">
                                        <i class="fa fa-minus">-</i>
                                    </button>
                                </div>

                                <input type="text" name="quantity" id="quantity" class="form-control bg-transparent border-0 text-center" value="1">

                                <div class="input-group-btn">
                                    <button class="btn btn-primary px-3" onclick="incrementValue()">
                                        <i class="fa fa-plus">+</i>
                                    </button>
                                </div>

                                <div class="input-group-btn">
                                    <button type="submit" class="btn btn-primary px-3"><i class="fa fa-shopping-cart mr-1"></i>Add To Cart</button>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
                <!-- Media -->
            </div>
        </div>
    </div>
    </div>
</section>

@include('components.footer')
@endsection