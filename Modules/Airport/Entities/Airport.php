<?php

namespace Modules\Airport\Entities;

use App\Traits\Presentable;
use Modules\City\Entities\City;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Airport\Presenter\AirportPresenter;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Airport extends Model
{
    use SoftDeletes,
        HasFactory,
        Presentable;

    /**
     * Presenter
     *
     * @var string $presenter
     */
    protected $presenter = AirportPresenter::class;

    /**
     * Tabela do banco de dados
     *
     * @var string $table
     */
    protected $table = 'airports';

    /**
     * Atributos da tabela do banco de dados
     *
     * @var array<string> $fillable
     */
    protected $fillable = [
        'city_id',
        'name',
        'latitude',
        'longitude',
        'address',
        'number',
        'zip_code',
        'complement'
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
     * Obtém a marca
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function city()
    {
        return $this->belongsTo(City::class);
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
        return \Modules\Airport\Database\factories\AirportFactory::new();
    }
}
