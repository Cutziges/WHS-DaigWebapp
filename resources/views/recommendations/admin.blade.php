@extends('layouts.app')

@section('scripts')
    <script type="text/javascript" src="file/js/mapInput.js"></script>
@endsection

@section('content')
    <div class="row">
        <div class="col">
            <!-- Display Messages -->
        @include('flash-message')
        <!-- End Messages -->
        </div>
    </div>
    <div class="row">
        <!-- Show all available recommendations  -->
        @if (count($recommendations)>0)
            <div class="col">
                <div class="card">
                    <h2 class="card-header">Recommendations</h2>
                    <div class="card-body">
                        <button type="button" class="btn btn-outline-primary" data-toggle="modal"
                                data-target="#createRecommendation">Add recommendation
                        </button>
                        <br><br>
                        <ul class="list-group">
                            @foreach($recommendations as $recommendation)
                                <li class="list-group-item">
                                    <p>#{{ $recommendation->id }}: <strong>{{ $recommendation->name }}</strong></p>
                                    <p><b>Category:</b> {{ $recommendation->topic->title }}</p>
                                    <div class="btn">
                                        <button type="button" class="btn btn-outline-danger" data-toggle="modal"
                                                data-target="#deleteRecommendation{{ $loop->iteration }}">Delete
                                        </button>
                                        <button type="button" class="btn btn-outline-secondary" data-toggle="modal"
                                                data-target="#editRecommendation{{ $loop->iteration }}">Edit
                                        </button>
                                    </div>
                                </li>
                                <!-- Delete Modal -->
                                <div>
                                    <div class="modal fade" id="deleteRecommendation{{ $loop->iteration }}"
                                         tabindex="-1" role="dialog"
                                         aria-labelledby="deleteLabel"
                                         aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <form action="{{ route('recs.delete', $recommendation->id) }}"
                                                  method="POST">
                                                @csrf
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="deleteLabel">Delete
                                                            recommendation for {{ $recommendation->name }}</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close"><span
                                                                aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Are you sure you want to delete the recommendation?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Cancel
                                                        </button>
                                                        <button type="submit" class="btn btn-outline-danger">
                                                            Delete
                                                        </button>
                                                    </div>
                                                {{ method_field('DELETE') }}
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- Delete Modal end -->
                                <!-- Edit Modal -->
                                <div>
                                    <div class="modal fade" id="editRecommendation{{ $loop->iteration }}" tabindex="-2"
                                         role="dialog"
                                         aria-labelledby="editLabel"
                                         aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <form action="{{ route('recs.edit', $recommendation->id) }}"
                                                  method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editLabel">Edit
                                                            recommendation for {{ $recommendation->name }}</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close"><span
                                                                aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="name">Name</label>
                                                            <input type="text" name="name" id="name"
                                                                   placeholder="Name"
                                                                   value="{{ $recommendation->name }}"
                                                                   class="form-control"
                                                                   autofocus>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="description">Description</label>
                                                            <input type="text" name="description" id="description"
                                                                   placeholder="Why is this place recommended?"
                                                                   value="{{ $recommendation->description }}"
                                                                   class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="address">Address</label>
                                                            <input type="text" name="address" id="address"
                                                                   placeholder="Street, postal code and city"
                                                                   value="{{ $recommendation->address }}"
                                                                   class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="website">Website (optional)</label>
                                                            <input type="text" name="website" id="website"
                                                                   placeholder="Website URL"
                                                                   value="{{ $recommendation->website != null ? $recommendation->website : '' }}"
                                                                   class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="phone">Phone (optional)</label>
                                                            <input type="text" name="phone" id="phone"
                                                                   placeholder="Phone number"
                                                                   value="{{ $recommendation->phone != null ? $recommendation->phone : '' }}"
                                                                   class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="topic_id">Category:
                                                                <select name="topic_id">
                                                                    <option value="1"
                                                                        {{ $recommendation->topic_id == 1 ? 'selected' : ''}}>
                                                                        Food & Drinks
                                                                    </option>
                                                                    <option value="2"
                                                                        {{ $recommendation->topic_id == 2 ? 'selected' : ''}}>
                                                                        Art & Culture
                                                                    </option>
                                                                    <option value="3"
                                                                        {{ $recommendation->topic_id == 3 ? 'selected' : ''}}>
                                                                        Sport
                                                                    </option>
                                                                    <option value="4"
                                                                        {{ $recommendation->topic_id == 4 ? 'selected' : ''}}>
                                                                        Nature
                                                                    </option>
                                                                </select>
                                                            </label>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="new_place_image">Select an image with a
                                                                minimum
                                                                size of 500x500
                                                                (optional)</label>
                                                            <input id="new_place_image" type="file"
                                                                   class="form-control"
                                                                   name="new_place_image">
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-outline-danger"
                                                                data-dismiss="modal">Cancel
                                                        </button>
                                                        <button type="submit" class="btn btn-secondary">Edit
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- Edit Modal end -->
                            @endforeach
                        </ul>
                    </div>
                </div>
            @else
                <!-- No recommendations available -->
                    <div class="col-md">
                        <div class="card">
                            <h2 class="card-header">Oops!</h2>
                            <div class="card-body">
                                <p>There are no recommendations yet.</p>
                                <button type="button" class="btn btn-outline-primary" data-toggle="modal"
                                        data-target="#createRecommendation">Add new recommendation
                                </button>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
    </div>
    <!-- Create Modal -->
    <div>
        <div class="modal fade" id="createRecommendation" tabindex="-3" role="dialog" aria-labelledby="createLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <form action="{{ route('recs.create') }}"
                      method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="createLabel">Add new recommendation</h5>
                            <button type="button" class="close" data-dismiss="modal"
                                    aria-label="Close"><span
                                    aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name"
                                       placeholder="Name"
                                       class="form-control"
                                       autofocus>
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <input type="text" name="description" id="description"
                                       placeholder="Why is this place recommended?"
                                       class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="address">Address</label>
                                <input type="text" name="address" id="address-input"
                                       placeholder="Street, postal code and city"
                                       class="form-control map-input">
                                <input type="hidden" name="address_lat" id="address-latitude" value="0"/>
                                <input type="hidden" name="address_long" id="address-longitude" value="0"/>
                            </div>
                            <div class="form-group">
                                <label for="website">Website (optional)</label>
                                <input type="text" name="website" id="website"
                                       placeholder="Website URL"
                                       class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone (optional)</label>
                                <input type="text" name="phone" id="phone"
                                       placeholder="Phone number"
                                       class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="topic_id">Category:
                                    <select name="topic_id">
                                        <option value="1">Food & Drinks</option>
                                        <option value="2">Art & Culture</option>
                                        <option value="3">Sport</option>
                                        <option value="4">Nature</option>
                                    </select>
                                </label>
                            </div>
                            <div class="form-group">
                                <label for="place_image">Select an image with a minimum size of 500x500
                                    (optional)</label>
                                <input id="place_image" type="file"
                                       class="form-control"
                                       name="place_image">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-danger" data-dismiss="modal">
                                Cancel
                            </button>
                            <button type="submit" class="btn btn-secondary">Add</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Create Modal end -->
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
