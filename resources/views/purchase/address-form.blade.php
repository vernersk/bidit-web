@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <h1>Checkout. Step 1</h1>
            </div>
        </div>
        <div class="row  justify-content-between">
            <div class="col-7 border shadow p-3 mb-5 bg-white">
                <h3>Delivery information</h3>
                <p>Please enter information about the person making this order and the exact address of delivery.</p>
                <form method="post" action="{{route('purchase.delivery')}}">
                    @csrf
                    <input hidden name="auctionId" value="{{$auction->id}}">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputName">Name</label>
                            <input type="text" name="name" value="{{$userData->name ?? ''}}" class="form-control" id="inputName">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputSurname">Surname</label>
                            <input type="text" name="surname" class="form-control" id="inputSurname" value="{{$userData->surname ?? ''}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputAddress">Address</label>
                        <input type="text" name="address" class="form-control" id="inputAddress" value="{{$userData->address ?? ''}}" placeholder="1234 Main St">
                    </div>
                    <div class="form-group">
                        <label for="inputAddress2">Address 2</label>
                        <input type="text" name="address2" class="form-control" id="inputAddress2" value="{{$userData->address2 ?? ''}}" placeholder="Apartment, studio, or floor">
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputCity">City</label>
                            <input type="text" name="city" class="form-control" id="inputCity" value="{{$userData->city ?? ''}}">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="inputState">State</label>
                            <input type="text" name="state" class="form-control" id="inputState" value="{{$userData->state ?? ''}}">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="inputZip">Zip</label>
                            <input type="text" name="zip" class="form-control" id="inputZip" value="{{$userData->zip ?? ''}}">
                        </div>
                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">To delivery</button>
                    </div>
                </form>
            </div>
            <div class="col-4 border shadow p-3 mb-5 bg-light">
                <h3>Order information</h3>
                <div class="card  m-2 shadow-sm" style="width: 18rem;">
                <img
                    src="https://thumbs.dreamstime.com/b/old-worn-laced-boot-white-background-old-worn-boot-169699019.jpg"
                    class="w-100 position-relative"
                >
                <div class="py-2 flex-grow-1 text-center">
                    <h5 class="card-title">{{$auction->product->name}}</h5>
                    <p class="card-text">Product price: ${{$highestBid->amount}}</p>
                </div>
            </div>
            </div>
        </div>
    </div>
@endsection
