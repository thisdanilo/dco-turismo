<?php

namespace Modules\Reserve\Entities;

use Carbon\Carbon;
use App\Models\User;
use App\Traits\Presentable;
use Modules\Flight\Entities\Flight;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Reserve\Presenter\ReservePresenter;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reserve extends Model
{
    use SoftDeletes,
        HasFactory,
        Presentable;

    const RESERVED = "RE";

    const CANCELED = "CA";

    const PAID = "PA";

    const CONCLUDED = "CO";

    /**
     * Presenter
     *
     * @var string $presenter
     */
    protected $presenter = ReservePresenter::class;

    /**
     * Tabela do banco de dados
     *
     * @var string $table
     */
    protected $table = 'reservations';

    /**
     * Atributos da tabela do banco de dados
     *
     * @var array<string> $fillable
     */
    protected $fillable = [
        'flight_id',
        'user_id',
        'date_reserved',
        'status'
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
    public function getFormattedStatusAttribute()
    {
        $data = [
            self::RESERVED => 'Reservado',
            self::CANCELED => 'Cancelado',
            self::PAID => 'Pago',
            self::CONCLUDED => 'Concluído'
        ];

        return $data[$this->status];
    }

    /**
     * Formata o atributo
     *
     * @return string
     */
    public function getFormattedDateReservedAttribute()
    {
        return Carbon::parse($this->date_reserved)->format('d/m/Y');
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
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Obtém os voos
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function flight()
    {
        return $this->belongsTo(Flight::class)->withTrashed();
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
        return \Modules\Reserve\Database\factories\ReserveFactory::new();
    }

    /**
     * Faz uma reserva
     *
     * @param int $flightId
     * @return boolean
     */
    public function newReserve($flightId)
    {
        $this->user_id = auth()->user()->id;
        $this->flight_id = $flightId;
        $this->date_reserved = date('Y-m-d');
        $this->status = self::RESERVED;

        return $this->save();
    }
}
