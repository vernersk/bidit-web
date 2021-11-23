<?php
use Illuminate\Support\Facades\Auth;
?>
@extends('layouts.app')

@section('content')
    <transactions :user-id="{{auth()->id()}}"></transactions>
@endsection
