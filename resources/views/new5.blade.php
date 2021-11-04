@extends('layouts.app')

@section('content')
// Function to allow users to add item for bidding
<div style="
    display: inline-block;
    position: fixed;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    width: 800px;
    height: 500px;
    margin: auto;
    background-color: #f3f3f3;">Add Item for AUCTION


<div class="col-md-12">
    @include('helpers.error')
    <form action="{{route('product.store')}}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <strong>Name:</strong>
                    <input type="text" class="form-control" placeholder="Name" name="name">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <strong>Starting price:</strong>
                    <input type="number" class="form-control" placeholder="Set starting price" name="price">
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    <strong>Image:</strong>
                    <input type="file" class="form-control"  name="image">
                </div>
            </div>


                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <strong>Description</strong>
                        <input type="text" class="form-control" placeholder="Add Description, for selecting item" name="description">
                    </div>
                </div>
            <div class="col-md-12">
                    <div class="form-group">
                        <button class="btn btn-primary float-right"> SUBMIT</button>
                    </div>
        </div>
    </form>
</div>
</div>

@endsection
