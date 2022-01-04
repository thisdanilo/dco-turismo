<?php

namespace Modules\Reserve\Entities;

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
     * @var array $fillable
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
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Obtêm os voos
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function flight()
    {
        return $this->belongsTo(Flight::class)->withTrashed();
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
    public function getFormattedStatusAttribute()
    {
        if ($this->status == self::RESERVED) {
            return 'Reservado';
        } elseif ($this->status == self::CANCELED) {
            return 'Cancelado';
        } elseif ($this->status == self::PAID) {
            return 'Pago';
        } elseif ($this->status == self::CONCLUDED) {
            return 'Concluído';
        }
    }

    /**
     * Formata o atributo
     *
     * @return string
     */
    public function getFormattedDateReservedAttribute()
    {
        return $this->date_reserved->format('d/m/Y');
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
}