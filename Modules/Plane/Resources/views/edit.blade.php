@extends('plane::layouts.master')

@section('title', 'Aviões')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-10">
                <ol class="breadcrumb float-sm-left">
                    <li class="breadcrumb-item">Aviões</li>
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
                <form action="{{ route('plane.update', $plane->id) }}" method="post">

                    {{-- Elementos Ocultos --}}
                    @csrf
                    @method('PUT')

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
                                        <input type="text" name="total_passengers" class="form-control" value="{{ $plane->total_passengers }}" required>
                                    </div>
                                </div>

                                {{-- Classe --}}
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Classe:<span class="text-danger">*</span></label>
                                       <select name="class" class="form-control" id="type" style="width: 100%;" required>
                                            <option value="{{ Plane::ECONOMIC }}" @if ($plane->class == Plane::ECONOMIC) selected @endif>Econômica</option>
                                            <option value="{{ Plane::LUXURY }}" @if ($plane->class == Plane::LUXURY) selected @endif>Luxo</option>
                                        </select>
                                    </div>
                                </div>

                                {{-- Marca --}}
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Marca:</label>
                                        <select name="bland_id" class="form-control" style="width: 100%;">
                                            <option value="{{ $plane->bland->id}}" selected>{{ $plane->bland->name}}</option>

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
    <script src="{{ mix('js/plane.js') }}"></script>
@endsection
