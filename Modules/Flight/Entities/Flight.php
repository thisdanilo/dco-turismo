<?php

namespace Modules\Flight\Entities;

use App\Traits\Presentable;
use Modules\Plane\Entities\Plane;
use Modules\Airport\Entities\Airport;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Flight\Presenter\FlightPresenter;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Flight extends Model
{
    use SoftDeletes,
        HasFactory,
        Presentable;

    /**
     * Presenter
     *
     * @var string $presenter
     */
    protected $presenter = FlightPresenter::class;

    /**
     * Tabela do banco de dados
     *
     * @var string $table
     */
    protected $table = 'flights';

    /**
     * Atributos da tabela do banco de dados
     *
     * @var array $fillable
     */
    protected $fillable = [
        'plane_id',
        'airport_origin_id',
        'airport_destination_id',
        'date',
        'time_duration',
        'hour_output',
        'arrival_time',
        'old_price',
        'price',
        'total_prots',
        'is_promotion',
        'qty_stops',
        'description',
        'image',
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

    /**
     * Trativa da tabela do banco de dados
     *
     *  @var array $casts
     */
    protected $casts = [
        'active' => 'boolean',
        'old_price' => 'float',
        'price' => 'float'
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
     * Obtém o avião
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function plane()
    {
        return $this->belongsTo(Plane::class)->withTrashed();
    }

    /**
     * Obtém a origem
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function origin()
    {
        return $this->belongsTo(Airport::class, 'airport_origin_id')->withTrashed();
    }

    /**
     * Obtém o destino
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function destination()
    {
        return $this->belongsTo(Airport::class, 'airport_destination_id')->withTrashed();
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
    public function getFormattedIsPromotionAttribute()
    {
        return $this->is_promotion ? "Sim" : "Não";
    }

    /**
     * Formata o atributo
     *
     * @return string
     */
    public function getFormattedOldPriceAttribute()
    {
        return number_format($this->attributes['old_price'], 2, ',', '.');
    }

    /**
     * Formata o atributo
     *
     * @return string
     */
    public function getFormattedPriceAttribute()
    {
        return number_format($this->attributes['price'], 2, ',', '.');
    }

    // /**
    //  * Formata o atributo
    //  *
    //  * @return string
    //  */
    // public function getFormattedTimeDurationAttribute()
    // {
    //     return $this->time_duration->format('H:i:s');
    // }

    /*
	|--------------------------------------------------------------------------
	| Mutators
	|--------------------------------------------------------------------------
	|
	| Definição dos métodos SET desta entidade.
	| Estes métodos permitem formatar os atributos para o banco de dados.
	|
	*/

    /**
     * Formata o atributo
     *
     * @param string $value
     * @return void
     */
    public function setOldPriceAttribute($value)
    {
        $this->attributes['old_price'] = str_replace(',', '.', str_replace('.', '', $value));
    }

    /**
     * Formata o atributo
     *
     * @param string $value
     * @return void
     */
    public function setPriceAttribute($value)
    {
        $this->attributes['price'] = str_replace(',', '.', str_replace('.', '', $value));
    }
}
