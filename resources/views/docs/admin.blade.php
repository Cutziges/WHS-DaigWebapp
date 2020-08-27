@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col">
            <!-- Display Messages -->
        @include('flash-message')
        <!-- End Messages -->

            <h1>{{ $category }} Documentations</h1>
            <p>The following hardware items are available.</p>
        </div>
    </div>
    <div class="row">
        <!-- Show all available items  -->
        @if (count($items)>0)
            @foreach($items as $item)
                <div class="col-md-4">
                    <div class="card">
                        <h2 class="card-header">{{ $item->name }}</h2>
                        <div class="card-body">
                            <img alt="{{ $item->name }}" class="img-fluid"
                                 src="{{ $item->item_image_path . $item->item_image }}">
                            <h5 class="card-title">Documents</h5>
                            <p>
                                <button type="button" class="btn btn-outline-primary" data-toggle="modal"
                                        data-target="#createDocument{{ $loop->iteration }}{{$item->id}}">Upload document
                                </button>
                            </p>
                            <!-- Show if there are documents for item -->
                            @if (count($item->docs)>0)
                                <ul class="list-group">
                                @foreach($item->docs as $doc)
                                    <!-- Show all available documents  -->
                                        <li class="list-group-item">
                                            <p>Name: {{ $doc->title }}
                                                (<a href="{{ asset($doc->file_path . $doc->file )}}"
                                                    target="_blank">show</a>)</p>
                                            <p>Created: {{ date("d F Y",strtotime($doc->created_at)) }}
                                                at {{ date("g:ha",strtotime($doc->created_at)) }}</p>
                                            <div class="btn">
                                                <button type="button" class="btn btn-outline-danger"
                                                        data-toggle="modal"
                                                        data-target="#deleteDocument{{ $loop->iteration }}{{$item->id}}">
                                                    Delete
                                                </button>
                                                <button type="button" class="btn btn-outline-secondary"
                                                        data-toggle="modal"
                                                        data-target="#editDocument{{ $loop->iteration }}{{$item->id}}">
                                                    Edit
                                                </button>
                                            </div>
                                        </li>
                                        <!-- Delete Modal -->
                                        <div>
                                            <div class="modal fade"
                                                 id="deleteDocument{{ $loop->iteration }}{{$item->id}}"
                                                 tabindex="-1" role="dialog"
                                                 aria-labelledby="deleteLabel"
                                                 aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <form class="modal-content"
                                                          action="{{ route('docs.delete', $doc->id) }}"
                                                          method="POST">
                                                        @csrf
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="deleteLabel">Delete
                                                                    document {{ $doc->title }}</h5>
                                                                <button type="button" class="close"
                                                                        data-dismiss="modal"
                                                                        aria-label="Close"><span
                                                                        aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Are you sure you want to delete the document?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">Cancel
                                                                </button>
                                                                <button type="submit"
                                                                        class="btn btn-outline-danger">Delete
                                                                </button>
                                                            </div>
                                                        </div>
                                                        {{ method_field('DELETE') }}
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Delete Modal end -->
                                        <!-- Edit Modal -->
                                        <div>
                                            <div class="modal fade" id="editDocument{{ $loop->iteration }}{{$item->id}}"
                                                 tabindex="-2" role="dialog"
                                                 aria-labelledby="editLabel"
                                                 aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <form action="{{ route('docs.edit', $doc->id) }}"
                                                          method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="editLabel">Edit
                                                                    document {{ $doc->title }}</h5>
                                                                <button type="button" class="close"
                                                                        data-dismiss="modal"
                                                                        aria-label="Close"><span
                                                                        aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="form-group">
                                                                    <label for="title">Document title</label>
                                                                    <input type="text" name="title" id="title"
                                                                           placeholder="New title of the document"
                                                                           value="{{ $doc->title }}"
                                                                           class="form-control"
                                                                           autofocus>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="data">Upload a new document
                                                                        (optional)</label>
                                                                    <input id="new_file" type="file"
                                                                           class="form-control"
                                                                           name="new_file">
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button"
                                                                        class="btn btn-outline-danger"
                                                                        data-dismiss="modal">Cancel
                                                                </button>
                                                                <button type="submit" class="btn btn-secondary">
                                                                    Edit
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Edit Modal end -->
                                @endforeach
                                <!-- No documents -->
                                    @else
                                        <p>There are no documents yet.</p>
                                    @endif
                                </ul>
                        </div>
                    </div>
                </div>
                <!-- Create Modal -->
                <div>
                    <div class="modal fade" id="createDocument{{ $loop->iteration }}{{$item->id}}" tabindex="-1"
                         role="dialog"
                         aria-labelledby="createLabel"
                         aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <form action="{{ route('docs.create', $item->id) }}"
                                  method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="createLabel">Upload new document</h5>
                                        <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close"><span
                                                aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="title">Document title</label>
                                            <input type="text" name="title" id="title"
                                                   placeholder="Title of the document"
                                                   class="form-control"
                                                   autofocus>
                                        </div>
                                        <div class="form-group">
                                            <label for="data">Select a document</label>
                                            <input id="file" type="file"
                                                   class="form-control"
                                                   name="file">
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
            @endforeach
        @else
        <!-- No items -->
            <div class="col-md">
                <div class="card">
                    <h2 class="card-header">Oops!</h2>
                    <div class="card-body">
                        <p>There are no items yet.</p>
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
