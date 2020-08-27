@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <h1>Activities</h1>
                <p>Spin the wheel to get a proposal!</p>
                <!-- Activity wheel -->
                <div>
                    <activity-wheel :activities="{{json_encode($activities)}}"></activity-wheel>
                </div>
                <!-- Activity wheel end -->
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
