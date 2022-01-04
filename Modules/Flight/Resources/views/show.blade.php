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
                                    <select class="form-control select2" style="width: 100%;" disabled>

                                        <option value="{{ $flight->plane->id }}" selected>{{ $flight->plane->bland->name }} - {{ $flight->plane->total_passengers }} Passageiros</option>

                                    </select>
                                </div>
                            </div>

                            {{-- Origem --}}
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Origem:<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" readonly value="{{ $flight->origin->name }}">
                                </div>
                            </div>

                            {{-- Destino --}}
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Destino:<span class="text-danger">*</span></label>
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

                            {{-- Duração --}}
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Duração:</label>
                                    <input type="time" class="form-control" id="logradouro" readonly value="{{ $flight->time_duration }}">
                                </div>
                            </div>

                            {{-- Horas Saída --}}
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Horas Saída :</label>
                                    <input type="time" class="form-control" readonly value="{{ $flight->hour_output }}">
                                </div>
                            </div>

                            {{-- Horas Chegada --}}
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Horas Chegada: </label>
                                    <input type="time" class="form-control" readonly value="{{ $flight->arrival_time }}">
                                </div>
                            </div>

                            {{-- Preço Anterior --}}
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Preço Anterior:</label>
                                    <input type="text" class="form-control money" readonly value="{{ $flight->formatted_old_price }}">
                                </div>
                            </div>

                            {{-- Preço --}}
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Preço:</label>
                                    <input type="text" class="form-control money" readonly value="{{ $flight->formatted_price }}">
                                </div>
                            </div>

                            {{-- Total de Parelas --}}
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Total de Parcelas:</label>
                                    <input type="number" min="1" class="form-control" readonly value="{{ $flight->total_prots }}">
                                </div>
                            </div>

                            {{-- Promoção --}}
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Promoção:<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" readonly value="{{ $flight->formatted_is_promotion }}">
                                </div>
                            </div>

                            {{-- Quantidade de Paradas --}}
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Quantidade de Paradas:</label>
                                    <input type="number" min="1" class="form-control" readonly value="{{ $flight->qty_stops }}">
                                </div>
                            </div>


                        </div>
                    </div>

                    <div class="card-footer"></div>

                </div>

                <div class="card card-outline card-secondary">

                    <div class="card-header">
                        <h3 class="card-title">
                            Descrição
                        </h3>
                    </div>

                    <div class="card-body">
                        <div class="row">

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Descrição:</label>
                                    <textarea name="description" id="summernote-disable" cols="50" rows="5" class="form-control">{!! $flight->description !!}</textarea>
                                </div>
                            </div>

                            <div class="card-footer"></div>

                        </div>

                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-2">
                        <a href="{{ route('flight.edit', $flight->id) }}" class="btn btn-primary">
                            <i class="fas fa-pen"></i> Editar
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection

@section('footer-extras')
    <script src="{{ mix('js/flight.js') }}"></script>
@endsection
