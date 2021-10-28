@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row g-5 justify-content-center">
        <?php foreach($data as $product): ?>
            <div class="card col-3 m-2 shadow-sm" style="width: 18rem;">
                <img
                    src="https://thumbs.dreamstime.com/b/old-worn-laced-boot-white-background-old-worn-boot-169699019.jpg"
                    class="w-100 position-relative"
                >
                <div class="py-2 flex-grow-1">
                    <h5 class="card-title">{{ $product->name }}</h5>
                    <p class="card-text">{{ $product->description }}</p>
                    <div class="card-text block">Highest bid: <span>$5</span> </div>
                </div>
                <div class="mb-3">
                    <a class="btn btn-primary w-100" href="">Place a bid</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
@endsection
