

@if(Session::get('flashType') == 'success')
    <div class="alert alert-success alert-block alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        {{ Session::get('message') }}
    </div>
@endif


@if ($errors->any())
    <div class="alert alert-danger alert-block alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </div>
@endif


@if(Session::get('flashType') == 'warning')
    <div class="alert alert-warning alert-block alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        {{ Session::get('message') }}
    </div>
@endif


@if(Session::get('flashType') == 'info')
    <div class="alert alert-info alert-block alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        {{ Session::get('message') }}
    </div>
@endif
