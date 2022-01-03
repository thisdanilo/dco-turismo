@extends('airport::layouts.master')

@section('page_title', 'Aeroportos')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-10">
                <ol class="breadcrumb float-sm-left">
                    <li class="breadcrumb-item">Aeroportos</li>
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
                <form action="{{ route('airport.store') }}" method="post">

                    {{-- Elementos Ocultos --}}
                    @csrf

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
                                        <label>Nome:<span class="text-danger">*</span></label>
                                        <input type="text" name="name" class="form-control" required>
                                    </div>
                                </div>

                                {{-- CEP --}}
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>CEP:<span class="text-danger"> *</span></label>
                                        <input type="text" name="zip_code" class="form-control mask-zipcode" id="cep" required>
                                    </div>
                                </div>

                                {{-- Endereço --}}
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Endereço:<span class="text-danger"> *</span></label>
                                        <input type="text" name="address" class="form-control" id="logradouro" required>
                                    </div>
                                </div>

                                {{-- Número --}}
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Número:<span class="text-danger"> *</span></label>
                                        <input type="text" name="number" class="form-control" required>
                                    </div>
                                </div>

                                {{-- Complemento --}}
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Complemento:</label>
                                        <input type="text" name="complement" class="form-control">
                                    </div>
                                </div>

                                {{-- Latitude --}}
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Latitude:<span class="text-danger"> *</span></label>
                                        <input type="text" name="latitude" class="form-control" required>
                                    </div>
                                </div>

                                {{-- Longitude --}}
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Longitude:<span class="text-danger"> *</span></label>
                                        <input type="text" name="longitude" class="form-control" required>
                                    </div>
                                </div>

                                {{-- Cidade --}}
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Cidade:<span class="text-danger">*</span></label>
                                        <select name="city_id" class="form-control select2" style="width: 100%;" required>

                                            <option value="">Selecione</option>

                                            @foreach ($cities as $city)

                                                <option value="{{ $city->id }}">{{ $city->name }}</option>

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
    <script src="{{ mix('js/airport.js') }}"></script>
@endsection
