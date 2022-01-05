@extends('flight::layouts.master')

@section('page_title', 'Voos')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-10">
                <ol class="breadcrumb float-sm-left">
                    <li class="breadcrumb-item">Voos</li>
                    <li class="breadcrumb-item active">Editar</li>
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
                <form action="{{ route('flight.update', $flight->id) }}" method="post">

                    {{-- Elementos Ocultos --}}
                    @csrf
                    @method('PUT')

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

                                            <option value="{{ $flight->plane->id }}" selected>{{ $flight->plane->bland->name }}</option>

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

                                            <option value="{{ $flight->origin->id }}" selected>{{ $flight->origin->name }}</option> --}}

                                            @foreach ($origins as $origin)

                                                <option value="{{ $origin->id }}">{{ $origin->name }}</option>

                                            @endforeach

                                        </select>
                                    </div>
                                </div>

                                {{-- Destino --}}
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Destino:<span class="text-danger">*</span></label>
                                        <select name="airport_destination_id" class="form-control select2" style="width: 100%;" required>

                                            <option value="{{ $flight->destination->id }}" selected>{{ $flight->destination->name }}</option> --}}

                                            @foreach ($destinations as $destination)

                                                <option value="{{ $destination->id }}">{{ $destination->name }}</option>

                                            @endforeach

                                        </select>
                                    </div>
                                </div>

                                {{-- Data --}}
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Data:<span class="text-danger"> *</span></label>
                                        <input type="date" name="date" class="form-control" required value="{{ $flight->date }}">
                                    </div>
                                </div>

                                {{-- Duração --}}
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Duração:<span class="text-danger"> *</span></label>
                                        <input type="time" name="time_duration" class="form-control" id="logradouro" required value="{{ $flight->time_duration }}">
                                    </div>
                                </div>

                                {{-- Horas Saída --}}
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Horas Saída :<span class="text-danger"> *</span></label>
                                        <input type="time" name="hour_output" class="form-control" required value="{{ $flight->hour_output }}">
                                    </div>
                                </div>

                                {{-- Horas Chegada --}}
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Horas Chegada: <span class="text-danger"> *</span></label>
                                        <input type="time" name="arrival_time" class="form-control" value="{{ $flight->arrival_time }}">
                                    </div>
                                </div>

                                {{-- Preço Anterior --}}
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Preço Anterior:<span class="text-danger"> *</span></label>
                                        <input type="text" name="old_price" class="form-control money" required value="{{ $flight->formatted_old_price }}">
                                    </div>
                                </div>

                                {{-- Preço --}}
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Preço:<span class="text-danger"> *</span></label>
                                        <input type="text" name="price" class="form-control money" required value="{{ $flight->formatted_price }}">
                                    </div>
                                </div>

                                {{-- Total de Parelas --}}
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Total de Parcelas:<span class="text-danger"> *</span></label>
                                        <input type="number" min="0" name="total_prots" class="form-control" required value="{{ $flight->total_prots }}">
                                    </div>
                                </div>

                                {{-- Promoção --}}
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Promoção:<span class="text-danger">*</span></label>
                                        <select name="is_promotion" class="form-control" style="width: 100%;" required>

                                            <option value="">Selecione</option>
                                            <option value="1" @if ($flight->is_promotion) selected @endif>Sim</option>
                                            <option value="0" @if ($flight->is_promotion) selected @endif>Não</option>

                                        </select>
                                    </div>
                                </div>

                                {{-- Quantidade de Paradas --}}
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Quantidade de Paradas:<span class="text-danger"> *</span></label>
                                        <input type="number" min="1" name="qty_stops" class="form-control" required value="{{ $flight->qty_stops }}">
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
                                        <textarea name="description" id="summernote" cols="50" rows="5" class="form-control">{!! $flight->description !!}</textarea>
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
