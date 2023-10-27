@extends('components.app-layout')
@section('title', 'Shopping Cart')

@section('content')
@include('components.header')
@props(['customer']);

@php
$subtotal = 0;
$shipping = 0;
$total = 0;
@endphp

<!-- Checkout Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        
        <div class="col-lg-8">
            <h5 class="section-title position-relative text-uppercase mb-3"><span class="pr-3">Billing Address</span></h5>

            @if(session('success'))
            <h5 class="text-center text-text">
            {{ session('success') }}
            </h5>@endif
            <form action="/product/processCheckout" method="post">
            @csrf 
            <div class="bg-light p-30 mb-5">
                <div class="row">
                    <div class="col-md-6 form-group mb-2 mb-2">
                        <label>First Name</label>
                        <input name="firstName" id="firstName" class="form-control" type="text"
                        value="{{ old('firstName', optional($customer)->firstName) }}" placeholder="John">
                        @error('firstName')
                        <p class="text-danger small mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="col-md-6 form-group mb-2">
                        <label>Last Name</label>
                        <input name="lastName" id="lastName" class="form-control" type="text"
                        value="{{ old('lastName', optional($customer)->lastName) }}" placeholder="John">
                        @error('lastName')
                        <p class="text-danger small mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="col-md-6 form-group mb-2">
                        <label>E-mail</label>
                        <input name="userEmail" class="form-control" type="text" 
                            value="{{ old('userEmail', optional($customer)->userEmail) }}" placeholder="example@email.com">
                        @error('userEmail')
                        <p class="text-danger small mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="col-md-6 form-group mb-2">
                        <label>Password</label>
                        <input name="password" class="form-control" type="password" 
                            value="{{ old('password', optional($customer)->password) }}">
                        @error('password')
                        <p class="text-danger small mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="col-md-6 form-group mb-2">
                        <label>Mobile No</label>
                        <input name="phoneNo" class="form-control" type="text" 
                            value="{{ old('phoneNo', optional($customer)->phoneNo) }}" placeholder="+123 456 789">
                        @error('phoneNo')
                        <p class="text-danger small mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="col-md-6 form-group mb-2">
                        <label>Address Line 1</label>
                        <input name="address1" class="form-control" type="text" 
                            value="{{ old('address1', optional($customer)->address1) }}" placeholder="123 Street">
                        @error('address1')
                        <p class="text-danger small mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="col-md-6 form-group mb-2">
                        <label>Address Line 2</label>
                        <input name="address2" class="form-control" type="text" 
                            value="{{ old('address2', optional($customer)->address2) }}" placeholder="123 Street">
                        @error('address2')
                        <p class="text-danger small mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="col-md-6 form-group mb-2">
                        <label>Country</label>
                        <select name="country" class="form-control">
                            <option selected>United States</option>
                            <option>Afghanistan</option>
                            <option>Albania</option>
                            <option>Algeria</option>
                        </select>
                        @error('country')
                        <p class="text-danger small mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="col-md-6 form-group mb-2">
                        <label>City</label>
                        <input name="city" class="form-control" type="text" 
                            value="{{ old('city', optional($customer)->city) }}" placeholder="New York">
                        @error('city')
                        <p class="text-danger small mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="col-md-6 form-group mb-2">
                        <label>State</label>
                        <input name="state" class="form-control" type="text" 
                            value="{{ old('state', optional($customer)->state) }}" placeholder="New York">
                        @error('state')
                        <p class="text-danger small mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="col-md-6 form-group mb-2">
                        <label>ZIP Code</label>
                        <input name="zipcode" class="form-control" type="text" 
                            value="{{ old('zipcode', optional($customer)->zipcode) }}" placeholder="123">
                        @error('zipcode')
                        <p class="text-danger small mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        <!-- Order Total -->
        <div class="col-lg-4">
            @if(session()->has('cart'))
            @foreach(session('cart') as $key => $item)
            <h5 class="section-title position-relative text-uppercase mb-3"><span class="pr-3">Order Total</span></h5>
            <div class="bg-light p-30 mb-1">
                <div class="border-bottom">
                    <h6 class="mb-3">Products</h6>
                    <div class="d-flex justify-content-between">
                        <p>{{ $item['product_name'] }}</p>
                        <p>${{ $item['total_amount'] }}</p>
                    </div>
                </div>
            </div>
            @endforeach
            @endif
            <div class="mb-3">
                <h5 class="section-title position-relative text-uppercase mb-1"><span class="pr-3">Payment</span></h5>
                <div class="bg-light p-30">
                    <div class="form-group">
                        <div class="custom-control custom-radio">
                            <input type="radio" class="custom-control-input" name="paymentType" value="Paypal" id="paypal">
                            @error('paymentType')
                            <p class="text-danger small mt-2">{{ $message }}</p>
                            @enderror
                            <label class="custom-control-label" for="paypal">Paypal</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="custom-control custom-radio">
                            <input type="radio" class="custom-control-input" name="paymentType" value="Direct Check" id="directcheck">
                            @error('paymentType')
                            <p class="text-danger small mt-2">{{ $message }}</p>
                            @enderror
                            <label class="custom-control-label" for="directcheck">Direct Check</label>
                        </div>
                    </div>
                    <div class="form-group mb-4">
                        <div class="custom-control custom-radio">
                            <input type="radio" class="custom-control-input" name="paymentType" value="Bank Transfer" id="banktransfer">
                            @error('paymentType')
                            <p class="text-danger small mt-2">{{ $message }}</p>
                            @enderror
                            <label class="custom-control-label" for="banktransfer">Bank Transfer</label>
                        </div>
                    </div>
                    <div>
                        @if($customer)
                            <b>Billing Address:</b> 
                            <p>{{ $customer['address1'] }}<br /> 
                             {{ $customer['address2'] }}<br /> 
                             {{ $customer['city'] }}<br />   
                             {{ $customer['state'] }}<br /> 
                             {{ $customer['zipcode'] }}<br />  
                        @endif
                    </div>
                    <button type="submit" class="btn btn-block btn-primary font-weight-bold py-1">Place Order</button>
                </div>
            </div>
        </div>
        </form>
    </div>
</div>
<!-- Checkout End -->

@include('components.footer')
@endsection