@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col">
            <h1>Recommended places</h1>
            <p>Choose the category you would like to get recommendations for.</p>
        </div>
    </div>
    <div class="container">
        <div class="button-grid">
            <div class="button-grid__item">
                <a href="{{ route('recommendations.show', ['topic_id' => '1']) }}" class="button__category food">
                    <div class="button__icon"><i class="fas fa-utensils"></i></div>
                    <div class="button__text">Food & Drinks</div>
                </a>
            </div>
            <div class="button-grid__item">
                <a href="{{ route('recommendations.show', ['topic_id' => '2']) }}" class="button__category art">
                    <div class="button__icon"><i class="fas fa-palette"></i></div>
                    <div class="button__text">Art & Culture</div>
                </a>
            </div>
            <div class="button-grid__item">
                <a href="{{ route('recommendations.show', ['topic_id' => '3']) }}" class="button__category sport">
                    <div class="button__icon"><i class="fas fa-sun"></i></div>
                    <div class="button__text">Sport</div>
                </a>
            </div>
            <div class="button-grid__item">
                <a href="{{ route('recommendations.show', ['topic_id' => '4']) }}" class="button__category nature">
                    <div class="button__icon"><i class="fas fa-tree"></i></div>
                    <div class="button__text">Nature</div>
                </a>
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
