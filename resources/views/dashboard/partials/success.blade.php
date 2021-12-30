@if (session()->has('message'))

    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <i class="icon fa fa-check"></i><em>{{ session()->get('message') }}</em>
    </div>

@endif
