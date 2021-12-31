<?php

namespace App\Presenter;

use Illuminate\Database\Eloquent\Model;

abstract class Presenter
{
	protected $model;

	/**
	 * Presenter constructor.
	 *
	 * @param Model $model
	 */
	public function __construct(Model $model)
	{
		$this->model = $model;
	}

	/*
	|--------------------------------------------------------------------------
	| Entity
	|--------------------------------------------------------------------------
	|
	| Método que define e verifica a entidade relacionada as regras de negócio
	| da camada view.
	|
	*/

	/**
	 * Chamada do Modelo
	 *
	 * @param mixed $method
	 * @param array $arguments
	 * @return mixed
	 */
	public function __call($method, $arguments)
	{
		if (!method_exists($this->model, $method)) {
			throw new \BadMethodCallException("Nenhum método {$method}");
		}

		return call_user_func_array([$this->model, $method], $arguments);
	}
}
