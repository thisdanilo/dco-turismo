@extends('plane::layouts.master')

@section('title', 'Aviões')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-10">
                <ol class="breadcrumb float-sm-left">
                    <li class="breadcrumb-item">Aviões</li>
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
                <form action="{{ route('plane.store') }}" method="post">

                    {{-- Elementos Ocultos --}}
                    @csrf

                    <div class="card card-outline card-secondary">

                        <div class="card-header">
                            <h3 class="card-title">
                                Dados do Avião
                            </h3>
                        </div>

                        <div class="card-body">
                            <div class="row">

                                {{-- Total Passageiros --}}
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Total Passageiros:<span class="text-danger">*</span></label>
                                        <input type="text" name="total_passengers" class="form-control" required>
                                    </div>
                                </div>

                                {{-- Classe --}}
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Classe:<span class="text-danger">*</span></label>
                                        <select name="class" class="form-control" style="width: 100%;" required>

                                            <option value="">Selecione</option>
                                            <option value="{{ Plane::ECONOMIC }}">Econômica</option>
                                            <option value="{{ Plane::LUXURY }}">Luxo</option>

                                        </select>
                                    </div>
                                </div>

                                {{-- Marca --}}
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Marca:<span class="text-danger">*</span></label>
                                        <select name="bland_id" class="form-control" style="width: 100%;" required>

                                            <option value="">Selecione</option>

                                             @foreach ($blands as $bland)

                                                <option value="{{ $bland->id }}">{{ $bland->name }}</option>

                                            @endforeach

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
    <script src="{{ mix('js/plane.js') }}"></script>
@endsection
