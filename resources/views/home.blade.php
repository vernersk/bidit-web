@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row g-5 justify-content-center">
        <?php foreach($auctions as $auction): ?>
            <div class="card col-3 m-2 shadow-sm" style="width: 18rem;">
                <img
                    src="https://thumbs.dreamstime.com/b/old-worn-laced-boot-white-background-old-worn-boot-169699019.jpg"
                    class="w-100 position-relative"
                >
                <div class="py-2 flex-grow-1">
                    <h5 class="card-title">{{ $auction->product->name }}</h5>
                    <p class="card-text">{{ $auction->product->description }}</p>
                </div>
                <div class="my-2">
                    <div class="card-text block">Highest bid: <span>${{$auction->highestBid->amount}}</span> </div>
                </div>
                <div class="mb-3">
                    <a class="btn btn-primary w-100" href="{{route('auction.show', $auction->product)}}">Place a bid</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
@endsection
