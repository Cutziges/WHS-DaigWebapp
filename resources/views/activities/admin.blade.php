@extends('layouts.app')

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
        @if (count($activities)>0)
            <div class="col">
                <div class="card">
                    <h2 class="card-header">Activities</h2>
                    <div class="card-body">
                        <button type="button" class="btn btn-outline-primary" data-toggle="modal"
                                data-target="#createActivity">Add activity
                        </button>
                        <br><br>
                        <ul class="list-group">
                            @foreach($activities as $activity)
                                <li class="list-group-item">
                                    <p>#{{ $activity->id }}: <strong>{{ $activity->name }}</strong></p>
                                    <p><b>Color:</b> {{ $activity->color }}</p>
                                    <div class="btn">
                                        <button type="button" class="btn btn-outline-danger" data-toggle="modal"
                                                data-target="#deleteActivity{{ $loop->iteration }}">Delete
                                        </button>
                                        <button type="button" class="btn btn-outline-secondary" data-toggle="modal"
                                                data-target="#editActivity{{ $loop->iteration }}">Edit
                                        </button>
                                    </div>
                                </li>
                                <!-- Delete Modal -->
                                <div>
                                    <div class="modal fade" id="deleteActivity{{ $loop->iteration }}"
                                         tabindex="-1" role="dialog"
                                         aria-labelledby="deleteLabel"
                                         aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <form action="{{ route('activity.delete', $activity->id) }}"
                                                  method="POST">
                                                @csrf
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="deleteLabel">Delete
                                                            activity {{ $activity->name }}</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close"><span
                                                                aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Are you sure you want to delete the activity?
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
                                    <div class="modal fade" id="editActivity{{ $loop->iteration }}" tabindex="-2"
                                         role="dialog"
                                         aria-labelledby="editLabel"
                                         aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <form action="{{ route('activity.edit', $activity->id) }}"
                                                  method="POST">
                                                @csrf
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editLabel">Edit
                                                            activity {{ $activity->name }}</h5>
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
                                                                   value="{{ $activity->name }}"
                                                                   class="form-control"
                                                                   autofocus>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="description">Description (optional)</label>
                                                            <input type="text" name="description" id="description"
                                                                   placeholder="Would you like to give more information?"
                                                                   value="{{ $activity->description }}"
                                                                   class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="color">Color</label>
                                                            <input type="color" name="color" id="color"
                                                                   placeholder="Select a color"
                                                                   value="{{ $activity->color }}"
                                                                   class="form-control">
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
                                <p>There are no activities yet.</p>
                                <button type="button" class="btn btn-outline-primary" data-toggle="modal"
                                        data-target="#createActivity">Add activity
                                </button>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
    </div>
    <!-- Create Modal -->
    <div>
        <div class="modal fade" id="createActivity" tabindex="-3" role="dialog" aria-labelledby="createLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <form action="{{ route('activity.create') }}"
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
                                <label for="description">Description (optional)</label>
                                <input type="text" name="description" id="description"
                                       placeholder="Add some more information"
                                       class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="color">Color</label>
                                <input type="color" name="color" id="color"
                                       placeholder="Select a color"
                                       class="form-control">
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
