@extends('reserve::layouts.master')

@section('page_title', 'Reservas')

@section('content_header')

    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-10">
                <ol class="breadcrumb float-sm-left">
                    <li class="breadcrumb-item">Reservas</li>
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
                <form action="{{ route('reserve.store') }}" method="post">

                    {{-- Elementos Ocultos --}}
                    @csrf

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
                                        <label>Usuário:<span class="text-danger">*</span></label>
                                        <select name="user_id" class="form-control" style="width: 100%;" required>

                                            <option value="">Selecione</option>

                                             @foreach ($users as $user)

                                                <option value="{{ $user->id }}">{{ $user->name }}</option>

                                            @endforeach

                                        </select>
                                    </div>
                                </div>

                                {{-- Voo --}}
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Voo:<span class="text-danger">*</span></label>
                                        <select name="flight_id" class="form-control" style="width: 100%;" required>

                                            <option value="">Selecione</option>

                                             @foreach ($flights as $flight)

                                                <option value="{{ $flight->id }}">{{ $flight->date }}</option>

                                            @endforeach

                                        </select>
                                    </div>
                                </div>

                                {{-- Data da Reserva --}}
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Data da Reserva:<span class="text-danger">*</span></label>
                                        <input type="date" name="date_reserved" class="form-control" required>
                                    </div>
                                </div>

                                {{-- Status --}}
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Status:<span class="text-danger">*</span></label>
                                        <select name="status" class="form-control" style="width: 100%;" required>

                                            <option value="">Selecione</option>
                                            <option value="{{ Reserve::RESERVED }}">Reservado</option>
                                            <option value="{{ Reserve::CANCELED }}">Cancelado</option>
                                            <option value="{{ Reserve::PAID }}">Pago</option>
                                            <option value="{{ Reserve::CONCLUDED }}">Concluído</option>

                                        </select>
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
                                <button type="submit" class="btn btn-success">
                                    <i class="fa fa-plus fa-fw"></i> Cadastrar
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
    <script src="{{ mix('js/reserve.js') }}"></script>
@endsection
