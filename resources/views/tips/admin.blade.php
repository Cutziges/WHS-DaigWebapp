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

    </div>
    <div class="row">
        <!-- Show all available tips & tricks  -->
        @if (count($tips)>0)
            <div class="col">
                <div class="card">
                    <h2 class="card-header">Tips & Tricks</h2>
                    <div class="card-body">
                        <p>The following tips & tricks are available.</p>
                        <button type="button" class="btn btn-outline-primary" data-toggle="modal"
                                data-target="#createTip">Add tip or trick
                        </button>
                        <br><br>
                        <ul class="list-group">
                            @foreach($tips as $tip)
                                <li class="list-group-item">
                                    <p class="font-weight-bold">{{ $tip->shortTip }}</p>
                                    @if($tip->longTip != null)
                                        <p>{{ $tip->longTip }}</p>
                                    @endif
                                    <p><b>Category:</b> {{ $tip->category->title }}</p>
                                    <div class="btn">
                                        <button type="button" class="btn btn-outline-danger" data-toggle="modal"
                                                data-target="#deleteTip{{ $loop->iteration }}">Delete
                                        </button>
                                        <button type="button" class="btn btn-outline-secondary" data-toggle="modal"
                                                data-target="#editTip{{ $loop->iteration }}">Edit
                                        </button>
                                    </div>
                                </li>
                                <!-- Delete Modal -->
                                <div>
                                    <div class="modal fade" id="deleteTip{{ $loop->iteration }}" tabindex="-1"
                                         role="dialog"
                                         aria-labelledby="deleteLabel"
                                         aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <form action="{{ route('tips.delete', $tip->id) }}"
                                                  method="POST">
                                                @csrf
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="deleteLabel">Delete tip or
                                                            trick</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close"><span
                                                                aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Are you sure you want to delete the tip or trick?
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
                                    <div class="modal fade" id="editTip{{ $loop->iteration }}" tabindex="-2"
                                         role="dialog"
                                         aria-labelledby="editLabel"
                                         aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <form action="{{ route('tips.edit', $tip->id) }}"
                                                  method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editLabel">Edit tip or
                                                            trick</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close"><span
                                                                aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="shortTip">Short tip or trick (will be
                                                                displayed within
                                                                slider)</label>
                                                            <input type="text" name="shortTip" id="shortTip"
                                                                   placeholder="Short tip or trick"
                                                                   value="{{ $tip->shortTip }}"
                                                                   class="form-control"
                                                                   autofocus>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="longTip">Longer description
                                                                (optional)</label>
                                                            <input type="text" name="longTip" id="longTip"
                                                                   placeholder="Longer description"
                                                                   value="{{ $tip->longTip }}"
                                                                   class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="category_id">Category:
                                                                <select name="category_id">
                                                                    <option value="1"
                                                                        {{ $tip->category_id == 1 ? 'selected' : ''}}>
                                                                        Hardware
                                                                    </option>
                                                                    <option value="2"
                                                                        {{ $tip->category_id == 2 ? 'selected' : ''}}>
                                                                        Software
                                                                    </option>
                                                                </select>
                                                            </label>
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
                <!-- No tips or tricks available -->
                    <div class="col-md">
                        <div class="card">
                            <h2 class="card-header">Oops!</h2>
                            <div class="card-body">
                                <p>There are no tips or tricks yet.</p>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
    </div>
    <!-- Create Modal -->
    <div>
        <div class="modal fade" id="createTip" tabindex="-3" role="dialog" aria-labelledby="createLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <form action="{{ route('tips.create') }}"
                      method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="createLabel">Add new tip or trick</h5>
                            <button type="button" class="close" data-dismiss="modal"
                                    aria-label="Close"><span
                                    aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="shortTip">Short tip or trick (will be displayed within
                                    slider)</label>
                                <input type="text" name="shortTip" id="shortTip"
                                       placeholder="Short tip or trick"
                                       class="form-control"
                                       autofocus>
                            </div>
                            <div class="form-group">
                                <label for="longTip">Longer description (optional)</label>
                                <input type="text" name="longTip" id="longTip"
                                       placeholder="Longer description"
                                       class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="category_id">Category:
                                    <select name="category_id">
                                        <option value="1">Hardware</option>
                                        <option value="2">Software</option>
                                    </select>
                                </label>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-danger" data-dismiss="modal">
                                Cancel
                            </button>
                            <button type="submit" class="btn btn-secondary">Upload</button>
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
