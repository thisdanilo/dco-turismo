@extends('layouts.master')

@section('content')

    <div class="content">

        <section class="container">

            {{-- Respostas --}}
            @include('dashboard.partials.errors')
            @include('dashboard.partials.success')

            <h1 class="title">Meu Perfil</h1>


            <div class="">
                <form class="form-eti" action="{{ route('update.profile') }}" method="post">

                    {{-- Elementos ocultos --}}
                    @csrf

                    <div class="form-group">
                        <label for="name">Nome *</label>

                        <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                            <div class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></div>
                            <input type="text" name="name" class="form-control" placeholder="Nome" value="{{ auth()->user()->name }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="email">E-Mail *</label>

                        <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                            <div class="input-group-addon"><i class="fa fa-envelope" aria-hidden="true"></i></div>
                            <input type="email" name="email" class="form-control" placeholder="E-mail" disabled="disabled" value="{{ auth()->user()->email }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password">Senha: (Opcional) Informe qpenas se quiser qtualizar</label>

                        <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                            <div class="input-group-addon"><i class="fa fa-unlock-alt" aria-hidden="true"></i></div>
                            <input type="password" name="password" class="form-control" placeholder="(Opcional) Informe Apenas se Quiser Atualizar a Senha">
                        </div>
                    </div>

                    <button type="submit" class="btn-form">Atualizar Perfil <i class="fa fa-retweet" aria-hidden="true"></i></button>

                </form>

            </div>
            <!--Row-->
        </section>
        <!--Container-->

    </div>

@endsection
