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
        <div class="col">
            <h1>Items</h1>
            <p>
                <button type="button" class="btn btn-outline-primary" data-toggle="modal"
                        data-target="#createItem">Create new item
                </button>
            </p>
            <p>Currently available items:</p>
            <div class="row">
                <!-- Show all available Items  -->
                @if (count($items)>0)
                    @foreach($items as $item)
                        <div class="col-md-4">
                            <div class="card">
                                <h2 class="card-header">{{ $item->name }}</h2>
                                <div class="card-body">
                                    <img alt="{{ $item->name }}" class="img-fluid"
                                         src="{{ $item->item_image_path . $item->item_image }}">
                                    <p><b>Category:</b> {{ $item->category->title }}<br>
                                        <b>Created:</b> {{ date("d F Y",strtotime($item->created_at)) }}
                                        at {{ date("g:ha",strtotime($item->created_at)) }}</p>
                                    <div class="btn">
                                        <button type="button" class="btn btn-outline-danger" data-toggle="modal"
                                                data-target="#deleteItem{{ $loop->iteration }}">Delete
                                        </button>
                                        <button type="button" class="btn btn-outline-secondary" data-toggle="modal"
                                                data-target="#editItem{{ $loop->iteration }}">Edit
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Delete Modal -->
                        <div>
                            <div class="modal fade" id="deleteItem{{ $loop->iteration }}" tabindex="-1" role="dialog"
                                 aria-labelledby="deleteLabel"
                                 aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <form action="{{ route('item.delete', $item->id) }}"
                                          method="POST">
                                        @csrf
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteLabel">Delete
                                                    item {{ $item->name }}</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close"><span
                                                        aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Are you sure you want to delete the item?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Cancel
                                                </button>
                                                <button type="submit" class="btn btn-outline-danger">Delete</button>
                                            </div>
                                        {{ method_field('DELETE') }}
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- Delete Modal end -->
                        <!-- Edit Modal -->
                        <div>
                            <div class="modal fade" id="editItem{{ $loop->iteration }}" tabindex="-2" role="dialog"
                                 aria-labelledby="editLabel"
                                 aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <form action="{{ route('item.edit', $item->id) }}"
                                          method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editLabel">Edit
                                                    item {{ $item->name }}</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close"><span
                                                        aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <p>
                                                        <img alt="{{ $item->name }}" class="img-fluid"
                                                             src="{{ $item->item_image_path . $item->item_image }}">
                                                    </p>
                                                    <p>
                                                        <label for="name">Item name</label>
                                                        <input type="text" name="name" id="name"
                                                               placeholder="New name of the item"
                                                               value="{{ $item->name }}"
                                                               class="form-control"
                                                               autofocus>
                                                    </p>
                                                </div>
                                                <div class="form-group">
                                                    <label for="new_item_image">Select a new item image with a
                                                        minimum size of 500x500
                                                        (optional)</label>
                                                    <input id="new_item_image" type="file"
                                                           class="form-control"
                                                           name="new_item_image">
                                                </div>
                                                <div class="form-group">
                                                    <label for="category_id">Category:
                                                        <select name="category_id">
                                                            <option value="1"
                                                                {{ $item->category_id == 1 ? 'selected' : ''}}>
                                                                Hardware
                                                            </option>
                                                            <option value="2"
                                                                {{ $item->category_id == 2 ? 'selected' : ''}}>
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
                                                <button type="submit" class="btn btn-secondary">Edit</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- Edit Modal end -->
            </div>
        @endforeach
        @else
            <!-- No Items -->
                <div class="col-md">
                    <div class="card">
                        <h2 class="card-header">Oops!</h2>
                        <div class="card-body">
                            <p>There are no items yet. Why don't you create one?</p>
                        </div>
                    </div>
                </div>
        </div>
        @endif
    </div>
    <!-- Create Modal -->
    <div>
        <div class="modal fade" id="createItem" tabindex="-3" role="dialog" aria-labelledby="createLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <form action="{{ route('item.create') }}"
                      method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="createLabel">Add new item</h5>
                            <button type="button" class="close" data-dismiss="modal"
                                    aria-label="Close"><span
                                    aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="name">Item name</label>
                                <input type="text" name="name" id="name"
                                       placeholder="Name of the item"
                                       class="form-control"
                                       autofocus>
                            </div>
                            <div class="form-group">
                                <label for="item_image">Select an item image with a minimum size of 500x500
                                    (optional)</label>
                                <input id="item_image" type="file"
                                       class="form-control"
                                       name="item_image">
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
                            <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cancel
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
