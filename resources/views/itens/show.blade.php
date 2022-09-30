@extends('layouts.master')

@section('content')
    <div class="card text-center text-white">
        <div class="card-header bg-info">Detalhes</div>
        <div class="card-body bg-primary">
            <h5 class="card-title">{{$item->nome}}</h5>
            <p class="card-text">{{$item->local}}</p>
            <div class="row">
                <div class="col-12 mb-3">
                    <strong>Código de barras: </strong>
                    {{$item->barcode}}
                </div>
                <div class="col-4 mb-3">
                    <strong>Entrada: </strong>
                    {{dateSwap($item->entrada)}}
                </div>
                <div class="col-4 mb-3">
                    <strong>Saida: </strong>
                    {{$item->saida ? dateSwap($item->saida) : ''}}
                </div>
                <div class="col-4 mb-3 mx-auto">
                    <strong>Validade: </strong>
                    {{dateSwap($item->validade)}}
                </div>
            </div>
        </div>
    </div>



@endsection
