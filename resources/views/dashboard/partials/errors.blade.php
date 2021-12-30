@if (count($errors))

    <ul class="alert alert-warning alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>

        @foreach ($errors->all() as $error)

            <li style="margin-left: 14px;">{{ $error }}</li>

        @endforeach

    </ul>

@endif

@if (session()->has('alert'))

    <div class="alert alert-warning alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <i class="icon fa fa-bullhorn"></i><em>{{ session()->get('alert') }}</em>
    </div>

@endif
