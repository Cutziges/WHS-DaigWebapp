@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col">
            <h1>Administration</h1>
            <p>Add, edit or delete elements from the Daig Webapp.</p>
        </div>
    </div>
    <div class="row pt-2">
        <div class="col-md-4">
            <div class="card">
                <h2 class="card-header text-center tips">
                    <a href="{{ route('tips.admin') }}"
                       class="stretched-link"></a>
                    Tips & Tricks</h2>
                <div class="card-body">
                    <p>Manage all tips & tricks.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <h2 class="card-header text-center recommendations">
                    <a href="{{ route('recs.admin') }}"
                       class="stretched-link"></a>
                    Recommendations</h2>
                <div class="card-body">
                    <p>Manage the recommendations for places near Künstlersiedlung Halfsmannshof.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <h2 class="card-header text-center activities">
                    <a href="{{ route('activity.admin') }}"
                       class="stretched-link"></a>
                    Activities</h2>
                <div class="card-body">
                    <p>Manage the activities for the activity wheel.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <h2 class="card-header text-center items">
                    <a href="{{ route('item.index') }}"
                       class="stretched-link"></a>
                    Items</h2>
                <div class="card-body">
                    <p>Manage the Soft- and Hardware components.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <h2 class="card-header">Documentations</h2>
                <div class="card-body">
                    <p>Documents of the Soft- and Hardware components.</p>
                    <div class="btn-block">
                        <a href="{{ route('docs.showAdmin', ['category_id' => '1']) }}" class="hardware-2">
                            <i class="fas fa-microchip"></i> Hardware</a>
                        <a href="{{ route('docs.showAdmin', ['category_id' => '2']) }}" class="software-2">
                            <i class="far fa-file-code"></i> Software</a>
                    </div>
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
