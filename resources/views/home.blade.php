@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row g-5 justify-content-center">
            <?php foreach($auctions as $auction): ?>
                <div id="product" class="card col-3 m-2 shadow-sm" style="width: 18rem;">
                    <img
                        src="{{$auction['product']['image']}}"
                        class="w-100 mt-3 position-relative"
                    >
                    <div class="py-2 flex-grow-1">
                        <h5 class="card-title">{{ $auction['product']['name'] }}</h5>
                        <p class="card-text">{{ $auction['product']['description'] }}</p>
                    </div>
                    <div class="my-2">
                        @if(isset($auction['highestBid']['amount']))
                            <div class="my-2">
                                <div class="card-text block">
                                    <div class="font-weight-bold">Highest bidder: </div>
                                    <div class="h5 rounded-sm p-2 text-white d-flex justify-content-between bg-info">
                                        <div>{{$auction['highestBid']['name']}}</div>
                                        <div>${{$auction['highestBid']['amount']}}</div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="my-2">
                                <div class="card-text block">
                                    <div class="font-weight-bold">Highest bidder: </div>
                                    <div class="h5 rounded-sm p-2 text-white d-flex justify-content-between bg-info">
                                        <div>Starting bid</div>
                                        <div>${{$auction['product']['price']}}</div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="mb-3">
                        <a class="btn btn-primary w-100" href="{{route('auction.show', $auction['auction']['id'])}}">Place a bid</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
@endsection
