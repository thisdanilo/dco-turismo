<?php

namespace Modules\Plane\Http\Controllers;

use Yajra\DataTables\DataTables;
use Modules\Bland\Entities\Bland;
use Modules\Plane\Entities\Plane;
use Illuminate\Routing\Controller;
use Modules\Plane\Services\PlaneService;
use Modules\Plane\Http\Requests\PlaneRequest;

class PlaneController extends Controller
{
    protected $plane;

    protected $plane_service;

    /**
     * Método Construtor
     *
     * @param \Modules\Plane\Entities\Plane $plane
     * @param \Modules\Plane\Services\PlaneService $plane_service
     * @return void
     */
    public function __construct(
        Plane $plane,
        PlaneService $plane_service
    ) {
        $this->plane = $plane;
        $this->plane_service = $plane_service;
    }

    /**
     * Exibe a tela inicial com a listagem de dados.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('plane::index');
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
        $planes = $this->plane->with('bland');

        return DataTables::of($planes)
            ->editColumn("class", function ($plane) {
                return $plane->formatted_class;
            })
            ->addColumn(
                "action",
                function ($plane) {
                    return $plane->actionView();
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
        $blands = Bland::orderBy('name', 'Asc')->get();

        return view('plane::create', compact('blands'));
    }

    /**
     * Cadastra e retorna para a tela inicial
     *
     * @param  \Modules\Plane\Http\Requests\PlaneRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(PlaneRequest $request)
    {
        $this->plane_service->updateOrCreate($request->all());

        return redirect()
            ->route('plane.index')
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
        $plane = $this->plane->with('bland')->findOrFail($id);

        return view('plane::show', compact('plane'));
    }

    /**
     * Exibe os dados para edição
     *
     * @param  int $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $plane = $this->plane->with('bland')->findOrFail($id);

        $blands = Bland::orderBy('name', 'ASC')
            ->where('id', '!=', $plane->bland->id ?? '')
            ->get();

        return view('plane::edit', compact('plane','blands'));
    }

    /**
     * Atualiza e retorna para a tela de edição
     *
     * @param  \Modules\Plane\Http\Requests\PlaneRequest $request
     * @param  int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(PlaneRequest $request, $id)
    {
        $plane = $this->plane->findOrFail($id);

        $this->plane_service->updateOrCreate($request->all(), $plane->id);

        return redirect()
            ->route('plane.edit', $plane->id)
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
        $plane = $this->plane->findOrFail($id);

        return view('plane::confirm-delete', compact('plane'));
    }

    /**
     * Exclui e retorna para a tela inicial
     *
     * @param  int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        $plane = $this->plane->findOrFail($id);

        $this->plane_service->removeData($plane);

        return redirect()
            ->route('plane.index')
            ->with('message', 'Exclusão realizada com sucesso.');
    }
}
