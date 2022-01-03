<?php

namespace Modules\Plane\Entities;

use App\Traits\Presentable;
use Modules\Bland\Entities\Bland;
use Illuminate\Database\Eloquent\Model;
use Modules\Plane\Presenter\PlanePresenter;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Plane extends Model
{
    use SoftDeletes,
        HasFactory,
        Presentable;

    const ECONOMIC = "EC";

    const LUXURY = "LU";

    /**
     * Presenter
     *
     * @var string $presenter
     */
    protected $presenter = PlanePresenter::class;

    /**
     * Tabela do banco de dados
     *
     * @var string $table
     */
    protected $table = 'planes';

    /**
     * Atributos da tabela do banco de dados
     *
     * @var array $fillable
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
	| Relationship
	|--------------------------------------------------------------------------
	|
	| Definição dos métodos das entidades relacionadas.
	| Estes métodos são responsáveis pelas relações e permitem acessar
	| os atributos Eloquent obtidas das mesmas.
	|
	*/

    /**
     * Obtêm a marca
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function bland()
    {
        return $this->belongsTo(Bland::class)->withTrashed();
    }

    /**
     * Obtêm os voos
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function flights()
    {
        return $this->hasMany(Flight::class)->withTrashed();
    }

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
