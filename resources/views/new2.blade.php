@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <h1>Checkout. Step 2</h1>
            </div>
        </div>
        <div class="row justify-content-between">
            <div class="col-4 border shadow p-3 mb-5 bg-white">
                <h3>Ship to </h3>
                <div class="pl-3" style="font-size: 1.25em">
                  <p>(name, surname)</p>
                  <p>(adress)</p>
                  <p>(city,state, zip)</p>
                  <p>(phone nr)</p>
                </div>
                <button type="button" class="btn btn-secondary">Edit</button>
                <div class="form-check pt-4">
                  <p>Prefered delivery time:</p>
                  <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked>
                  <label class="form-check-label" for="exampleRadios1">
                    09:00 - 18:00
                  </label>
                </div>
            </div>

            <div class="col-4 border shadow p-3 mb-5 bg-white">
              <h3>Confirm order</h3>
              <h4>Nosaukums</h4>
              <table class="table table-borderless">
                <tbody style="font-size: 1.25em">
                  <tr>
                    <td>Subtotal:</td>
                    <td>$500</td>
                  </tr>
                  <tr>
                    <td>Delivery:</td>
                    <td>$2.99</td>
                  </tr>
                  <tr>
                    <td class="font-weight-bold">Total:</td>
                    <td class="font-weight-bold">$502.99</td>
                    </tr>
                  </tbody>
                </table>
                <button type="button" class="btn btn-primary">Confirm and pay</button>
            </div>
        </div>
    </div>
@endsection
