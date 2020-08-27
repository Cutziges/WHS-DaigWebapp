@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-1">
            <a href="{{ url()->previous() }}" class="previous">&laquo; back</a>
        </div>
        <div class="col-11">
            <h1>{{ $topic }}</h1>
        </div>
    </div>
    <!-- Show all available recommendations  -->
    @if (count($recommendations)>0)
        @foreach($recommendations as $rec)
            <div class="container text-left">
                <div class="row">
                    <div class="col">
                        <div class="card mb-3">
                            <div class="row no-gutters">
                                <div class="col-md-4">
                                    <img src="{{ $rec->place_image_path . $rec->place_image }}"
                                         class="card-img img-fluid" alt="{{ $rec->name }}">
                                </div>
                                <div class="col-md-8">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item">
                                            <h5 class="card-title text-uppercase text-center">{{ $rec->name }}</h5>
                                        </li>
                                        <li class="list-group-item">
                                            <strong>Address:</strong> {{ $rec->address }}
                                            <br><small class="text-muted">Distance: {{ $rec->distance }}km</small>
                                        </li>
                                        <li class="list-group-item">
                                            {{ $rec->description }}
                                        </li>
                                        @if ($rec->phone != null)
                                            <li class="list-group-item">
                                                <strong>Phone:</strong> {{ $rec->phone }}
                                            </li>
                                        @endif
                                        @if ($rec->website != null)
                                            <li class="list-group-item">
                                                <strong>Website:</strong> <a href="http://{{ $rec->website }}"
                                                                             target="_blank">{{ $rec->name }}</a>
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <!-- No recommendations -->
        <div class="col-md">
            <div class="card">
                <h2 class="card-header">Oops!</h2>
                <div class="card-body">
                    <p>There are no recommendations for this category yet.</p>
                </div>
            </div>
        </div>
    @endif
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
