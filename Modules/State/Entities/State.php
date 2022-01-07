<?php

namespace Modules\State\Entities;

use Modules\City\Entities\City;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class State extends Model
{
	use SoftDeletes,
		HasFactory;

	/**
	 * Tabela do banco de dados
	 *
	 * @var string $table
	 */
	protected $table = 'states';

	/**
	 * Atributos da tabela do banco de dados
	 *
	 * @var array<string> $fillable
	 */
	protected $fillable = [
		'name',
		'abbr'
	];

	/**
	 * Atributos da tabela do banco de dados
	 *
	 * @var array $dates
	 */
	protected $dates = [
		'created_at',
		'updated_at',
		'deleted_at'
	];

	/*
	|--------------------------------------------------------------------------
	| Relationship
	|--------------------------------------------------------------------------
	|
	| Definição dos métodos das entidades relacionadas.
	| Estes métodos são responsáveis pelas relações e permitem acessar
	| os atributos Eloquent obtidas das mesmas.
	|
	*/

	/**
	 * Obtêm as cidades
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function cities()
	{
		return $this->hasMany(City::class);
	}

	/*
	|--------------------------------------------------------------------------
	| Defining a Function
	|--------------------------------------------------------------------------
	|
	| Definição dos métodos complementares a esta entidade.
	| Estes métodos permitem definir as regras de negócio ou demais ações desta entidade.
	|
	*/

	/**
	 * Create a new factory instance for the model.
	 *
	 * @return \Illuminate\Database\Eloquent\Factories\Factory
	 */
	protected static function newFactory()
	{
		return \Modules\State\Database\factories\StateFactory::new();
	}
}
