<?php

namespace Modules\Bland\Http\Controllers;

use Yajra\DataTables\DataTables;
use Modules\Bland\Entities\Bland;
use Illuminate\Routing\Controller;
use Modules\Bland\Services\BlandService;
use Modules\Bland\Http\Requests\BlandRequest;

class BlandController extends Controller
{
    protected $bland;

    protected $bland_service;

    /**
     * Método Construtor
     *
     * @param \Modules\Bland\Entities\Bland $bland
     * @param \Modules\Bland\Services\BlandService $bland_service
     * @return void
     */
    public function __construct(
        Bland $bland,
        BlandService $bland_service
    ) {
        $this->bland = $bland;
        $this->bland_service = $bland_service;
    }

    /**
     * Exibe a tela inicial com a listagem de dados.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('bland::index');
    }

    /**
     * Obtêm os dados para a tabela
     *
     * @codeCoverageIgnore
     *
     * @return string
     */
    public function dataTable()
    {
        $blands = $this->bland->query();

        return DataTables::of($blands)
            ->addColumn(
                "action",
                function ($bland) {
                    return $bland->actionView();
                }
            )
            ->rawColumns([
                'action'
            ])
            ->make(true);
    }

    /**
     * Exibe a tela de cadastro
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('bland::create');
    }

    /**
     * Cadastra e retorna para a tela inicial
     *
     * @param  \Modules\Bland\Http\Requests\BlandRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(BlandRequest $request)
    {
        $this->bland_service->updateOrCreate($request->all());

        return redirect()
            ->route('bland.index')
            ->with('message', 'Cadastro realizado com sucesso.');
    }

    /**
     * Exibe os dados
     *
     * @param  int $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $bland = $this->bland->findOrFail($id);

        return view('bland::show', compact('bland'));
    }

    /**
     * Exibe os dados para edição
     *
     * @param  int $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $bland = $this->bland->findOrFail($id);

        return view('bland::edit', compact('bland'));
    }

    /**
     * Atualiza e retorna para a tela de edição
     *
     * @param  \Modules\Bland\Http\Requests\BlandRequest $request
     * @param  int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(BlandRequest $request, $id)
    {
        $bland = $this->bland->findOrFail($id);

        $this->bland_service->updateOrCreate($request->all(), $bland->id);

        return redirect()
            ->route('bland.edit', $bland->id)
            ->with('message', 'Atualização realizada com sucesso.');
    }

    /**
     * Exibe a tela para exclusão
     *
     * @param  int $id
     * @return \Illuminate\View\View
     */
    public function confirmDelete($id)
    {
        $bland = $this->bland->findOrFail($id);

        return view('bland::confirm-delete', compact('bland'));
    }

    /**
     * Exclui e retorna para a tela inicial
     *
     * @param  int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        $bland = $this->bland->findOrFail($id);

        $this->bland_service->removeData($bland);

        return redirect()
            ->route('bland.index')
            ->with('message', 'Exclusão realizada com sucesso.');
    }
}
