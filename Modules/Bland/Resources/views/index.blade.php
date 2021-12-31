@extends('bland::layouts.master')

@section('content')
    <h1>Hello World</h1>

    <p>
        This view is loaded from module: {!! config('bland.name') !!}
    </p>
@endsection
