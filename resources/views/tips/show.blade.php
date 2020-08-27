@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-1">
            <a href="{{ url()->previous() }}" class="previous">&laquo; back</a>
        </div>
        <div class="col-11">
            <h1>{{ $category }} Tips & Tricks</h1>
            <p>Here are some advices for you.</p>
        </div>
    </div>
    <div class="row">
        @foreach($tips as $tip)
            <div class="col-md">
                <div class="card">
                    <h2 class="card-header">Tip #{{ $loop->iteration }}</h2>
                    <div class="card-body">
                        <h5 class="card-title">{{ $tip->shortTip }}</h5>
                        @if($tip->longTip != null)
                            <p class="card-text">{{ $tip->longTip }}</p>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
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
