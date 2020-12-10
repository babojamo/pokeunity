@extends('layouts.app')

@section('content')
<div id="pokemons">
        <pokemons></pokemons>
    </div>
@stop


@section('footer')
<script src="{{ asset('js/pokemons.js') }}"></script>

@stop
