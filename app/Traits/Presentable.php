<?php

namespace App\Traits;

trait Presentable
{
	/**
	 * Presenter instance
	 *
	 * @var mixed
	 */
	protected $presenter_instance;

	/**
	 * Prepare a new presenter instance
	 *
	 * @return mixed
	 * @throws \Exception
	 */
	public function present()
	{
		if (!$this->presenter_instance) {
			$this->presenter_instance = new $this->presenter($this);
		}

		return $this->presenter_instance;
	}

	/**
	 * Call presenter methods
	 *
	 * @param mixed $method
	 * @param array $arguments
	 * @return mixed
	 * @throws \Exception
	 */
	public function __call($method, $arguments)
	{
		if (method_exists($this->present(), $method)) {
			return call_user_func_array([$this->present(), $method], $arguments);
		}

		return parent::__call($method, $arguments);
	}
}
