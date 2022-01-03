@extends('airport::layouts.master')

@section('page_title', 'Aeroportos')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-10">
                <ol class="breadcrumb float-sm-left">
                    <li class="breadcrumb-item">Aeroportos</li>
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
                <div class="card card-outline card-secondary">

                    <div class="card-header">
                        <h3 class="card-title">
                            Dados do Aeroporto
                        </h3>
                    </div>

                    <div class="card-body">
                        <div class="row">

                            {{-- Nome --}}
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Nome:</label>
                                    <input type="text" class="form-control" value="{{ $airport->name }}" readonly>
                                </div>
                            </div>

                            {{-- CEP --}}
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>CEP:</label>
                                    <input type="text" class="form-control mask-zipcode" id="cep" value="{{ $airport->zip_code }}" readonly>
                                </div>
                            </div>

                            {{-- Endereço --}}
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Endereço:</label>
                                    <input type="text" class="form-control" id="logradouro" value="{{ $airport->address }}" readonly>
                                </div>
                            </div>

                            {{-- Número --}}
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Número:</label>
                                    <input type="text" class="form-control" value="{{ $airport->number }}" readonly>
                                </div>
                            </div>

                            {{-- Complemento --}}
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Complemento:</label>
                                    <input type="text" class="form-control" value="{{ $airport->complement }}" readonly>
                                </div>
                            </div>

                            {{-- Latitude --}}
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Latitude:</label>
                                    <input type="text" class="form-control" value="{{ $airport->latitude }}" readonly>
                                </div>
                            </div>

                            {{-- Longitude --}}
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Longitude:</label>
                                    <input type="text" class="form-control" value="{{ $airport->longitude }}" readonly>
                                </div>
                            </div>

                            {{-- Cidade --}}
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Cidade:</label>
                                    <input type="text" class="form-control" value="{{ $airport->city->name }}" readonly>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="card-footer"></div>

                </div>

                <div class="row">
                    <div class="col-sm-2">
                        <a href="{{ route('airport.edit', $airport->id) }}" class="btn btn-primary">
                            <i class="fas fa-pen"></i> Editar
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection

@section('footer-extras')
    <script src="{{ mix('js/airport.js') }}"></script>
@endsection
