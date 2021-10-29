@extends('layouts.app')

@section('content')
        <div class="card container mb-3">
            <div class="row g-0">
                <div class="col-md-5">
                    <img
                        src="https://thumbs.dreamstime.com/b/old-worn-laced-boot-white-background-old-worn-boot-169699019.jpg"
                        class="img-fluid rounded-start"
                    />
                </div>
                <div class="col-md-7">
                    <div class="card-body p-4">
                        <h1 class="card-title">{{ $product->name }}</h1>
                        <p class="card-text">{{ $product->description }}</p>
                    </div>
                    <div class="p-4">
                        <div id="scroller" class="" style="height: 305px; overflow-y: auto;">
                            <table class="table">
                                <tbody>
                                @foreach($bids as $key => $bid)
                                    <tr class="{{ $key == count($bids)-1 ? 'bg-success' : '' }}">
                                        <td>{{$bid->name}}</td>
                                        <td class="text-right"><b>$</b> {{$bid->amount}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="p-4">
                        <form action="{{route('bid.store', ['productId' => $product->id])}}" method="POST" class="row">
                            @csrf
                            <div class="col-6">
                                <input type="number" name="bid" class="w-100 h4">
                            </div>
                            <div class="col-6">
                                <button type="submit" class="btn btn-primary w-100 h4">
                                    Place a bid
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
@endsection
