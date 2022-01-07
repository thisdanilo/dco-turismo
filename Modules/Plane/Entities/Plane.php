<?php

namespace Modules\Plane\Entities;

use Modules\Bland\Entities\Bland;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Plane extends Model
{
    use SoftDeletes,
        HasFactory;

    const ECONOMIC = "EC";

    const LUXURY = "LU";

    /**
     * Tabela do banco de dados
     *
     * @var string $table
     */
    protected $table = 'planes';

    /**
     * Atributos da tabela do banco de dados
     *
     * @var array<string> $fillable
     */
    protected $fillable = [
        'bland_id',
        'total_passengers',
        'class'
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
	| Accessors
	|--------------------------------------------------------------------------
	|
	| Definição dos métodos GET desta entidade.
	| Estes métodos permitem formatar os atributos Eloquent obtidos do banco de dados.
	|
	*/

    /**
     * Formata o atributo
     *
     * @return string
     */
    public function getFormattedClassAttribute()
    {
        return $this->class == 'EC' ? 'Econômico' : 'Luxo';
    }

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
    public function bland()
    {
        return $this->belongsTo(Bland::class)->withTrashed();
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
        return \Modules\Plane\Database\factories\PlaneFactory::new();
    }
}
