<?php

namespace Modules\Reserve\Presenter;

use App\Presenter\Presenter;

class ReservePresenter extends Presenter
{
	/*
	|--------------------------------------------------------------------------
	| Function View
	|--------------------------------------------------------------------------
	|
	| Definições dos métodos relacionados as regras de negócio.
	| Métodos que definem a formatação dos dados que serão apresentados na view.
	|
	*/

	/**
	 * Obtém o botao de ação
	 *
	 * @return string
	 */
	public function actionView()
	{
		return '<div class="dropdown">
                <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-cog" aria-hidden="true"></i>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="' . route('reserve.show', $this->model->id) . '">Ver</a>
                <a class="dropdown-item" href="' . route('reserve.edit', $this->model->id) . '">Editar</a>
                <a class="dropdown-item" href="' . route('reserve.confirm_delete', $this->model->id) . '">Excluir</a>
                </div>';
	}
}
