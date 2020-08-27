@extends('layouts.app')

@section('slider')
    <!-- Tips & Tricks Slider -->
    <section class="slider">
        <div id="tipsSlider" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                @if($randomTips ?? '' != null)
                    @foreach($randomTips ?? '' as $key => $tip)
                        <li data-target="#tipsSlider" data-slide-to="{{ $key }}"
                            class="{{ $key == 0 ? 'active' : ''}}"></li>
                    @endforeach
            </ol>
            <div class="carousel-inner">
                @foreach($randomTips ?? '' as $key => $tip)
                    <div class="carousel-item text-center p-5 {{$key == 0 ? 'active' : '' }}">
                        <div>
                            <h5>{{ $tip->shortTip }}</h5>
                        </div>
                    </div>
                @endforeach
                @endif
            </div>
            <a class="carousel-control-prev" href="#tipsSlider" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#tipsSlider" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </section>
    <!-- End Tips & Tricks Slider -->
@endsection

@section('content')
    <div class="row">
        <div class="col">
            <h1>Welcome to the Daig Webapp!</h1>
            <p>Our app offers the following functions:</p>
        </div>
    </div>
    <div class="row">
        <div class="col text-left">
            <ul>
                <li>
                    <p><strong>Tips:</strong> Get some short tips & tricks for our soft- and hardware components</p>
                </li>
                <li>
                    <p><strong>Documents:</strong> Find the detailed documentation for our soft- and hardware
                        components and learn how to use our technologies</p>
                </li>
                <li>
                    <p><strong>Places:</strong> Recommended places near Künstlersiedlung Halfmannshof</p>
                </li>
                <li>
                    <p><strong>Activities:</strong> Get a proposal for todays activity</p>
                </li>
                <li>
                    <p><strong>Settings:</strong> Change the settings for the Daig Webapp</p>
                </li>
                <li>
                    <p><strong>Help:</strong> Get some help on how to use the Daig Webapp and its functions</p>
                </li>
            </ul>
        </div>
    </div>
    <div class="container-fluid justify-content-center">
            <img src="../images/collaboration.svg" class="img-fluid" alt="Daig - The Co.Laboratorium">
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
