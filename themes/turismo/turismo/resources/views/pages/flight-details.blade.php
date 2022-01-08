@extends('layouts.master')

@section('content')

    {{-- Respostas --}}
    @include('dashboard.partials.errors')
    @include('dashboard.partials.success')

    <div class="content">
        <section class="container">
            <h1 class="title">Detalhes do voô {{ $flight->id }}</h1>

            <ul class="list-group">
                <li class="list-group-item">
                    Origem: <strong>{{ $flight->origin->name }}</strong>
                </li>
                <li class="list-group-item">
                    Destino: <strong>{{ $flight->destination->name }}</strong>
                </li>
                <li class="list-group-item">
                    Saída: <strong>{{ SiteHelper::formatDateAndTime($flight->hour_output, 'H:i') }}</strong>
                </li>
                <li class="list-group-item">
                    Chegada: <strong>{{ SiteHelper::formatDateAndTime($flight->arrival_time, 'H:i') }}</strong>
                </li>
                <li class="list-group-item">
                    Promoção: <strong>{{ $flight->formatted_is_promotion }}</strong>
                </li>
                <li class="list-group-item">
                    Preço: <strong> R$ {{ $flight->formatted_price }}</strong>
                </li>
                <li class="list-group-item">
                    Parcelas: <strong> {{ $flight->total_prots }}</strong>
                </li>

            </ul>

            <form action="{{ route('reserve.flight') }}" method="post">

                {{-- Elementos Ocultos --}}
                @csrf
                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                <input type="hidden" name="flight_id" value="{{ $flight->id }}">
                <input type="hidden" name="date_reserved" value="{{ date('Y-m-d') }}">
                <input type="hidden" name="status" value="{{ Reserve::RESERVED }}">

                <button type="submit" class="result-search btn-reserve">Reserve agora</button>
            </form>
        </section>
        <!--Container-->
    </div>

@endsection
