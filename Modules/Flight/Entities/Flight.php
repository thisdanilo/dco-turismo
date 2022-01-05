<?php

namespace Modules\Flight\Entities;

use App\Traits\Presentable;
use Modules\Plane\Entities\Plane;
use Modules\Airport\Entities\Airport;
use Modules\Reserve\Entities\Reserve;
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
     * @var array<string> $fillable
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
        'is_promotion' => 'boolean',
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

    /**
     * Obtêm as reservas
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reserves()
    {
        return $this->hasMany(Reserve::class)->where('status', '<>', Reserve::CANCELED)->withTrashed();
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
        return \Modules\Flight\Database\factories\FlightFactory::new();
    }

    /**
     * Filtra o voo.
     *
     * @return string
     */
    public function searchFlights($origin, $destination, $date)
    {
        return $this->where('airport_origin_id', $origin)
            ->where('airport_destination_id', $destination)
            ->where('date', $date)
            ->get();
    }

    /**
     * Filtra a promoção.
     *
     * @return string
     */
    public function promotions()
    {
        return $this->where('is_promotion', true)
            ->where('date', '>=', date('Y-m-d'))
            ->with(['origin.city', 'destination.city'])
            ->get();
    }
}
