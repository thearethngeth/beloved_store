@extends('layouts.default')
@section('title', 'Checkout')
@section('content')

    <main class="container" style="max-width: 900px">
        <section>
            <h2>
                Checkout
            </h2>
            @if(session()->has("success"))
                <div class="alert alert-success">
                    {{session()->get("success")}}
                </div>
            @endif
            @if(session("error"))
                <div class="alert alert-danger">
                    {{session("error")}}
                </div>
            @endif


            <form action="{{route('checkout.post')}}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="address" class="form-label">Address</label>
                    <textarea class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}"
                              id="address"
                              name="address"
                              rows="3"
                              required>{{ old('address') }}</textarea>
                    @error('address')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="phone" class="form-label">Phone Number</label>
                    <input type="tel" class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}"
                           id="phone"
                           name="phone"
                           value="{{ old('phone') }}"
                           pattern="[0-9]{10,15}"
                           title="Please enter a valid phone number (10-15 digits)"
                           required>
                    @error('phone')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="pincode" class="form-label">Pincode</label>
                    <input type="text" class="form-control {{ $errors->has('pincode') ? 'is-invalid' : '' }}"
                           id="pincode"
                           name="pincode"
                           value="{{ old('pincode') }}"
                           pattern="[0-9]{5,6}"
                           title="Please enter a valid pincode (5-6 digits)"
                           maxlength="6"
                           required>
                    @error('pincode')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Proceed to Payment</button>
            </form>
        </section>
    </main>
@endsection
