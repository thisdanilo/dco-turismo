@extends('dashboard::layouts.master')

@section('page_title', 'Home')

@section('header-extras')
@endsection

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-10">
                <ol class="breadcrumb float-sm-left">
                    <li class="breadcrumb-item">Home</li>
                    <li class="breadcrumb-item active">Painel de Controle</li>
                </ol>
            </div>
        </div>
    </div>
@endsection

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4 col-6">
                <!-- small box -->
                <div class="small-box bg-primary">
                    <div class="inner">
                        <h3>{{ $users }}</h3>

                        <p>Clientes</p>
                    </div>
                    <div class="icon">
                       <i class="fas fa-users"></i>
                    </div>
                    <a href="{{ route('user.index') }}" class="small-box-footer">Mais informações <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-4 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ $planes }}</h3>

                        <p>Aviões</p>
                    </div>
                    <div class="icon">
                       <i class="fas fa-plane"></i>
                    </div>
                    <a href="{{ route('plane.index') }}" class="small-box-footer">Mais informações <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-4 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{ $airports }}</h3>

                        <p>Aeroportos</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-plane-departure"></i>
                    </div>
                    <a href="{{ route('airport.index') }}" class="small-box-footer">Mais informações <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-6 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ $flights }}</h3>

                        <p>Voos</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-business-time"></i>
                    </div>
                    <a href="{{ route('flight.index') }}" class="small-box-footer">Mais informações <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-6 col-6">
                <!-- small box -->
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>{{ $reserves }}</h3>

                        <p>Reservas</p>
                    </div>
                    <div class="icon">
                       <i class="fas fa-money-check"></i>
                    </div>
                    <a href="{{ route('reserve.index') }}" class="small-box-footer">Mais informações <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>

    @endsection
