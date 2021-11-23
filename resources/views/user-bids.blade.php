@extends('layouts.app')

@section('content')
<div class="container">
    @if($data)
    <div class="row g-5 justify-content-center">
        <?php foreach($data as $datum): ?>
            <div class="card col-3 m-2 shadow-sm" style="width: 18rem;">
                <div class="mb-3 text-right">
                    <a class="btn btn-secondary w-100" href="{{route('auction.complete',['auctionId' => $datum['auction']])}}">Complete</a>
                </div>
                <img
                    src="https://thumbs.dreamstime.com/b/old-worn-laced-boot-white-background-old-worn-boot-169699019.jpg"
                    class="w-100 position-relative"
                >
                <div class="py-2 flex-grow-1">
                    <h5 class="card-title">{{ $datum['product']['name'] }}</h5>
                    <p class="card-text">{{ $datum['product']['description'] }}</p>
                </div>
                <div class="my-2">
                    <div class="card-text block">
                        <div>Highest bidder: </div>
                        <div class="h5 rounded-sm p-2 text-white d-flex justify-content-between {{ $datum['isUserHighestBidder'] ? 'bg-success' : 'bg-danger'}}">
                            <div class="">{{$datum['highestBid']['name']}}</div>
                            <div class="">${{$datum['highestBid']['amount']}}</div>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <a class="btn btn-primary w-100" href="{{route('auction.show', $datum['auction'])}}">Place a bid</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    @else
    <div>
        <h1>Nothing here</h1>
    </div>
    @endif
</div>
@endsection
