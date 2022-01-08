@extends('layouts.master')

@section('content')

    <div class="content">
        <section class="container">
            <h1 class="title">Promoções</h1>
            <div class="row">

                @forelse ($promotions as $promotion)

                    <article class="result col-lg-3 col-md-4 col-sm-6 col-12">
                        <div class="image-promo">
                            <img src="{{ asset('imgs/buenos_aires.jpg') }}">
                            <div class="legend">
                                <h1>{{ $promotion->destination->city->name }}</h1>
                                <h2>Saída: {{ $promotion->origin->city->name }}</h2>
                                <span>Ida</span>
                            </div>
                        </div>

                        <div class="details">
                            <p>Data: {{ SiteHelper::formatDateAndTime($promotion->date) }}</p>

                            <div class="price">
                                <span>R$ {{ $promotion->formatted_price }}</span>
                                <strong>Em até {{ $promotion->total_prots }}x</strong>
                            </div>
                            <a href="{{ route('flight.details', $promotion->id) }}" class="btn btn-buy">Ver Detalhes</a>
                        </div>
                    </article>

                @empty

                    <p>Nenhuma Promoção!</p>

                @endforelse

            </div>
        </section>
    </div>

@endsection
