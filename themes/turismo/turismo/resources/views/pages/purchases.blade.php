@extends('layouts.master')

@section('content')

    {{-- Respostas --}}
    @include('dashboard.partials.errors')
    @include('dashboard.partials.success')

    <div class="content">

        <section class="container">
            <h1 class="title">Minhas Compras</h1>


            <table class="table">
                <thead>
                    <tr>
                        <th width="50">Cod</th>
                        <th>Vôo</th>
                        <th>Data</th>
                        <th width="100">Status</th>
                        <th width="130">Cancelar</th>
                    </tr>
                </thead>
                <tbody>

                    @forelse ($purchases as $purchase)

                        <tr>
                            <td>{{ $purchase->id }}</td>
                            <td>
                                <a href="{{ route('purchase.details', $purchase->id) }}" class="badge badge-light">
                                    Ver Detalhes Voô: {{ $purchase->flight->id }}
                                    <i class="fa fa-info-circle" aria-hidden="true"></i>
                                </a>
                            </td>
                            <td>{{ SiteHelper::formatDateAndTime($purchase->date) }}</td>
                            <td>
                                <span class="badge badge-secondary">{{ $purchase->formatted_status }}</span>
                            </td>
                            <td>
                                <a href="" class="btn btn-danger">
                                    Cancelar? <i class="fa fa-trash" aria-hidden="true"></i>
                                </a>
                            </td>
                        </tr>

                    @empty

                    <p>Nenhuma compra realizada!</p>

                    @endforelse

                </tbody>
            </table>
        </section>
        <!--Container-->

    </div>
@endsection
