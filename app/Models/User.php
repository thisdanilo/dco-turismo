<?php

namespace App\Models;

use App\Traits\Presentable;
use Laravel\Sanctum\HasApiTokens;
use Modules\Reserve\Entities\Reserve;
use Illuminate\Notifications\Notifiable;
use Modules\User\Presenter\UserPresenter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens,
        HasFactory,
        Notifiable,
        Presentable;

    /**
     * Presenter
     *
     * @var string $presenter
     */
    protected $presenter = UserPresenter::class;

    /**
     * Tabela do banco de dados
     *
     * @var string $table
     */
    protected $table = 'users';

    /**
     * Atributos da tabela do banco de dados
     *
     * @var array<string> $fillable
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * Atributos da tabela do banco de dados
     *
     * @var array $dates
     */
    protected $dates = [
        'created_at',
        'updated_at'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
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
     * Obtêm as reservas
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reserves()
    {
        return $this->hasMany(Reserve::class);
    }
}
