@extends('layouts.app')

@section('content')
    <auction
        :auction-id="{{$auctionId}}"
        :user-id="{{$userId}}"
    >
    </auction>
@endsection
