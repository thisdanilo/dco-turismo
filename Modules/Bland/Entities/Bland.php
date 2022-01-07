<?php

namespace Modules\Bland\Entities;

use Modules\Plane\Entities\Plane;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Bland extends Model
{
	use SoftDeletes,
		HasFactory;

	/**
	 * Tabela do banco de dados
	 *
	 * @var string $table
	 */
	protected $table = 'blands';

	/**
	 * Atributos da tabela do banco de dados
	 *
	 * @var array<string> $fillable
	 */
	protected $fillable = [
		'name'
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
	 * Obtêm os aviões
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function planes()
	{
		return $this->hasMany(Plane::class)->withTrashed();
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
		return \Modules\Bland\Database\factories\BlandFactory::new();
	}
}
