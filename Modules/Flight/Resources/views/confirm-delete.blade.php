@extends('flight::layouts.master')

@section('page_title', 'Voos')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-10">
                <ol class="breadcrumb float-sm-left">
                    <li class="breadcrumb-item">Voos</li>
                    <li class="breadcrumb-item active">Ver</li>
                </ol>
            </div>
        </div>
    </div>
@endsection

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">

                <form action="{{ route('flight.delete', $flight->id) }}" method="post">

                    {{-- Elementos Ocultos --}}
                    @csrf
                    @method('DELETE')

                    <div class="card card-outline card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">
                                Dados do Voo
                            </h3>
                        </div>

                        <div class="card-body">
                            <div class="row">


                                {{-- Avião --}}
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Escolha o avião:</label>
                                        <input type="text" class="form-control" readonly value="{{ $flight->plane->bland->name }} - {{ $flight->plane->total_passengers }} Passageiros">
                                    </div>
                                </div>

                                {{-- Origem --}}
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Origem:</label>
                                        <input type="text" class="form-control" readonly value="{{ $flight->origin->name }}">
                                    </div>
                                </div>

                                {{-- Destino --}}
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Destino:</label>
                                        <input type="text" class="form-control" readonly value="{{ $flight->destination->name }}">
                                    </div>
                                </div>

                                {{-- Data --}}
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Data:</label>
                                        <input type="date" class="form-control" readonly value="{{ $flight->date }}">
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="card-footer"></div>

                    </div>

                    {{-- Botão --}}
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <button type="submit" class="btn btn-danger">
                                    <i class="fas fa-trash"></i> Excluir
                                </button>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>

@endsection

@section('footer-extras')
    <script src="{{ mix('js/flight.js') }}"></script>
@endsection
