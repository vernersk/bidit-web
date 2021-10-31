@extends('layouts.app')

@section('content')
        <div class="card container p-4">
            <div class="row g-0">
                <div class="col-md-5">
                    <img
                        src="https://picsum.photos/500/586?random=1"
                        class="img-fluid rounded-start"
                    />
                </div>
                <div class="col-md-7">
                    <div class="pb-4">
                        <h1 class="card-title">{{ $auction->product->name }}</h1>
                        <p class="card-text">{{ $auction->product->description }}</p>
                    </div>
                    <div class="">
                        <div id="scroller" class="" style="height: 367px; overflow-y: auto;">
                            <table class="table">
                                <tbody>
                                @foreach($bids as $key => $bid)
                                    <tr class="{{ $key == count($bids)-1 ? 'bg-warning' : '' }}">
                                        <td>{{$bid->name}}</td>
                                        <td class="text-right"><b>$</b> {{$bid->amount}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="mt-2">
                        <form action="{{route('bid.store', ['auctionId' => $auction->id])}}" method="POST" class="row">
                            @csrf
                            <div class="col-6">
                                <input type="number" name="bid" value="{{$highestBid->amount + 1}}" class="w-100 h4">
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
