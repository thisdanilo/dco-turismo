@extends('flight::layouts.master')

@section('page_title', 'Voos')

@section('header-extras')
@endsection

@section('content_header')

    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-10">
                <ol class="breadcrumb float-sm-left">
                    <li class="breadcrumb-item">Voos</li>
                    <li class="breadcrumb-item active">Painel de Controle</li>
                </ol>
            </div>
            <div class="col-sm-2 text-right">
                <a href="{{ route('flight.create') }}" class="btn btn-success">
                    <i class="fa fa-plus fa-fw"></i> Cadastrar
                </a>
            </div>
        </div>
    </div>

@endsection

@section('content')

    {{-- Respostas --}}
    @include('dashboard.partials.errors')
    @include('dashboard.partials.success')

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        {{-- Elementos Ocultos --}}
                        @csrf
                        <input type="hidden" id="route_datatable" value="{{ route('flight.datatable') }}">

                        <table class="table table-bordered table-striped" id="ajax-datatable">
                            <thead>
                                <tr>
                                    <th>Data</th>
                                    <th>Duração</th>
                                    <th>Preço</th>
                                    <th>Avião</th>
                                    <th>Origem</th>
                                    <th>Destino</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                            <tfoot>
                                <tr>
                                    <th>Data</th>
                                    <th>Duração</th>
                                    <th>Preço</th>
                                    <th>Avião</th>
                                    <th>Origem</th>
                                    <th>Destino</th>
                                    <th>Ações</th>
                                </tr>
                            </tfoot>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('footer-extras')
    <script src="{{ mix('js/flight.js') }}"></script>
@endsection
