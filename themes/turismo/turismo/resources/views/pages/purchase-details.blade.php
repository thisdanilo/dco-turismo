@extends('layouts.master')

@section('content')

    <div class="content">

        <section class="container">
            <h1 class="title">Detalhes do voô {{ $purchase->id }}</h1>

            <ul class="list-group">
                <li class="list-group-item">
                    Origem: <strong>{{ $purchase->origin->name }}</strong>
                </li>
                <li class="list-group-item">
                    Destino: <strong>{{ $purchase->destination->name }}</strong>
                </li>
                <li class="list-group-item">
                    Saída: <strong>{{ SiteHelper::formatDateAndTime($purchase->hour_output, 'H:i') }}</strong>
                </li>
                <li class="list-group-item">
                    Chegada: <strong>{{ SiteHelper::formatDateAndTime($purchase->arrival_time, 'H:i') }}</strong>
                </li>
                <li class="list-group-item">
                    Promoção: <strong>{{ $purchase->formatted_is_promotion }}</strong>
                </li>
                <li class="list-group-item">
                    Preço: <strong> R$ {{ $purchase->formatted_price }}</strong>
                </li>
                <li class="list-group-item">
                    Parcelas: <strong> {{ $purchase->total_prots }}</strong>
                </li>

            </ul>

        </section>
        <!--Container-->

    </div>
@endsection
