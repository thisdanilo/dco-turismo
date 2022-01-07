<div class="dropdown">
    <button aria-expanded="false" type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
        <span class="caret"></span>
        <span class="sr-only">Toggle Dropdown</span>
    </button>

    <ul class="dropdown-menu text-center">
        <li><a href="{{ route('plane.show', ['id' => $plane->id]) }}" class="text-dark">Ver</a></li>
        <li><a href="{{ route('plane.edit', ['id' => $plane->id]) }}" class="text-dark">Editar</a></li>
        <li><a href="{{ route('plane.confirm_delete', ['id' => $plane->id]) }}" class="text-dark">Excluir</a></li>
    </ul>
</div>
