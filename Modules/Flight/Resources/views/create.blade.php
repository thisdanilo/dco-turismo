@extends('flight::layouts.master')

@section('page_title', 'Aeroportos')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-10">
                <ol class="breadcrumb float-sm-left">
                    <li class="breadcrumb-item">Voos</li>
                    <li class="breadcrumb-item active">Cadastro</li>
                </ol>
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
            <div class="col-md-12">
                <form action="{{ route('flight.store') }}" method="post">

                    {{-- Elementos Ocultos --}}
                    @csrf

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
                                        <label>Escolha o avião:<span class="text-danger">*</span></label>
                                        <select name="plane_id" class="form-control select2" style="width: 100%;" required>

                                            <option value="">Selecione</option>

                                            @foreach ($planes as $plane)

                                                <option value="{{ $plane->id }}">{{ $plane->bland->name }} - {{ $plane->total_passengers }} Passageiros</option>

                                            @endforeach

                                        </select>
                                    </div>
                                </div>

                                {{-- Origem --}}
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Origem:<span class="text-danger">*</span></label>
                                        <select name="airport_origin_id" class="form-control select2" style="width: 100%;" required>

                                            <option value="">Selecione</option>

                                            @foreach ($airports as $airport)

                                                <option value="{{ $airport->id }}">{{ $airport->name }}</option>

                                            @endforeach

                                        </select>
                                    </div>
                                </div>

                                {{-- Destino --}}
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Destino:<span class="text-danger">*</span></label>
                                        <select name="airport_destination_id" class="form-control select2" style="width: 100%;" required>

                                            <option value="">Selecione</option>

                                            @foreach ($airports as $airport)

                                                <option value="{{ $airport->id }}">{{ $airport->name }}</option>

                                            @endforeach

                                        </select>
                                    </div>
                                </div>

                                {{-- Data --}}
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Data:<span class="text-danger"> *</span></label>
                                        <input type="date" name="date" class="form-control" required>
                                    </div>
                                </div>

                                {{-- Duração --}}
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Duração:<span class="text-danger"> *</span></label>
                                        <input type="time" name="time_duration" class="form-control" id="logradouro" required>
                                    </div>
                                </div>

                                {{-- Horas Saída --}}
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Horas Saída :<span class="text-danger"> *</span></label>
                                        <input type="time" name="hour_output" class="form-control" required>
                                    </div>
                                </div>

                                {{-- Horas Chegada --}}
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Horas Chegada: <span class="text-danger"> *</span></label>
                                        <input type="time" name="arrival_time" class="form-control">
                                    </div>
                                </div>

                                {{-- Preço Anterior --}}
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Preço Anterior:<span class="text-danger"> *</span></label>
                                        <input type="text" name="old_price" class="form-control money" required>
                                    </div>
                                </div>

                                {{-- Preço --}}
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Preço:<span class="text-danger"> *</span></label>
                                        <input type="text" name="price" class="form-control money" required>
                                    </div>
                                </div>

                                {{-- Total de Parelas --}}
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Total de Parcelas:<span class="text-danger"> *</span></label>
                                        <input type="number" min="1" name="total_prots" class="form-control" required>
                                    </div>
                                </div>

                                {{-- Promoção --}}
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Promoção:<span class="text-danger">*</span></label>
                                        <select name="is_promotion" class="form-control" style="width: 100%;" required>

                                            <option value="">Selecione</option>
                                            <option value="1">Sim</option>
                                            <option value="0">Não</option>

                                        </select>
                                    </div>
                                </div>

                                {{-- Quantidade de Paradas --}}
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Quantidade de Paradas:<span class="text-danger"> *</span></label>
                                        <input type="number" min="1" name="qty_stops" class="form-control" required>
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
                                        <textarea name="description" id="summernote" cols="50" rows="5" class="form-control"></textarea>
                                    </div>
                                </div>

                                <div class="card-footer"></div>

                            </div>

                        </div>
                    </div>

                     {{-- Botão --}}
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <button type="submit" class="btn btn-success">
                                    <i class="fa fa-plus fa-fw"></i> Salvar
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
