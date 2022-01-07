<div class="dropdown">
    <button aria-expanded="false" type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
        <span class="caret"></span>
        <span class="sr-only">Toggle Dropdown</span>
    </button>

    <ul class="dropdown-menu text-center" style="min-width: 100%!important">

        <li><a href="{{ route('reserve.show', ['id' => $reserve->id]) }}" class="text-dark">Ver</a></li>
        <li><a href="{{ route('reserve.edit', ['id' => $reserve->id]) }}" class="text-dark">Editar</a></li>
        <li><a href="{{ route('reserve.confirm_delete', ['id' => $reserve->id]) }}" class="text-dark">Excluir</a></li>

    </ul>
</div>
