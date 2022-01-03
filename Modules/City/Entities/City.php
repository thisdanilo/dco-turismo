<?php

namespace Modules\City\Entities;

use Modules\State\Entities\State;
use Modules\Address\Entities\Address;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Airport\Entities\Airport;

class City extends Model
{
    use SoftDeletes,
        HasFactory;

    /**
     * Tabela do banco de dados
     *
     * @var string $table
     */
    protected $table = 'cities';

    /**
     * Atributos da tabela do banco de dados
     *
     * @var array $fillable
     */
    protected $fillable = [
        'state_id',
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
     * Obtém os estado
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function state()
    {
        return $this->belongsTo(State::class);
    }

    /**
     * Obtêm os aeroportos
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function airports()
    {
        return $this->hasMany(Airport::class);
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
        return \Modules\City\Database\factories\CityFactory::new();
    }
}
