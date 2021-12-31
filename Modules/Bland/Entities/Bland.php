<?php

namespace Modules\Bland\Entities;

use App\Traits\Presentable;
use Illuminate\Database\Eloquent\Model;
use Modules\Bland\Presenter\BlandPresenter;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bland extends Model
{
    use SoftDeletes,
        Presentable;

    /**
     * Presenter
     *
     * @var string $presenter
     */
    protected $presenter = BlandPresenter::class;

    /**
     * Tabela do banco de dados
     *
     * @var string $table
     */
    protected $table = 'blands';

    /**
     * Atributos da tabela do banco de dados
     *
     * @var array $fillable
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
}
