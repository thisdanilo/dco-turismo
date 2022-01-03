@extends('plane::layouts.master')

@section('page_title', 'Aviões')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-10">
                <ol class="breadcrumb float-sm-left">
                    <li class="breadcrumb-item">Aviões</li>
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
                            Dados do Avião
                        </h3>
                    </div>

                    <div class="card-body">
                        <div class="row">

                            {{-- Total Passageiros --}}
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Total Passageiros:</label>
                                    <input type="text" class="form-control" value="{{ $plane->total_passengers }}" readonly>
                                </div>
                            </div>

                            {{-- Classe --}}
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Classe:</label>
                                    <input type="text" class="form-control" value="{{ $plane->formatted_class }}" readonly>
                                </div>
                            </div>

                            {{-- Marca --}}
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Marca:</label>
                                    <input type="text" class="form-control" value="{{ $plane->bland->name }}" readonly>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="card-footer"></div>

                </div>

                <div class="row">
                    <div class="col-sm-2">
                        <a href="{{ route('plane.edit', $plane->id) }}" class="btn btn-primary">
                            <i class="fas fa-pen"></i> Editar
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection

@section('footer-extras')
    <script src="{{ mix('js/plane.js') }}"></script>
@endsection
