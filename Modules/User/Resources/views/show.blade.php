@extends('user::layouts.master')

@section('page_title', 'Clientes')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-10">
                <ol class="breadcrumb float-sm-left">
                    <li class="breadcrumb-item">Clientes</li>
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
                            Dados do Cliente
                        </h3>
                    </div>

                    <div class="card-body">
                        <div class="row">

                            {{-- Nome --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nome:</label>
                                    <input type="text" class="form-control" value="{{ $user->name }}" readonly>
                                </div>
                            </div>

                            {{-- Email --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Email:</label>
                                    <input type="text" class="form-control" value="{{ $user->email }}" readonly>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="card-footer"></div>

                </div>

                <div class="row">
                    <div class="col-sm-2">
                        <a href="{{ route('user.edit', $user->id) }}" class="btn btn-primary">
                            <i class="fas fa-pen"></i> Editar
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection

@section('footer-extras')
    <script src="{{ mix('js/user.js') }}"></script>
@endsection
