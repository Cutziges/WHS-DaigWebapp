@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-1">
            <a href="{{ url()->previous() }}" class="previous">&laquo; back</a>
        </div>
        <div class="col-11">
            <h1>{{ $category }} Documentations</h1>
            <p>The following documentations are available for you to read.</p>
        </div>
    </div>
    <div class="row">
        <!-- Show all Items  -->
        @if (count($items)>0)
            @foreach($items as $item)
                @if(count($item->docs)>0)
                    <div class="col-md-4">
                        <div class="card">
                            <h2 class="card-header">{{ $item->name }}</h2>
                            <div class="card-body text-left">
                                <img alt="{{ $item->name }}" class="img-fluid"
                                     src="{{ $item->item_image_path . $item->item_image }}">
                                <h5 class="card-title">Documentation</h5>
                                <p class="card-text">Available information:</p>
                                <ul>
                                    <!-- Show all documents for item -->
                                    @foreach($item->docs as $doc)
                                        <li>
                                            <a href="{{ $doc->file_path . $doc->file }}"
                                               target="_blank">{{ $doc->title }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        @else
        <!-- No Items -->
            <div class="col-md">
                <div class="card">
                    <h2 class="card-header">Oops!</h2>
                    <div class="card-body">
                        <p>There are no documents yet.</p>
                    </div>
                </div>
            </div>
        @endif
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
