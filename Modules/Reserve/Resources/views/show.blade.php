@extends('reserve::layouts.master')

@section('page_title', 'Reservas')

@section('content_header')

    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-10">
                <ol class="breadcrumb float-sm-left">
                    <li class="breadcrumb-item">Reservas</li>
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
                            Dados da Reserva
                        </h3>
                    </div>

                    <div class="card-body">
                        <div class="row">

                            {{-- Usuário --}}
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Usuário:</label>
                                    <input type="text" class="form-control" value="{{ $reserve->user->name }}" readonly>
                                </div>
                            </div>

                            {{-- Data do voo --}}
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Data do voo:</label>
                                    <input type="date" class="form-control" value="{{ $reserve->flight->date }}" readonly>
                                </div>
                            </div>

                            {{-- Data da reserva --}}
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Data da reserva:</label>
                                    <input type="date" class="form-control" value="{{ $reserve->date_reserved }}" readonly>
                                </div>
                            </div>

                            {{-- Status --}}
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Status:</label>
                                    <input type="text" class="form-control" value="{{ $reserve->formatted_status }}" readonly>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="card-footer"></div>
                </div>

                <div class="row">
                    <div class="col-sm-2">
                        <a href="{{ route('reserve.edit', $reserve->id) }}" class="btn btn-primary">
                            <i class="fas fa-pen"></i> Editar
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection

@section('footer-extras')
    <script src="{{ mix('js/reserve.js') }}"></script>
@endsection
