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
                <form>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputName">Name</label>
                            <input type="text" class="form-control" id="inputName">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputSurname">Surname</label>
                            <input type="text" class="form-control" id="inputSurname">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputAddress">Address</label>
                        <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St">
                    </div>
                    <div class="form-group">
                        <label for="inputAddress2">Address 2</label>
                        <input type="text" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor">
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputCity">City</label>
                            <input type="text" class="form-control" id="inputCity">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="inputState">State</label>
                            <input type="text" class="form-control" id="inputState">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="inputZip">Zip</label>
                            <input type="text" class="form-control" id="inputZip">
                        </div>
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Submit</button>
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
                    <h5 class="card-title">Product name</h5>
                    <p class="card-text">Price to pay: $500</p>
                </div>
              
            </div>
            </div>
        </div>
    </div>    
@endsection
