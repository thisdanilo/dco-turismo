<div class="dropdown">
    <button aria-expanded="false" type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
        <span class="caret"></span>
        <span class="sr-only">Toggle Dropdown</span>
    </button>

    <ul class="dropdown-menu text-center">

        <li><a href="{{ route('user.show', ['id' => $user->id]) }}" class="text-dark">Ver</a></li>
        <li><a href="{{ route('user.edit', ['id' => $user->id]) }}" class="text-dark">Editar</a></li>
        <li><a href="{{ route('user.confirm_delete', ['id' => $user->id]) }}" class="text-dark">Excluir</a></li>

    </ul>
</div>
