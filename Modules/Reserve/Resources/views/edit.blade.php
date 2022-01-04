@extends('reserve::layouts.master')

@section('page_title', 'Reservas')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-10">
                <ol class="breadcrumb float-sm-left">
                    <li class="breadcrumb-item">Reservas</li>
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
                <form action="{{ route('reserve.update', $reserve->id) }}" method="post">

                    {{-- Elementos Ocultos --}}
                    @csrf
                    @method('PUT')

                    <div class="card card-outline card-secondary">

                        <div class="card-header">
                            <h3 class="card-title">
                                Dados da Reserva
                            </h3>
                        </div>

                        <div class="card-body">
                            <div class="row">

                                {{-- Usuários --}}
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Usuários:</label>
                                        <select name="user_id" class="form-control" style="width: 100%;">
                                            <option value="{{ $reserve->user->id}}" selected>{{ $reserve->user->name}}</option>

                                            @foreach ($users as $user)

                                                <option value="{{ $user->id }}">{{ $user->name }}</option>

                                            @endforeach

                                        </select>
                                    </div>
                                </div>

                                {{-- Data do voo --}}
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Data do voo:</label>
                                        <select name="flight_id" class="form-control" style="width: 100%;">
                                            <option value="{{ $reserve->flight->id}}" selected>{{ $reserve->flight->date}}</option>

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
                                        <input type="date" name="date_reserved" class="form-control" value="{{ $reserve->date_reserved }}" required>
                                    </div>
                                </div>

                                {{-- Status --}}
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Status:<span class="text-danger">*</span></label>
                                       <select name="status" class="form-control" id="type" style="width: 100%;" required>
                                            <option value="{{ Reserve::RESERVED }}" @if ($reserve->status == Reserve::RESERVED) selected @endif>Reservado</option>
                                            <option value="{{ Reserve::CANCELED }}" @if ($reserve->status == Reserve::CANCELED) selected @endif>Cancelado</option>
                                            <option value="{{ Reserve::PAID }}" @if ($reserve->status == Reserve::PAID) selected @endif>Pago</option>
                                            <option value="{{ Reserve::CONCLUDED }}" @if ($reserve->status == Reserve::CONCLUDED) selected @endif>Concluído</option>
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
    <script src="{{ mix('js/reserve.js') }}"></script>
@endsection
