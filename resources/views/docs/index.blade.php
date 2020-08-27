@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col">
            <h1>Documentations</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 text-left">
            <div class="card">
                <h2 class="card-header text-center hardware">
                    <a href="{{ route('docs.show', ['category_id' => '1']) }}" class="stretched-link"></a>
                    <i class="fas fa-microchip"></i>
                    Hardware</h2>
                <div class="card-body">
                    <h5 class="card-title">Examples</h5>
                    <ul>
                        <li>Sharp Monitor</li>
                        <li>Nuki Smart Lock 2.0</li>
                        <li>Microsoft Surface Hub</li>
                        <li>Microsoft Surface Studio</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-6 text-left">
            <div class="card">
                <h2 class="card-header text-center software">
                    <a href="{{ route('docs.show', ['category_id' => '2']) }}" class="stretched-link"></a>
                    <i class="far fa-file-code"></i>
                    Software</h2>
                <div class="card-body">
                    <h5 class="card-title">Examples</h5>
                    <ul>
                        <li>MURAL</li>
                        <li>smartPerform</li>
                        <li>slack</li>
                        <li>Hoylu Paper</li>
                    </ul>
                </div>
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
