@extends('layouts.app')

@section('header')

@section('content')
    <div class="row">
        <div class="col">
            <h1>Settings</h1>
            <p>Change the settings for the Daig Webapp.</p>
            <div>
                <strong>Bigger Font:</strong>
                <button id="inc" class="btn btn-outline-primary">Increase Text Size</button>
                <button id="dec" class="btn btn-outline-info">Decrease Text Size</button>
            </div>
        </div>
    </div>
    <!-- Back to top -->
    <div class="row">
        <div class="col-11"></div>
        <div class="col-1">
            <div id="topButton" class="button__top">
                <a href="#top" class="btn-floating btn-large btn-secondary">
                    <i class="fa fa-arrow-up"></i>
                </a>
            </div>
        </div>
    </div>
    <!-- Back to top end -->
@endsection
