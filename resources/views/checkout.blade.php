<?php
use Illuminate\Support\Facades\Auth;
?>
@extends('layouts.app')

@section('content')
    <checkout :user-id="<?=Auth::id()?>"></checkout>
@endsection
